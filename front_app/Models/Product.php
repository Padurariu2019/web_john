<?php

class Product {
    public $name;
    public $brand;
    public $description;
    public $product_category_id;
    public $zone_id;
    public $age_group_id;
    public $occasion_ids;
    public $time_of_day_ids;
    public $skintype_ids;

    public function __construct($name, $brand, $description, $product_category_id, $zone_id, $age_group_id, $occasion_ids, $time_of_day_ids, $skintype_ids) {
        $this->name = $name;
        $this->brand = $brand;
        $this->description = $description;
        $this->product_category_id = $product_category_id;
        $this->zone_id = $zone_id;
        $this->age_group_id = $age_group_id;
        $this->occasion_ids = $occasion_ids;
        $this->time_of_day_ids = $time_of_day_ids;
        $this->skintype_ids = $skintype_ids;
    }
}