<?php
require_once BASE_PATH . '/Services/ZoneService.php';

class ZoneController {
    private ZoneService $zoneService;

    public function __construct(ZoneService $zoneService) {
        $this->zoneService = $zoneService;
    }

    public function get($path_params, $query_params) : void {
        header('Content-Type: application/json');
        echo json_encode($this->zoneService->getZone($path_params['id']));
    }

    public function getAll() : void {
        header('Content-Type: application/json');
        echo json_encode($this->zoneService->getZones());
    }
}