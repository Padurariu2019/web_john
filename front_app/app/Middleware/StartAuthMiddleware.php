<?php

require_once BASE_PATH . '/app/Middleware/Middleware.php';

class StartAuthMiddleware extends Middleware {
    public function handle() {
        session_start();
    }
}