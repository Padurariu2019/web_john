<?php
require_once BASE_PATH . '/Models/Product.php';
require_once BASE_PATH . '/Services/ProductCategoryService.php';
require_once BASE_PATH . '/Services/ZoneService.php';
require_once BASE_PATH . '/Services/AgeGroupService.php';
require_once BASE_PATH . '/app/Database.php';

class ProductService{
    private Database $db;
    private string $table;
    private ProductCategoryService $productCategoryService;
    private ZoneService $zoneService;
    private AgeGroupService $ageGroupService;

    public function __construct($db, $table, ProductCategoryService $productCategoryService, ZoneService $zoneService, AgeGroupService $ageGroupService) {
        $this->db = $db;
        $this->table = $table;
        $this->productCategoryService = $productCategoryService;
        $this->zoneService = $zoneService;
        $this->ageGroupService = $ageGroupService;
    }
    public function getProduct($id)
{
    $sql = "SELECT * FROM $this->table WHERE id = ?";
    $queryRes = $this->db->query($sql, [$id])->find();
    $productCategory = $this->productCategoryService->getProductCategory($queryRes['product_category_id']);
    $zone = $this->zoneService->getZone($queryRes['zone_id']);
    $ageGroup = $this->ageGroupService->getAgeGroup($queryRes['age_group_id']);
    $occasionIds = $this->getOccasionIdsForProduct($id);
    $timeOfDayIds = $this->getTimeOfDayIdsForProduct($id);
    $skintypeIds = $this->getSkintypeIdsForProduct($id);
    return new Product($queryRes["id"], $queryRes['name'], $queryRes['brand'], $queryRes['description'], $queryRes['picture_path'], $queryRes['likes'], $productCategory, $zone, $ageGroup, $occasionIds, $timeOfDayIds, $skintypeIds);
}

    public function getProducts()
    {
        $products = $this->retrieveProductsFromDB();
        $products = $this->populateAdditionalFields($products);
        return $products;
    }

    public function getProductsPage($items_per_page, $page, $order)
    {
        $offset = ($page - 1) * $items_per_page;
        $sql = "SELECT * FROM $this->table ORDER BY id $order LIMIT ? OFFSET ?";
        $queryRes = $this->db->query($sql, [$items_per_page, $offset])->findAll();
        $res = [];
        foreach($queryRes as $product){
            $productCategory = $this->productCategoryService->getProductCategory($product['product_category_id']);
            $zone = $this->zoneService->getZone($product['zone_id']);
            $ageGroup = $this->ageGroupService->getAgeGroup($product['age_group_id']);
            $res[] = new Product($product["id"], $product['name'], $product['brand'], $product['description'], $product['picture_path'], $product['likes'], $productCategory, $zone, $ageGroup, $product['occasion_ids'], $product['time_of_day_ids'], $product['skintype_ids']);
        }
        return $res;
    }

    public function getProductsCategory($category)
    {
        $sql = "SELECT * FROM $this->table WHERE product_category_id = (SELECT id FROM product_category WHERE type = ?)";
        $queryRes = $this->db->query($sql, [$category])->findAll();
        $res = [];
        foreach($queryRes as $product){
            $productCategory = $this->productCategoryService->getProductCategory($product['product_category_id']);
            $zone = $this->zoneService->getZone($product['zone_id']);
            $ageGroup = $this->ageGroupService->getAgeGroup($product['age_group_id']);
            $res[] = new Product($product["id"], $product['name'], $product['brand'], $product['description'], $product['picture_path'], $product['likes'], $productCategory, $zone, $ageGroup, $product['occasion_ids'], $product['time_of_day_ids'], $product['skintype_ids']);
        }
        return $res;
    }
    public function getMostLiked(){
        $sql = "SELECT * FROM $this->table ORDER BY likes DESC";
        $queryRes = $this->db->query($sql)->findAll();
        $products = [];
        foreach($queryRes as $productData){
            $productCategory = $this->productCategoryService->getProductCategory($productData['product_category_id']);
            $zone = $this->zoneService->getZone($productData['zone_id']);
            $ageGroup = $this->ageGroupService->getAgeGroup($productData['age_group_id']);
            $occasionIds = $this->getOccasionIdsForProduct($productData['id']);
            $timeOfDayIds = $this->getTimeOfDayIdsForProduct($productData['id']);
            $skintypeIds = $this->getSkintypeIdsForProduct($productData['id']);
            $products[] = new Product($productData["id"], $productData['name'], $productData['brand'], $productData['description'], $productData['picture_path'], $productData['likes'], $productCategory, $zone, $ageGroup, $occasionIds, $timeOfDayIds, $skintypeIds);
        }
        return $products;
    }



    public function createProduct(Product $product)
    {
        $this->validateProduct($product);
        $sql = "INSERT INTO $this->table (name, brand, description, picture_path, product_category_id, zone_id, age_group_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $this->db->query($sql, [$product->name, $product->brand, $product->description, $product->picture_path, $product->productCategoryId, $product->zoneId, $product->ageGroupId]);

        // Get the ID of the inserted product
        $productId = $this->db->getLastInsertId();

        // Insert the product's associations with occasions
        if (!empty($product->occasionIds)) {
            foreach ($product->occasionIds as $occasionId) {
                $this->associateProductWithOccasion($productId, $occasionId);
            }
        }

        // Insert the product's associations with times of day
        if (!empty($product->timeOfDayIds)) {
            foreach ($product->timeOfDayIds as $timeOfDayId) {
                $this->associateProductWithTimeOfDay($productId, $timeOfDayId);
            }
        }

        // Insert the product's associations with skintypes
        if (!empty($product->skintypeIds)) {
            foreach ($product->skintypeIds as $skintypeId) {
                $this->associateProductWithSkintype($productId, $skintypeId);
            }
        }

        return $productId;
    }


    public function updateProductImage($id, $new_path) {
        $sql = "UPDATE $this->table SET picture_path = ? WHERE id = ?";
        $this->db->query($sql, [$new_path, $id]);
    }

    public function deleteProduct($id)
    {
        $sql = "SELECT 1 FROM $this->table WHERE id = ?";
        $product = $this->db->query($sql, [$id])->find();

        if ($product) {
            $sql = "DELETE FROM $this->table WHERE id = ?";
            $this->db->query($sql, [$id]);
            return true;
        } else {
            return false;
        }
    }





   public function validateProduct(Product $product)
    {
    // Check if all properties are set and not null
    foreach (get_object_vars($product) as $property => $value) {
        if ($property === 'id' || $property === 'likes' || $property === 'occasionIds' || $property === 'timeOfDayIds') {
            continue;
        }
        if ($value === null) {
            throw new Exception("Property $property must not be null");
        }
    }

    // Check if product name is unique
    $sql = "SELECT * FROM $this->table WHERE name = ?";
    $queryRes = $this->db->query($sql, [$product->name])->find();
    if ($queryRes) {
        throw new Exception("Product name already exists");
    }

    // Check if product name is a string
    if (!is_string($product->name)) {
        throw new Exception("Product name must be a string");
    }

    // Check if brand is a string
    if (!is_string($product->brand)) {
        throw new Exception("Brand must be a string");
    }

    // Check if description is a string
    if (!is_string($product->description)) {
        throw new Exception("Description must be a string");
    }

    // Check if picture_path is a string
    if (!is_string($product->picture_path)) {
        throw new Exception("Picture path must be a string");
    }


    // Check if productCategory id exists in the available ids of ProductCategory
    $productCategory = $this->productCategoryService->getProductCategory($product->productCategoryId);
    if ($productCategory === null) {
        throw new Exception("Product category does not exist");
    }

    // Check if zone id exists in the available ids of Zone
    $zone = $this->zoneService->getZone($product->zoneId);
    if ($zone === null) {
        throw new Exception("Zone does not exist");
    }


    // Check if ageGroup id exists in the available ids of AgeGroup
    $ageGroup = $this->ageGroupService->getAgeGroup($product->ageGroupId);
    if ($ageGroup === null) {
        throw new Exception("Age group does not exist");
    }
    }
    private function retrieveProductsFromDB() {
        $sql = "SELECT * FROM $this->table";
        $queryRes = $this->db->query($sql)->findAll();
        $res = [];
        foreach ($queryRes as $product) {
            // Retrieve occasion IDs associated with the product
            $occasionIds = $this->getOccasionIdsForProduct($product['id']);

            // Retrieve time of day IDs associated with the product
            $timeOfDayIds = $this->getTimeOfDayIdsForProduct($product['id']);

            // Retrieve skintype IDs associated with the product
            $skintypeIds = $this->getSkintypeIdsForProduct($product['id']);

            $res[] = new Product($product['id'], $product['name'], $product['brand'], $product['description'], $product['picture_path'], $product['likes'], $product['product_category_id'], $product['zone_id'], $product['age_group_id'], $occasionIds, $timeOfDayIds, $skintypeIds);
        }
        return $res;
    }


    private function getOccasionIdsForProduct($productId) {
        $sql = "SELECT occasion_id FROM product_for_occasion WHERE product_id = ?";
        $queryRes = $this->db->query($sql, [$productId])->findAll();
        $occasionIds = [];
        foreach ($queryRes as $row) {
            $occasionIds[] = $row['occasion_id'];
        }
        return $occasionIds;
    }

    private function getTimeOfDayIdsForProduct($productId) {
        $sql = "SELECT time_of_day_id FROM product_for_time_of_day WHERE product_id = ?";
        $queryRes = $this->db->query($sql, [$productId])->findAll();
        $timeOfDayIds = [];
        foreach ($queryRes as $row) {
            $timeOfDayIds[] = $row['time_of_day_id'];
        }
        return $timeOfDayIds;
    }

    private function getSkintypeIdsForProduct($productId) {
        $sql = "SELECT skintype_id FROM product_for_skintype WHERE product_id = ?";
        $queryRes = $this->db->query($sql, [$productId])->findAll();
        $skintypeIds = [];
        foreach ($queryRes as $row) {
            $skintypeIds[] = $row['skintype_id'];
        }
        return $skintypeIds;
    }


    private function populateAdditionalFields(array $products) {
        foreach ($products as $key => $product) {
            $productCategory = $this->productCategoryService->getProductCategory($product->productCategoryId);
            $zone = $this->zoneService->getZone($product->zoneId);
            $ageGroup = $this->ageGroupService->getAgeGroup($product->ageGroupId);

            // Retrieve occasion IDs associated with the product
            $occasionIds = $this->getOccasionIdsForProduct($product->id);

            // Retrieve time of day IDs associated with the product
            $timeOfDayIds = $this->getTimeOfDayIdsForProduct($product->id);

            // Retrieve skintype IDs associated with the product
            $skintypeIds = $this->getSkintypeIdsForProduct($product->id);

            $products[$key] = new Product($product->id, $product->name, $product->brand, $product->description, $product->picture_path, $product->likes, $productCategory->id, $zone->id, $ageGroup->id, $occasionIds, $timeOfDayIds, $skintypeIds);
        }
        return $products;
    }

    private function associateProductWithOccasion($productId, $occasionId) {
        $sql = "INSERT INTO product_for_occasion (product_id, occasion_id) VALUES (?, ?)";
        $this->db->query($sql, [$productId, $occasionId]);
    }

    private function associateProductWithTimeOfDay($productId, $timeOfDayId) {
        $sql = "INSERT INTO product_for_time_of_day (product_id, time_of_day_id) VALUES (?, ?)";
        $this->db->query($sql, [$productId, $timeOfDayId]);
    }

    private function associateProductWithSkintype($productId, $skintypeId) {
        $sql = "INSERT INTO product_for_skintype (product_id, skintype_id) VALUES (?, ?)";
        $this->db->query($sql, [$productId, $skintypeId]);
    }

   public function getProductsLikedByGender() {
    $sql = "SELECT DISTINCT p.id as product_id, p.name as product_name, u.gender_id, COUNT(ul.product_id) as likes_number
            FROM product p
            JOIN user_likes ul ON p.id = ul.product_id
            JOIN users u ON ul.user_id = u.id
            GROUP BY p.id, u.gender_id
            ORDER BY u.gender_id ASC, likes_number DESC";
    $queryRes = $this->db->query($sql)->findAll();
    $products = [];
    foreach($queryRes as $productData){
        $products[] = [
            'product_id' => $productData['product_id'],
            'product_name' => $productData['product_name'],
            'gender_id' => $productData['gender_id'],
            'likes_number' => $productData['likes_number']
        ];
    }
    return $products;
}

    public function getProductsLikedBySkinType() {
        $sql = "SELECT DISTINCT p.id as product_id, p.name as product_name, u.skintype_id, COUNT(ul.product_id) as likes_number
                FROM product p
                JOIN user_likes ul ON p.id = ul.product_id
                JOIN users u ON ul.user_id = u.id
                GROUP BY p.id, u.skintype_id
                ORDER BY u.skintype_id ASC, likes_number DESC";
        $queryRes = $this->db->query($sql)->findAll();
        $products = [];
        foreach($queryRes as $productData){
            $products[] = [
                'product_id' => $productData['product_id'],
                'product_name' => $productData['product_name'],
                'skintype_id' => $productData['skintype_id'],
                'likes_number' => $productData['likes_number']
            ];
        }
        return $products;
    }

    public function getProductsLikedBySocialStatus() {
        $sql = "SELECT DISTINCT p.id as product_id, p.name as product_name, u.social_status_id, COUNT(ul.product_id) as likes_number
                FROM product p
                JOIN user_likes ul ON p.id = ul.product_id
                JOIN users u ON ul.user_id = u.id
                GROUP BY p.id, u.social_status_id
                ORDER BY u.social_status_id ASC, likes_number DESC";
        $queryRes = $this->db->query($sql)->findAll();
        $products = [];
        foreach($queryRes as $productData){
            $products[] = [
                'product_id' => $productData['product_id'],
                'product_name' => $productData['product_name'],
                'social_status_id' => $productData['social_status_id'],
                'likes_number' => $productData['likes_number']
            ];
        }
        return $products;
    }

    public function getProductsLikedByZone() {
        $sql = "SELECT DISTINCT p.id as product_id, p.name as product_name, p.zone_id, COUNT(ul.product_id) as likes_number
                FROM product p
                JOIN user_likes ul ON p.id = ul.product_id
                GROUP BY p.id, p.zone_id
                ORDER BY p.zone_id ASC, likes_number DESC";
        $queryRes = $this->db->query($sql)->findAll();
        $products = [];
        foreach($queryRes as $productData){
            $products[] = [
                'product_id' => $productData['product_id'],
                'product_name' => $productData['product_name'],
                'zone_id' => $productData['zone_id'],
                'likes_number' => $productData['likes_number']
            ];
        }
        return $products;
    }

    public function getProductsLikedByAgeGroup() {
        $sql = "SELECT DISTINCT p.id as product_id, p.name as product_name, p.age_group_id, COUNT(ul.product_id) as likes_number
                FROM product p
                JOIN user_likes ul ON p.id = ul.product_id
                GROUP BY p.id, p.age_group_id
                ORDER BY p.age_group_id ASC, likes_number DESC";
        $queryRes = $this->db->query($sql)->findAll();
        $products = [];
        foreach($queryRes as $productData){
            $products[] = [
                'product_id' => $productData['product_id'],
                'product_name' => $productData['product_name'],
                'age_group_id' => $productData['age_group_id'],
                'likes_number' => $productData['likes_number']
            ];
        }
        return $products;
    }

    public function getProductsLikedByTimeOfDay() {
        $sql = "SELECT DISTINCT p.id as product_id, p.name as product_name, potd.time_of_day_id, COUNT(ul.product_id) as likes_number
                FROM product p
                JOIN product_for_time_of_day potd ON p.id = potd.product_id
                JOIN user_likes ul ON p.id = ul.product_id
                GROUP BY p.id, potd.time_of_day_id
                ORDER BY potd.time_of_day_id ASC, likes_number DESC";
        $queryRes = $this->db->query($sql)->findAll();
        $products = [];
        foreach($queryRes as $productData){
            $products[] = [
                'product_id' => $productData['product_id'],
                'product_name' => $productData['product_name'],
                'time_of_day_id' => $productData['time_of_day_id'],
                'likes_number' => $productData['likes_number']
            ];
        }
        return $products;
    }

    public function getProductsLikedByOccasion() {
        $sql = "SELECT DISTINCT p.id as product_id, p.name as product_name, pfo.occasion_id, COUNT(ul.product_id) as likes_number
                FROM product p
                JOIN product_for_occasion pfo ON p.id = pfo.product_id
                JOIN user_likes ul ON p.id = ul.product_id
                GROUP BY p.id, pfo.occasion_id
                ORDER BY pfo.occasion_id ASC, likes_number DESC";
        $queryRes = $this->db->query($sql)->findAll();
        $products = [];
        foreach($queryRes as $productData){
            $products[] = [
                'product_id' => $productData['product_id'],
                'product_name' => $productData['product_name'],
                'occasion_id' => $productData['occasion_id'],
                'likes_number' => $productData['likes_number']
            ];
        }
        return $products;
    }

    private function buildFilteredQuery($queryParams) {
        $sql = "SELECT p.id, p.name, p.brand, p.description, p.picture_path, p.product_category_id, p.zone_id, p.age_group_id, p.likes
                FROM product p
                JOIN product_for_skintype pfs ON p.id = pfs.product_id";

        if (isset($queryParams['occasion_id'])) {
            $sql .= " JOIN product_for_occasion pfo ON p.id = pfo.product_id";
        }
        if (isset($queryParams['time_of_day_id'])) {
            $sql .= " JOIN product_for_time_of_day pft ON p.id = pft.product_id";
        }

        $sql .= " WHERE";

        foreach ($queryParams as $key => $value) {
            if ($key !== array_key_first($queryParams)) {
                $sql .= " AND";
            }

            if ($key === 'age_group_id') {
                $sql .= " p.age_group_id = $value";
            } elseif ($key === 'skintype_id') {
                $sql .= " pfs.skintype_id = $value";
            } elseif ($key === 'occasion_id') {
                $sql .= " pfo.occasion_id = $value";
            } elseif ($key === 'time_of_day_id') {
                $sql .= " pft.time_of_day_id = $value";
            }
        }

        return $sql;
    }

    public function getFilteredProducts($queryParams) {

        $sql = $this->buildFilteredQuery($queryParams);
        $queryRes = $this->db->query($sql)->findAll();
        $products = [];

        foreach ($queryRes as $productData) {
            $productCategory = $this->productCategoryService->getProductCategory($productData['product_category_id']);
            $zone = $this->zoneService->getZone($productData['zone_id']);
            $ageGroup = $this->ageGroupService->getAgeGroup($productData['age_group_id']);
            $occasionIds = $this->getOccasionIdsForProduct($productData['id']);
            $timeOfDayIds = $this->getTimeOfDayIdsForProduct($productData['id']);
            $skintypeIds = $this->getSkintypeIdsForProduct($productData['id']);
            $products[] = new Product($productData["id"], $productData['name'], $productData['brand'], $productData['description'], $productData['picture_path'], $productData['likes'], $productCategory, $zone, $ageGroup, $occasionIds, $timeOfDayIds, $skintypeIds);
        }

        return $products;
    }

    public function search($query) {
        $sql = "SELECT * FROM $this->table WHERE name LIKE ? OR brand LIKE ? OR description LIKE ?";
        $queryRes = $this->db->query($sql, ["%$query%", "%$query%", "%$query%"])->findAll();
        $res = [];
        foreach($queryRes as $product){
            // Retrieve occasion IDs associated with the product
            $occasionIds = $this->getOccasionIdsForProduct($product['id']);

            // Retrieve time of day IDs associated with the product
            $timeOfDayIds = $this->getTimeOfDayIdsForProduct($product['id']);

            // Retrieve skintype IDs associated with the product
            $skintypeIds = $this->getSkintypeIdsForProduct($product['id']);

            // Get additional related data
            $productCategory = $this->productCategoryService->getProductCategory($product['product_category_id']);
            $zone = $this->zoneService->getZone($product['zone_id']);
            $ageGroup = $this->ageGroupService->getAgeGroup($product['age_group_id']);

            // Create the Product object
            $res[] = new Product(
                $product["id"],
                $product['name'],
                $product['brand'],
                $product['description'],
                $product['picture_path'],
                $product['likes'],
                $productCategory,
                $zone,
                $ageGroup,
                $occasionIds,
                $timeOfDayIds,
                $skintypeIds
            );
        }
        return $res;
    }


}
