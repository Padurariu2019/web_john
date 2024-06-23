<?php

class UserMiddleware extends Middleware {
    public function handle() {
        if (!isset($_SESSION['id'])) {
            header('Location: /login');
        }
    }
}