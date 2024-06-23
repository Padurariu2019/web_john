<?php
require_once BASE_PATH . '/Models/Gender.php';
class GenderService {
    private $curl;
    public function __construct($curl) {
        $this->curl = $curl;
    }
    public function getAll() {
        $res = $this->curl->get('/genders')['result'];
        $res = json_decode($res, true);

        $genders = [];
        foreach ($res as $gender) {
            $genders[] = new Gender($gender['id'], $gender['gender']);
        }

        return $genders;
    }

    public function get(int $id) {
        $res = $this->curl->get('/genders/' . $id)['result'];
        $gender = json_decode($res, true);
        return new Gender($gender['id'], $gender['gender']);
    }
}