<?php

class UserRole{
    public $id;
    public $user_role;

    public function __construct($id, $user_role) {
        $this->id = $id;
        $this->user_role = $user_role;
    }

    public static function from_array($array) {
        return new UserRole($array['id'],
                           $array['user_role']);
    }
}