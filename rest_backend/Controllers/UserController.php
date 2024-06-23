<?php

require_once BASE_PATH . '/Services/UserService.php';
require_once BASE_PATH . '/Services/GenderService.php';
require_once BASE_PATH . '/Services/SkinTypeService.php';
require_once BASE_PATH . '/Services/SocialStatusService.php';
require_once BASE_PATH . '/Services/AgeGroupService.php';
require_once BASE_PATH . '/Services/UserRoleService.php';
require_once BASE_PATH . '/Services/ProductService.php';

class UserController {
    private UserService $userService;
    private GenderService $genderService;
    private SkinTypeService $skinTypeService;
    private SocialStatusService $socialStatusService;
    private AgeGroupService $ageGroupService;
    private UserRoleService $userRoleService;
    private ProductService $productService;

    public function __construct(UserService $userService, GenderService $genderService, SkinTypeService $skinTypeService, SocialStatusService $socialStatusService, AgeGroupService $ageGroupService, UserRoleService $userRoleService, ProductService $productService) {
        $this->userService = $userService;
        $this->genderService = $genderService;
        $this->skinTypeService = $skinTypeService;
        $this->socialStatusService = $socialStatusService;
        $this->ageGroupService = $ageGroupService;
        $this->userRoleService = $userRoleService;
        $this->productService = $productService;
    }

    public function get($id) : void {
        header('Content-Type: application/json');
        $user = $this->userService->getUser($id);
        if ($user) {
            http_response_code(200); // OK
            echo json_encode($user);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(["error" => "User not found"]);
        }
    }

    public function getAll() : void {
        header('Content-Type: application/json');
        http_response_code(200); // OK
        echo json_encode($this->userService->getUsers());
    }

    public function getFavorites($id) : void {
        header('Content-Type: application/json');
        $favorites = $this->userService->getFavorites($id);
        if ($favorites) {
            http_response_code(200); // OK
            echo json_encode($favorites);
        } else {
            http_response_code(204); // No content
            echo json_encode([]);
        }
    }

    public function addFavorite($userId, $productId) : void {
        if ($this->userService->addFavorite($userId, $productId)) {
            http_response_code(201); // Created
            echo json_encode(["message" => "Favorite added successfully"]);
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(["error" => "Unable to add favorite"]);
        }
    }

    public function removeFavorite($userId, $productId) : void {
        if ($this->userService->removeFavorite($userId, $productId)) {
            http_response_code(204); // No Content
        } else {
            http_response_code(404); // Not Found
            echo json_encode(["error" => "Favorite not found"]);
        }
    }

    private function getRandomPlaceholderImage() : string {
        $dir = BASE_PATH . '/uploads/images/user_profile/placeholders';
        $files = array_diff(scandir($dir), array('.', '..')); // remove '.' and '..'
        $randomFile = $files[array_rand($files)];
        return 'placeholders/' . $randomFile;
    }

    public function getUserbyEmail($email) : void {
        header('Content-Type: application/json');
        $user = $this->userService->getUserByEmail($email);
        if ($user) {
            http_response_code(200); // OK
            echo json_encode($user);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(["error" => "User not found"]);
        }
    }

    public function add() : void {
        $data = json_decode(file_get_contents('php://input'), true);

        $gender = $this->genderService->getGender($data['gender_id']);
        $skinType = $this->skinTypeService->getSkinType($data['skin_type_id']);
        $socialStatus = $this->socialStatusService->getSocialStatus($data['social_status_id']);
        $ageGroup = $this->ageGroupService->getAgeGroup($data['age_group_id']);

        $user = new User(
            null,
            $data['name'],
            $data['email'],
            $data['password'],
            $data['city'],
            isset($data['picture_path']) ? $data['picture_path'] : $this->getRandomPlaceholderImage(),
            $gender,
            $skinType,
            $socialStatus,
            $ageGroup,
            new UserRole(2, 'User'), // Default user role
            []
        );

        $newID = $this->userService->createUser($user);
        header('Content-Type: application/json');
        http_response_code(201); // Created
        echo json_encode(['id' => $newID]);
    }

    public function remove($id) : void {
        header('Content-Type: application/json');
        try {
            if ($this->userService->deleteUser($id)) {
                http_response_code(204); // No Content
            } else {
                http_response_code(404); // Not Found
                echo json_encode(["error" => "User not found"]);
            }
        } catch (Exception $e) {
            http_response_code(500); // Internal Server Error
            echo json_encode(["error" => "An error occurred while trying to delete the user."]);
        }
    }

    public function getImage($id) : void {
        $user = $this->userService->getUser($id);
        if ($user) {
            $rawPath = $user->picture_path;
            header('Content-Type: image/jpeg');
            readfile(BASE_PATH . '/uploads/images/user_profile/' . $rawPath);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(["error" => "Image not found"]);
        }
    }

    public function addImage($id) : void {
        $target_dir = BASE_PATH . '/uploads/images/user_profile/';
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $randomId = uniqid();
        $newName = $randomId . '.' . $imageFileType;
        $target_file = $target_dir . $newName;
        $uploadOk = 1;
        $check = getimagesize($_FILES["image"]["tmp_name"]);

        $uploadOk = $check !== false ? 1 : 0;

        if ($uploadOk == 0) {
            http_response_code(400); // Bad Request
            echo json_encode(["error" => "File is not an image."]);
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $this->userService->updateUserImage($id, $newName);
                http_response_code(201); // Created
                echo json_encode(["message" => "Image uploaded successfully"]);
            } else {
                http_response_code(500); // Internal Server Error
                echo json_encode(["error" => "Sorry, there was an error uploading your file."]);
            }
        }
    }

    public function update($id) : void {
        $data = json_decode(file_get_contents('php://input'), true);
        $updateQuery = $this->userService->buildUpdateQuery($data);

        if ($updateQuery !== null) {
            try {
                $this->userService->updateUser($id, $updateQuery[0], $updateQuery[1]);
                http_response_code(200); // OK
                echo json_encode(["message" => "User updated successfully"]);
            } catch (Exception $e) {
                http_response_code(500); // Internal Server Error
                echo json_encode(["error" => "Error updating user: " . $e->getMessage()]);
            }
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(["error" => "No valid fields to update."]);
        }
    }
}