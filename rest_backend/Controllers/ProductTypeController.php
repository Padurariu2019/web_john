<?php
require_once BASE_PATH . '/Services/ProductTypeService.php';

class ProductTypeController {
    private ProductTypeService $productTypeService;

    public function __construct(ProductTypeService $productTypeService) {
        $this->productTypeService = $productTypeService;
    }

    public function get($path_params, $query_params) : void {
        header('Content-Type: application/json');
        echo json_encode($this->productTypeService->getProductType($path_params['id']));
    }

    public function getAll() : void {
        header('Content-Type: application/json');
        echo json_encode($this->productTypeService->getProductTypes());
    }
}