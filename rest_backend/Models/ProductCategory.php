<?php

require_once 'ProductType.php';

class ProductCategory {
    public $id;
    public $productType;
    public $category;

    public function __construct($id, $productType, $category) {
        $this->id = $id;
        $this->productType = $productType;
        $this->category = $category;
    }

    public static function from_array($array) {
        return new ProductCategory(null,
                                   ProductType::from_array($array),
                                   $array['category']);
    }
}