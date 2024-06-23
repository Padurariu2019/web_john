<?php

class AgeGroup {
    public $id;
    public $age_group;
    public $description;

    public function __construct($id, $age_group, $description) {
        $this->id = $id;
        $this->age_group = $age_group;
        $this->description = $description;
    }

    public static function from_array($array) {
        return new AgeGroup($array['id'],
                           $array['age_group'],
                           $array['description']);
    }
}