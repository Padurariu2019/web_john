<?php
require_once BASE_PATH . '/Models/ProductType.php';

class ProductTypeService {
    private $db;
    private $table;

    public function __construct($db, $table) {
        $this->db = $db;
        $this->table = $table;
    }

    public function getProductTypes() {
        $sql = "SELECT * FROM $this->table";
        $queryRes = $this->db->query($sql)->findAll();
        $res = [];
        foreach ($queryRes as $productType) {
            $res[] = new ProductType($productType['id'], $productType['product_type']);
        }
        return $res;
    }

    public function getProductType($id) {
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $queryRes = $this->db->query($sql, [$id])->find();
        return new ProductType($queryRes['id'], $queryRes['product_type']);
    }


}