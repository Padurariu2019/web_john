<?php

require_once BASE_PATH . '/Models/Zone.php';
class ZoneService {
    private $curl;

    public function __construct($curl) {
        $this->curl = $curl;
    }

    public function getAll() {
        $res = $this->curl->get('/zones')['result'];
        $res = json_decode($res, true);

        $zones = [];
        foreach ($res as $zone) {
            $zones[] = new Zone($zone['id'], $zone['zone']);
        }
        
        return $zones;
    }
}