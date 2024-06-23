<?php


class ProductsController {
    public function products($queryParams) {
        $filterString = isset($queryParams['search']) ? "?search={$queryParams['search']}" : '';
        $apiUrl = "http://localhost:5050/api/v1";
        $userId = $_SESSION['user_id'];
        require BASE_PATH . '/Views/products.php';
    }
}