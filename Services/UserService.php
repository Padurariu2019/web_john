<?php
require_once BASE_PATH . '/Models/User.php';
require_once BASE_PATH . '/Services/GenderService.php';
require_once BASE_PATH . '/Services/SkinTypeService.php';
require_once BASE_PATH . '/Services/SocialStatusService.php';
require_once BASE_PATH . '/Services/AgeGroupService.php';
require_once BASE_PATH . '/Services/UserRoleService.php';
require_once BASE_PATH . '/Services/ProductService.php';
require_once BASE_PATH . '/app/Database.php';

class UserService{
    private Database $db;
    private string $table;
    private GenderService $genderService;
    private SkinTypeService $skinTypeService;
    private SocialStatusService $socialStatusService;
    private AgeGroupService $ageGroupService;
    private UserRoleService $userRoleService;
    private ProductService $productService;

    public function __construct($db, $table, GenderService $genderService, SkinTypeService $skinTypeService, SocialStatusService $socialStatusService, AgeGroupService $ageGroupService, UserRoleService $userRoleService, $productService) {
        $this->db = $db;
        $this->table = $table;
        $this->genderService = $genderService;
        $this->skinTypeService = $skinTypeService;
        $this->socialStatusService = $socialStatusService;
        $this->ageGroupService = $ageGroupService;
        $this->userRoleService = $userRoleService;
        $this->productService = $productService;
    }

    public function getUsers()
    {
        $sql = "SELECT * FROM $this->table";
        $queryRes = $this->db->query($sql)->findAll();
        $res = [];
        foreach ($queryRes as $user) {
            $gender = $this->genderService->getGender($user['gender_id']);
            $skinType = $this->skinTypeService->getSkinType($user['skintype_id']);
            $socialStatus = $this->socialStatusService->getSocialStatus($user['social_status_id']);
            $ageGroup = $this->ageGroupService->getAgeGroup($user['age_group_id']);
            $userRole = $this->userRoleService->getUserRole($user['user_role_id']);
            $likedProducts = $this->getFavorites($user['id']);
            $res[] = new User($user['id'], $user['name'], $user['email'], $user['password'], $user['city'], $user['picture_path'], $gender, $skinType, $socialStatus, $ageGroup, $userRole, $likedProducts);
        }
        return $res;
    }

    public function getUser($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $queryRes = $this->db->query($sql, [$id])->find();
        $gender = $this->genderService->getGender($queryRes['gender_id']);
        $skinType = $this->skinTypeService->getSkinType($queryRes['skintype_id']);
        $socialStatus = $this->socialStatusService->getSocialStatus($queryRes['social_status_id']);
        $ageGroup = $this->ageGroupService->getAgeGroup($queryRes['age_group_id']);
        $userRole = $this->userRoleService->getUserRole($queryRes['user_role_id']);
        $likedProducts = $this->getFavorites($queryRes['id']);
        return new User($queryRes['id'], $queryRes['name'], $queryRes['email'], $queryRes['password'], $queryRes['city'], $queryRes['picture_path'], $gender, $skinType, $socialStatus, $ageGroup, $userRole,$likedProducts);
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM $this->table WHERE email = ?";
        $queryRes = $this->db->query($sql, [$email])->find();
        if ($queryRes) {
            return $queryRes;
        }
        return null;
    }

    public function getFavorites($user_id) {
        $sql = "SELECT product_id FROM user_likes WHERE user_id = ?";
        $queryRes = $this->db->query($sql, [$user_id])->findAll();
        $favorites = [];
        foreach($queryRes as $row){
            $favorites[] = $row['product_id'];
        }
        return $favorites;
    }

    public function addFavorite($user_id, $product_id) {
        try {
            $this->db->beginTransaction();

            // Check if the favorite already exists
            $checkSql = "SELECT 1 FROM user_likes WHERE user_id = ? AND product_id = ?";
            $exists = $this->db->query($checkSql, [$user_id, $product_id])->find();

            if (!$exists) {
                $likeInsertSql = "INSERT INTO user_likes (user_id, product_id) VALUES (?, ?)";
                $this->db->query($likeInsertSql, [$user_id, $product_id]);

                $likeIncrementSql = "UPDATE product SET likes = likes + 1 WHERE id = ?";
                $this->db->query($likeIncrementSql, [$product_id]);

                $this->db->commit();
                return true; // Successfully added favorite
            } else {
                $this->db->rollBack();
                return false; // Favorite already exists
            }
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function removeFavorite($user_id, $product_id) {
        try {
            $this->db->beginTransaction();

            // Check if the favorite exists
            $checkSql = "SELECT 1 FROM user_likes WHERE user_id = ? AND product_id = ?";
            $exists = $this->db->query($checkSql, [$user_id, $product_id])->find();

            if ($exists) {
                $likeDeleteSql = "DELETE FROM user_likes WHERE user_id = ? AND product_id = ?";
                $this->db->query($likeDeleteSql, [$user_id, $product_id]);

                $likeDecrementSql = "UPDATE product SET likes = likes - 1 WHERE id = ?";
                $this->db->query($likeDecrementSql, [$product_id]);

                $this->db->commit();
                return true; // Successfully removed favorite
            } else {
                $this->db->rollBack();
                return false; // Favorite does not exist
            }
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }


    public function createUser(User $user)
    {
        $this->validateUser($user);
        $hashedPassword = md5($user->password, false);
        $sql = "INSERT INTO $this->table (name, email, password, city, picture_path, gender_id, skintype_id, social_status_id, age_group_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $this->db->query($sql, [$user->name, $user->email, $hashedPassword, $user->city, $user->picture_path, $user->gender->id, $user->skinType->id, $user->socialStatus->id, $user->ageGroup->id]);
        return $this->db->getLastInsertId();
    }

    public function deleteUser($id)
    {
        try {
            $this->db->beginTransaction();

            $sql = "DELETE FROM $this->table WHERE id = ?";
            $this->db->query($sql, [$id]);

            $sql = "UPDATE product p
            SET likes = (SELECT COUNT(*) FROM user_likes ul WHERE ul.product_id = p.id)";
            $this->db->query($sql);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
        return false;
    }

    public function validateUser(User $user)
{
    // Check if all properties are set and not null
    foreach (get_object_vars($user) as $property => $value) {
        if ($property === 'id') {
            continue;
        }
        if ($value === null) {
            throw new Exception("Property $property must not be null");
        }
    }

    // Check if email is valid
    if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email format");
    }

    // Check if email is unique
    $sql = "SELECT * FROM $this->table WHERE email = ?";
    $queryRes = $this->db->query($sql, [$user->email])->find();
    if ($queryRes) {
        throw new Exception("Email already exists");
    }

    // Check if password contains at least one uppercase letter and one number
    if (!preg_match('/[A-Z]/', $user->password) || !preg_match('/[0-9]/', $user->password)) {
        throw new Exception("Password must contain at least one uppercase letter and one number");
    }

    // Check if password is of a certain length
    if (strlen($user->password) < 8) {
        throw new Exception("Password must be at least 8 characters long");
    }


    // Validate gender id exists in the available ids of Gender
    $gender=$this->genderService->getGender($user->gender->id);
    if ($gender === null) {
        throw new Exception('Gender does not exist');
    }

    // check if skinType id exists in the available ids of SkinType
    if (!$this->skinTypeService->getSkinType($user->skinType->id)) {
        throw new Exception("Invalid skinType id");
    }

    // check if socialStatus id exists in the available ids of SocialStatus
    if (!$this->socialStatusService->getSocialStatus($user->socialStatus->id)) {
        throw new Exception("Invalid socialStatus id");
    }

    // check if ageGroup id exists in the available ids of AgeGroup
    if (!$this->ageGroupService->getAgeGroup($user->ageGroup->id)) {
        throw new Exception("Invalid ageGroup id");
    }
}

    public function updateUserImage($id, $new_path) : void {
        $sql = "UPDATE $this->table SET picture_path = ? WHERE id = ?";
        $this->db->query($sql, [$new_path, $id]);
    }

    public function buildUpdateQuery($params)
{
    $fields = [];
    $values = [];

    // Add each parameter to the fields array if it is not an empty string
    if (!empty($params['name'])) {
        $fields[] = "name = ?";
        $values[] = $params['name'];
    }
    if (!empty($params['email'])) {
        $fields[] = "email = ?";
        $values[] = $params['email'];
    }
    if (!empty($params['password'])) {
        $fields[] = "password = ?";
        $values[] = md5($params['password'], false);
    }
    if (!empty($params['city'])) {
        $fields[] = "city = ?";
        $values[] = $params['city'];
    }
    if (!empty($params['gender_id'])) {
        $fields[] = "gender_id = ?";
        $values[] = (int)$params['gender_id'];
    }
    if (!empty($params['skin_type_id'])) {
        $fields[] = "skintype_id = ?";
        $values[] = (int)$params['skin_type_id'];
    }
    if (!empty($params['social_status_id'])) {
        $fields[] = "social_status_id = ?";
        $values[] = (int)$params['social_status_id'];
    }
    if (!empty($params['age_group_id'])) {
        $fields[] = "age_group_id = ?";
        $values[] = (int)$params['age_group_id'];
    }

    // If there are no fields to update, return null
    if (empty($fields)) {
        return null;
    }

    // Convert the fields array to a comma-separated string
    $setClause = implode(', ', $fields);

    // Return the built SQL query and values
    return [$setClause, $values];
}

    public function updateUser($id, $setClause, $values)
    {
        if ($setClause === null) {
            throw new Exception("No valid fields to update.");
        }
        $values[] = $id;

        $sql = "UPDATE $this->table SET $setClause WHERE id = ?";

        $this->db->query($sql, $values);
    }

}