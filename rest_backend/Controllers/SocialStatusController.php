<?php
require_once BASE_PATH . '/Services/SocialStatusService.php';

class SocialStatusController {
    private SocialStatusService $socialStatusService;

    public function __construct(SocialStatusService $socialStatusService) {
        $this->socialStatusService = $socialStatusService;
    }

    public function get($path_params, $query_params) : void {
        header('Content-Type: application/json');
        echo json_encode($this->socialStatusService->getSocialStatus($path_params['id']));
    }

    public function getAll() : void {
        header('Content-Type: application/json');
        echo json_encode($this->socialStatusService->getSocialStatuses());
    }
}