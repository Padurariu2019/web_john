<?php

require_once BASE_PATH . '/Models/AgeGroup.php';
class AgeGroupService {
    private $curl;

    public function __construct($curl_obj) {
        $this->curl = $curl_obj;
    }

    public function get(int $id) {
        $res = $this->curl->get('/age_groups/' . $id)['result'];
        $ageGroup = json_decode($res, true);
        return new AgeGroup($ageGroup['id'], $ageGroup['age_group'], $ageGroup['description']);
    }

    public function getAll() {
        $res = $this->curl->get('/age_groups')['result'];
        $res = json_decode($res, true);
        $ageGroups = [];
        foreach ($res as $ageGroup) {
            $ageGroups[] = new AgeGroup($ageGroup['id'], $ageGroup['age_group'], $ageGroup['description']);
        }
        return $ageGroups;
    }
}