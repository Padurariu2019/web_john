<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once BASE_PATH . '/Services/UserService.php';

class SigninController {
    public $userService;

    public function __construct($userService) {
        $this->userService = $userService;
    }

    public function sign_in() {
        session_start();
        $error = null;
        if (isset($_SESSION['error'])) {
            $error = $_SESSION['error'];
            unset($_SESSION['error']);
        }
        require BASE_PATH . '/Views/sign_in.php';
    }

    public function login($email, $password) {
        $response = $this->userService->getUserByEmail($email, $password);

        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        if ($response['statusCode'] === 200) {
            $user = json_decode($response['result']);
            if ($this->isUserCorrect($user, $password)) {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['is_admin'] = $user->user_role_id == 1 ? true : false;
                header('Location: /cosmetics');
                exit();
            }
            else {
                $_SESSION['error'] = 'Invalid email or password';
            }
        } else {
            $_SESSION['error'] = json_decode($response['result'])->error;
        }
        header('Location: /sign_in');
    }

    private function isUserCorrect($user, $password) {    
        if (md5($password, false) === $user->password) {
            return true;
        }
        return false;
    }

}