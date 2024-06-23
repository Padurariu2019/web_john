<?php

require_once BASE_PATH . '/Models/SocialStatus.php';
class SocialStatusService {
    private $curl;
    public function __construct($curl) {
        $this->curl = $curl;
    }
    public function get(int $id) {
        $res = $this->curl->get('/social_statuses/' . $id)['result'];
        $socialStatus = json_decode($res, true);
        return new SocialStatus($socialStatus['id'], $socialStatus['status']);
    }

    public function getAll() {
        $res = $this->curl->get('/social_statuses')['result'];
        $res = json_decode($res, true);

        $socialStatuss = [];
        foreach ($res as $socialStatus) {
            $socialStatuss[] = new SocialStatus($socialStatus['id'], $socialStatus['status']);
        }
        return $socialStatuss;
    }
}