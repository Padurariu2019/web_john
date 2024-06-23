<?php
require_once BASE_PATH . '/Services/OccasionService.php';

class OccasionController {
    private OccasionService $occasionService;

    public function __construct(OccasionService $occasionService) {
        $this->occasionService = $occasionService;
    }

    public function get($path_params) : void {
        header('Content-Type: application/json');
        echo json_encode($this->occasionService->getOccasion($path_params['id']));
    }

    public function getAll() : void {
        header('Content-Type: application/json');
        echo json_encode($this->occasionService->getOccasions());
    }
}