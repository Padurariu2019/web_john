<?php
require_once BASE_PATH . '/Services/SkinTypeService.php';
require_once BASE_PATH . '/Services/AgeGroupService.php';
require_once BASE_PATH . '/Services/TimeOfDayService.php';

class SkinController {
    private $skinTypeService;
    private $ageGroupService;
    private $timeOfDayService;

    public function __construct($skinTypeService, $ageGroupService, $timeOfDayService) {
        $this->skinTypeService = $skinTypeService;
        $this->ageGroupService = $ageGroupService;
        $this->timeOfDayService = $timeOfDayService;
    }

    public function skin() {
        $skinTypes = $this->skinTypeService->getAll();
        $ageGroups = $this->ageGroupService->getAll();
        $timesOfDay = $this->timeOfDayService->getAll();
        require BASE_PATH . '/Views/skin.php';
    }
}
