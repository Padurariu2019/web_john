<?php

require_once BASE_PATH . '/Services/GenderService.php';

class GenderController {
    private GenderService $genderService;

    public function __construct(GenderService $genderService) {
        $this->genderService = $genderService;
    }

    public function get($path_params, $query_params) : void {
        header('Content-Type: application/json');
        echo json_encode($this->genderService->getGender($path_params['id']));
    }
    
    public function getAll() : void {
        header('Content-Type: application/json');
        echo json_encode($this->genderService->getGenders());
    }
}