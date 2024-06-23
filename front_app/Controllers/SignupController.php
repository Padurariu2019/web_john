<?php


class SignupController {

    private $userService;
    private $genderService;
    private $skinTypeService;
    private $socialStatusService;
    private $ageGroupService;

    public function __construct($userService, $genderService, $skinTypeService, $socialStatusService, $ageGroupService) {
        $this->userService = $userService;
        $this->genderService = $genderService;
        $this->skinTypeService = $skinTypeService;
        $this->socialStatusService = $socialStatusService;
        $this->ageGroupService = $ageGroupService;
    }

    public function index() {
        session_start();
        $genders = $this->genderService->getAll();
        $skinTypes = $this->skinTypeService->getAll();
        $socialStatuses = $this->socialStatusService->getAll();
        $ageGroups = $this->ageGroupService->getAll();

        $error = null;
        if (isset($_SESSION['error'])) {
            $error = $_SESSION['error'];
            unset($_SESSION['error']);
        }

        require BASE_PATH . '/Views/signup.php';
    }

    public function createUser() {
        $res = $this->userService->add(new UserDTO(
            $_POST['name'],
            $_POST['email'],
            $_POST['city'],
            $_POST['password'],
            (int)$_POST['gender'],
            (int)$_POST['age_group'],
            (int)$_POST['skin_type'],
            (int)$_POST['social_status']
        ));
        if ($res['statusCode'] == 201) {
            if (isset($_FILES['image']) && $_FILES['image']['error'] != 4) {
                $this->userService->uploadPic(json_decode($res['result'])->id, $_FILES['image']);
            }
            header('Location: /account');
        } else {
            session_start();
            $_SESSION['error'] = json_decode($res['result'])->error;
            header('Location: /');
        }
    }
}