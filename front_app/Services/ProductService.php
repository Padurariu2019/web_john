<?php

require_once BASE_PATH . '/Models/Product.php';
class ProductService {
    private $curl;
    public function __construct($curl) {
        $this->curl = $curl;
    }
    public function getAll($filters = []) {
        $url = '/products';
        $queryParams = count($filters) > 0 ? '?' . http_build_query($filters) : '';
        return $this->curl->get($url . $queryParams);
    }
    
    public function get(int $id) {
        throw new Exception('Not implemented');
    }

    public function add(Product $product) {
        return $this->curl->post('/products', json_encode($product));
    }

    public function uploadPic(int $id, $file) {
        $this->curl->upload('/products/' . $id . '/image', $file);
    }
}