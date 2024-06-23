<?php

class LogoutController {
    public function logout() {
        deleteSession();
        header('Location: /');
    }
}