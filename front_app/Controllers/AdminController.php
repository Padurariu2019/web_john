<?php

class AdminController {
    private $productService;
    private $categoryService;
    private $zoneService;
    private $ageGroupService;
    private $occasionService;
    private $timeOfDayService;
    private $skinTypeService;

    public function __construct($productService, $categoryService, $zoneService, $ageGroupService, $occasionService, $timeOfDayService, $skinTypeService) {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->zoneService = $zoneService;
        $this->ageGroupService = $ageGroupService;
        $this->occasionService = $occasionService;
        $this->timeOfDayService = $timeOfDayService;
        $this->skinTypeService = $skinTypeService;
    }

    public function admin() {
        $categories = $this->categoryService->getAll();
        $zones = $this->zoneService->getAll();
        $ageGroups = $this->ageGroupService->getAll();
        $occasions = $this->occasionService->getAll();
        $timeOfDays = $this->timeOfDayService->getAll();
        $skinTypes = $this->skinTypeService->getAll();

        $error = null;
        if (isset($_SESSION['error'])) {
            $error = $_SESSION['error'];
            unset($_SESSION['error']);
        }

        require BASE_PATH . '/Views/admin.php';
    }

    public function addProduct() {
        $occasionIds = isset($_POST['occasion_ids']) ? array_map('intval', $_POST['occasion_ids']) : [];
        $timeOfDayIds = isset($_POST['time_of_day_ids']) ? array_map('intval', $_POST['time_of_day_ids']) : [];
        $skinTypeIds = isset($_POST['skintype_ids']) ? array_map('intval', $_POST['skintype_ids']) : [];

        $product = new Product(
            $_POST['name'],
            $_POST['brand'],
            $_POST['description'],
            (int)$_POST['category'],
            (int)$_POST['zone'],
            (int)$_POST['age-group'],
            $occasionIds,
            $timeOfDayIds,
            $skinTypeIds
        );

        $creationResult = $this->productService->add($product);
        if ($creationResult['statusCode'] == 201) {
            if (isset($_FILES['image'])) {
                $this->productService->uploadPic(json_decode($creationResult['result'])->id, $_FILES['image']);
            }
        } else {
            $_SESSION['error'] = json_decode($creationResult['result'])->error;
        }
        header('Location: /admin');
    }
}