<?php

require_once BASE_PATH . '/Models/TimeOfDay.php';
class TimeOfDayService {
    private $curl;

    public function __construct($curl) {
        $this->curl = $curl;
    }

    public function get(int $id) {
        $res = $this->curl->get('/times_of_day/' . $id)['result'];
        $time = json_decode($res, true);
        return new TimeOfDay($time['id'], $time['timeOfDay'], $time['description']);
    }

    public function getAll() {
        $res = $this->curl->get('/times_of_day')['result'];
        $res = json_decode($res, true);

        $time_of_day = [];
        foreach ($res as $time) {
            $time_of_day[] = new TimeOfDay($time['id'], $time['timeOfDay'], $time['description']);
        }
        
        return $time_of_day;
    }
}