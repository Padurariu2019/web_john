<?php
require_once BASE_PATH . '/Services/SkinTypeService.php';

class SkinTypeController {
    private SkinTypeService $skinTypeService;

    public function __construct(SkinTypeService $skinTypeService) {
        $this->skinTypeService = $skinTypeService;
    }

    public function get($path_params) : void {
        header('Content-Type: application/json');
        echo json_encode($this->skinTypeService->getSkinType($path_params['id']));
    }

    public function getAll() : void {
        header('Content-Type: application/json');
        echo json_encode($this->skinTypeService->getSkinTypes());
    }
}