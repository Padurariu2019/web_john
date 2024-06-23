<?php
require_once BASE_PATH . '/app/Middleware/StartAuthMiddleware.php';

class UserMiddleware extends StartAuthMiddleware {
    public function handle() {
        parent::handle();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /sign_in');
        }
    }
}