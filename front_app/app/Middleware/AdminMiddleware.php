<?php

require_once BASE_PATH . '/app/Middleware/StartAuthMiddleware.php';

class AdminMiddleware extends StartAuthMiddleware {
    public function handle() {
        parent::handle();
        if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
            header('Location: /products');
        }
    }
}