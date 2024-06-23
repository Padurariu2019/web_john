<?php

class SkinType {
    public $id;
    public $skinType;
    public $description;

    public function __construct($id, $skinType, $description) {
        $this->id = $id;
        $this->skinType = $skinType;
        $this->description = $description;
    }
}