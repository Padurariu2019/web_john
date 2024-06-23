<?php

require_once BASE_PATH . '/Models/Category.php';
class CategoryService {
    private $curl;

    public function __construct($curl) {
        $this->curl = $curl;
    }

    public function getAll() {
        $res = $this->curl->get('/product_categories')['result'];
        $res = json_decode($res, true);
        $categories = [];
        foreach ($res as $category) {
            $categories[] = new Category($category['id'], $category['productType']);
        }
        
        return $categories;
    }
}