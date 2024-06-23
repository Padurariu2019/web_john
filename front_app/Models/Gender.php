<?php

class Gender {
    public $id;
    public $gender;
    public function __construct($id, $gender) {
        $this->id = $id;
        $this->gender = $gender;
    }
}