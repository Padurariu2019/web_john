<?php

require_once BASE_PATH . '/Models/SkinType.php';
class SkinTypeService {
    private $curl;
    public function __construct($curl) {
        $this->curl = $curl;
    }
    public function get(int $id) {
        $res = $this->curl->get('/skin_types/' . $id)['result'];
        $skinType = json_decode($res, true);
        return new SkinType($skinType['id'], $skinType['skinType'], $skinType['description']);
    }

    public function getAll() {
        $res = $this->curl->get('/skin_types')['result'];
        $res = json_decode($res, true);

        $skinTypes = [];
        foreach ($res as $skinType) {
            $skinTypes[] = new SkinType($skinType['id'], $skinType['skinType'], $skinType['description']);
        }
        return $skinTypes;
    }
}