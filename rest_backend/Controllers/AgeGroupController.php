<?php
require_once BASE_PATH . '/Services/AgeGroupService.php';

class AgeGroupController {
    private AgeGroupService $ageGroupService;

    public function __construct(AgeGroupService $ageGroupService) {
        $this->ageGroupService = $ageGroupService;
    }

    public function get($path_params) : void {
        header('Content-Type: application/json');
        echo json_encode($this->ageGroupService->getAgeGroup($path_params['id']));
    }

    public function getAll() : void {
        header('Content-Type: application/json');
        echo json_encode($this->ageGroupService->getAgeGroups());
    }
}