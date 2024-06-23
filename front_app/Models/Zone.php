<?php

class Zone {
    public $id;
    public $zone;

    public function __construct($id, $zone) {
        $this->id = $id;
        $this->zone = $zone;
    }

    public static function from_array($array) {
        return new Zone($array['id'],
                           $array['zone']);
    }
}