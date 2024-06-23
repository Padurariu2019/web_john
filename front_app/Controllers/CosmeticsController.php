<?php

class CosmeticsController {
    private OccasionService $occasionService;
    private AgeGroupService $ageGroupService;
    private SkinTypeService $skinTypeService;

    public function __construct(OccasionService $occasionService, AgeGroupService $ageGroupService, SkinTypeService $skinTypeService) {
        $this->occasionService = $occasionService;
        $this->ageGroupService = $ageGroupService;
        $this->skinTypeService = $skinTypeService;
    }

    public function cosmetics() {
        $occasions = $this->occasionService->getAll();
        $ageGroups = $this->ageGroupService->getAll();
        $skinTypes = $this->skinTypeService->getAll();

        // If the user's ID is stored in the session, the user is considered logged in
        // You can now proceed with displaying the cosmetics page
        require_once BASE_PATH . '/Views/cosmetics.php';
    }
}