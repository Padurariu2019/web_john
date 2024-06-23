<?php

class TimeOfDay {
    public $id;
    public $timeOfDay;
    public $description;

    public function __construct($id, $timeOfDay, $description) {
        $this->id = $id;
        $this->timeOfDay = $timeOfDay;
        $this->description = $description;
    }
}