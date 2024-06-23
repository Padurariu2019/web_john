<?php

class AgeGroup {
    public $id;
    public $group;
    public $description;
    public function __construct($id, $group, $description) {
        $this->id = $id;
        $this->group = $group;
        $this->description = $description;
    }
}