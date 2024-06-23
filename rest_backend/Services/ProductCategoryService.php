<?php
require_once BASE_PATH . '/Models/ProductCategory.php';
require_once BASE_PATH . '/Services/ProductTypeService.php';

class ProductCategoryService{
    private Database $db;
    private string $table;
    private ProductTypeService $productTypeService;

    public function __construct(Database $db, string $table, ProductTypeService $productTypeService) {
        $this->db = $db;
        $this->table = $table;
        $this->productTypeService = $productTypeService;
    }

    public function getProductCategories() {
        $sql = "SELECT * FROM $this->table";
        $queryRes = $this->db->query($sql)->findAll();
        $res = [];
        foreach ($queryRes as $productCategory) {
            $productType = $this->productTypeService->getProductType($productCategory['product_type_id']);
            $res[] = new ProductCategory($productCategory['id'], $productCategory['product_category'], $productType);
        }
        return $res;
    }

    public function getProductCategory($id) {
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $queryRes = $this->db->query($sql, [$id])->find();
        $productType = $this->productTypeService->getProductType($queryRes['product_type_id']);
        return new ProductCategory($queryRes['id'], $queryRes['product_category'], $productType);
    }

}

