<?php

class ProductType {
    public $id;
    public $type;

    public function __construct($id, $type) {
        $this->id = $id;
        $this->type = $type;
    }

    public static function from_array($array) {
        return new ProductType($array['id'],
                               $array['type']);
    }
}