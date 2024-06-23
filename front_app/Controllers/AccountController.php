<?php

class AccountController {
    private GenderService $genderService;
    private SkinTypeService $skinTypeService;
    private SocialStatusService $socialStatusService;
    private AgeGroupService $ageGroupService;
    private UserService $userService;

    public function __construct($genderService, $skinTypeService, $socialStatusService, $ageGroupService, $userService) {
        $this->genderService = $genderService;
        $this->skinTypeService = $skinTypeService;
        $this->socialStatusService = $socialStatusService;
        $this->ageGroupService = $ageGroupService;
        $this->userService = $userService;
    }

    public function account() {
        $userId = $_SESSION['user_id'];
        global $apiUrl;
        $genders = $this->genderService->getAll();
        $skinTypes = $this->skinTypeService->getAll();
        $socialStatuses = $this->socialStatusService->getAll();
        $ageGroups = $this->ageGroupService->getAll();
        require BASE_PATH . '/Views/account.php';
    }

    public function updateUser() {
        $res = $this->userService->update($_POST['id'], [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'city' => $_POST['city'],
            'gender_id' => (int)$_POST['gender'],
            'skin_type_id' => (int)$_POST['skin_type'],
            'social_status_id' => (int)$_POST['social_status'],
            'age_group_id' => (int)$_POST['age_group']
        ]);

        if ($res['statusCode'] === 200) {
            header('Location: /account');
        } else {
            echo 'Error updating user';
        }
    }
}