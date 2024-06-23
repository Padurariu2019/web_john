<?php

class Category {
    public $id;
    public $product_category;

    public function __construct($id, $product_category) {
        $this->id = $id;
        $this->product_category = $product_category;
    }
}