<?php
require_once BASE_PATH . '/Services/TimeOfDayService.php';

class TimeOfDayController {
    private TimeOfDayService $timeOfDayService;

    public function __construct(TimeOfDayService $timeOfDayService) {
        $this->timeOfDayService = $timeOfDayService;
    }

    public function get($path_params) : void {
        header('Content-Type: application/json');
        echo json_encode($this->timeOfDayService->getTimeOfDay($path_params['id']));
    }

    public function getAll() : void {
        header('Content-Type: application/json');
        echo json_encode($this->timeOfDayService->getTimeOfDays());
    }
}
