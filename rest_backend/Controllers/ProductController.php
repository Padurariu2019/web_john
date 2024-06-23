<?php

require_once BASE_PATH . '/Services/ProductService.php';
require_once BASE_PATH . '/Services/ZoneService.php';
require_once BASE_PATH . '/Services/ProductCategoryService.php';
require_once BASE_PATH . '/Services/AgeGroupService.php';

class ProductController {
    private ProductService $productService;
    private ZoneService $zoneService;
    private ProductCategoryService $productCategoryService;
    private AgeGroupService $ageGroupService;

    public function __construct(ProductService $productService, ZoneService $zoneService, ProductCategoryService $productCategoryService, AgeGroupService $ageGroupService) {
        $this->productService = $productService;
        $this->zoneService = $zoneService;
        $this->productCategoryService = $productCategoryService;
        $this->ageGroupService = $ageGroupService;
    }

    public function get($id) : void {
        header('Content-Type: application/json');
        $product = $this->productService->getProduct($id);
        if ($product) {
            http_response_code(200);
            echo json_encode($product);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Product not found"]);
        }
    }

    public function getAll() : void {
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($this->productService->getProducts());
    }

    public function getProductsPage($items_per_page, $page, $order) : void {
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($this->productService->getProductsPage($items_per_page, $page, $order));
    }

    public function getProductsCategory($id) : void {
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($this->productService->getProductsCategory($id));
    }

    public function search($query) : void {
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($this->productService->search(urldecode($query)));
    }

    public function add() : void {
        $data = json_decode(file_get_contents('php://input'), true);

        $productCategory = $this->productCategoryService->getProductCategory($data['product_category_id']);
        $zone = $this->zoneService->getZone($data['zone_id']);
        $ageGroup = $this->ageGroupService->getAgeGroup($data['age_group_id']);

        // Default to empty arrays if not set
        $occasionIds = isset($data['occasion_ids']) ? $data['occasion_ids'] : [];
        $timeOfDayIds = isset($data['time_of_day_ids']) ? $data['time_of_day_ids'] : [];
        $skintypeIds = isset($data['skintype_ids']) ? $data['skintype_ids'] : [];

        $product = new Product(
            null,
            $data['name'],
            $data['brand'],
            $data['description'],
            'placeholder.jpg',
            0,
            $productCategory->id, // Use ID instead of object
            $zone->id, // Use ID instead of object
            $ageGroup->id, // Use ID instead of object
            $occasionIds, // Array of occasion IDs
            $timeOfDayIds, // Array of time of day IDs
            $skintypeIds // Array of skin type IDs
        );

        $newID = $this->productService->createProduct($product);
        header('Content-Type: application/json');
        http_response_code(201); // Created
        echo json_encode(['id' => $newID]);
    }


    public function remove($id) : void {
        if ($this->productService->deleteProduct($id)) {
            http_response_code(204);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Product not found"]);
        }
    }

    public function getImage($id) : void {
        $product = $this->productService->getProduct($id);
        if ($product) {
            $rawPath = $product->picture_path;
            header('Content-Type: image/jpeg');
            readfile(BASE_PATH . '/uploads/images/product/' . $rawPath);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(["error" => "Image not found"]);
        }
    }

    public function addImage($id) : void {
        $target_dir = BASE_PATH . '/uploads/images/product/';
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $randomId = uniqid();
        $newName = $randomId . '.' . $imageFileType;
        $target_file = $target_dir . $newName;
        $uploadOk = 1;
        $check = getimagesize($_FILES["image"]["tmp_name"]);

        $uploadOk = $check !== false ? 1 : 0;

        if ($uploadOk == 0) {
            http_response_code(400);
            echo json_encode(["error" => "File is not an image."]);
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $this->productService->updateProductImage($id, $newName);
                http_response_code(201); // Created
                echo json_encode(["message" => "Image uploaded successfully"]);
            } else {
                http_response_code(500); // Internal Server Error
                echo json_encode(["error" => "Sorry, there was an error uploading your file."]);
            }
        }
    }

    public function getLikedProducts() : void {
        header('Content-Type: application/json');
        http_response_code(200); // OK
        echo json_encode($this->productService->getMostLiked());
    }

    public function getProductsLikedByGender() : void {
        header('Content-Type: application/json');
        http_response_code(200); // OK
        echo json_encode($this->productService->getProductsLikedByGender());
    }

    public function getProductsLikedBySkinType() : void {
        header('Content-Type: application/json');
        http_response_code(200); // OK
        echo json_encode($this->productService->getProductsLikedBySkinType());
    }

    public function getProductsLikedBySocialStatus() : void {
        header('Content-Type: application/json');
        http_response_code(200); // OK
        echo json_encode($this->productService->getProductsLikedBySocialStatus());
    }

    public function getProductsLikedByZone() : void {
        header('Content-Type: application/json');
        http_response_code(200); // OK
        echo json_encode($this->productService->getProductsLikedByZone());
    }

    public function getProductsLikedByAgeGroup() : void {
        header('Content-Type: application/json');
        http_response_code(200); // OK
        echo json_encode($this->productService->getProductsLikedByAgeGroup());
    }

    public function getProductsLikedByTimeOfDay() : void {
        header('Content-Type: application/json');
        http_response_code(200); // OK
        echo json_encode($this->productService->getProductsLikedByTimeOfDay());
    }

    public function getProductsLikedByOccasion() : void {
        header('Content-Type: application/json');
        http_response_code(200); // OK
        echo json_encode($this->productService->getProductsLikedByOccasion());
    }

    public function getFilteredProducts($query_params) : void {
        header('Content-Type: application/json');
        http_response_code(200); // OK
        echo json_encode($this->productService->getFilteredProducts($query_params));
    }
}
