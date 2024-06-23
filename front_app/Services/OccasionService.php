<?php

require_once BASE_PATH . '/Models/Occasion.php';
class OccasionService {
    private $curl;

    public function __construct($curl) {
        $this->curl = $curl;
    }

    public function get($id) {
        $res = $this->curl->get('/occasions/' . $id)['result'];
        $occasion = json_decode($res, true);
        return new Occasion($occasion['id'], $occasion['occasion'], $occasion['description']);
    }

    public function getAll() {
        $res = $this->curl->get('/occasions')['result'];
        $res = json_decode($res, true);

        $occasions = [];
        foreach ($res as $occasion) {
            $occasions[] = new Occasion($occasion['id'], $occasion['occasion'], $occasion['description']);
        }
        
        return $occasions;
    }
}