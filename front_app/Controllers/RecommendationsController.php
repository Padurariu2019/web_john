<?php

class RecommendationsController {
    private AgeGroupService $ageGroupService;
    private SkinTypeService $skinTypeService;
    private OccasionService $occasionService;
    private TimeOfDayService $timeOfDayService;

    public function __construct($ageGroupService,
                                $skinTypeService,
                                $occasionService,
                                $timeOfDayService) {
        $this->ageGroupService = $ageGroupService;
        $this->skinTypeService = $skinTypeService;
        $this->occasionService = $occasionService;
        $this->timeOfDayService = $timeOfDayService;
    }

    public function recommendations() {
        $filters = [
            'age_group_id'=> $_POST['age_group'],
            'skintype_id'=> $_POST['skin_type'],
        ];

        $ageGroupData = $this->ageGroupService->get($_POST['age_group']);
        $skinTypeData = $this->skinTypeService->get($_POST['skin_type']);

        $pageData = [
            [
                "title" => "Age Group",
                "option" => $ageGroupData->group,
                "description" => $ageGroupData->description
            ],
            [
                "title" => "Skin Type",
                "option" => $skinTypeData->type,
                "description" => $skinTypeData->description
        ]];

        if (isset($_POST['occasion'])) {
            $filters['occasion_id'] = $_POST['occasion'];
            $occasionData = $this->occasionService->get($_POST['occasion']);
            $pageData[] = [
                "title" => "Occasion",
                "option" => $occasionData->occasion,
                "description" => $occasionData->description
            ];
        } else {
            $filters['time_of_day_id'] = $_POST['time_of_day'];
            $timeOfDayData = $this->timeOfDayService->get($_POST['time_of_day']);
            $pageData[] = [
                "title" => "Time of Day",
                "option" => $timeOfDayData->timeOfDay,
                "description" => $timeOfDayData->description
            ];
        }

        $apiUrl = "http://localhost:5050/api/v1";
        $filterString = '?' . http_build_query($filters);
        $userId = $_SESSION['user_id'];

        require BASE_PATH . '/Views/recommendations.php';
    }
}