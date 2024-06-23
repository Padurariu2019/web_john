<?php

class SkinType {
    public $id;
    public $type;
    public $description;
    public function __construct($id, $type, $description) {
        $this->id = $id;
        $this->type = $type;
        $this->description = $description;
    }
}