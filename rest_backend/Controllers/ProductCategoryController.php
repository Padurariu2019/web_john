<?php
require_once BASE_PATH . '/Services/ProductCategoryService.php';

class ProductCategoryController {
    private ProductCategoryService $productCategoryService;

    public function __construct(ProductCategoryService $productCategoryService) {
        $this->productCategoryService = $productCategoryService;
    }

    public function get($path_params, $query_params) : void {
        header('Content-Type: application/json');
        echo json_encode($this->productCategoryService->getProductCategory($path_params['id']));
    }

    public function getAll() : void {
        header('Content-Type: application/json');
        echo json_encode($this->productCategoryService->getProductCategories());
    }
}