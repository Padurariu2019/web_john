<?php

require_once 'ProductCategory.php';
require_once 'Zone.php';
require_once 'AgeGroup.php';

#[AllowDynamicProperties] class Product {
    public $id;
    public $name;
    public $brand;
    public $description;
    public $picture_path;
    public $likes;
    public $productCategoryId; //ID instead of object
    public $zoneId; //ID instead of object
    public $ageGroupId; //ID instead of object
    public $occasionIds; // Array of ints
    public $timeOfDayIds; // Array of ints

    public $skintypeIds; // Array of ints

    public function __construct($id, $name, $brand, $description, $picture_path, $likes, $productCategoryId, $zoneId, $ageGroupId, $occasionIds, $timeOfDayIds, $skintypeIds) {
        $this->id = $id;
        $this->name = $name;
        $this->brand = $brand;
        $this->description = $description;
        $this->picture_path = $picture_path;
        $this->likes = $likes;
        $this->productCategoryId = $productCategoryId;
        $this->zoneId = $zoneId;
        $this->ageGroupId = $ageGroupId;
        $this->occasionIds = $occasionIds;
        $this->timeOfDayIds = $timeOfDayIds;
        $this->skintypeIds = $skintypeIds;
    }

    public static function from_array($array) {
    }
}