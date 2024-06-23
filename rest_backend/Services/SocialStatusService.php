<?php
require_once BASE_PATH . '/Models/SocialStatus.php';

class SocialStatusService {
    private $db;
    private $table;

    public function __construct($db, $table) {
        $this->db = $db;
        $this->table = $table;
    }

    public function getSocialStatuses() {
        $sql = "SELECT * FROM $this->table";
        $queryRes = $this->db->query($sql)->findAll();
        $res = [];
        foreach ($queryRes as $socialStatus) {
            $res[] = new SocialStatus($socialStatus['id'], $socialStatus['social_status']);
        }
        return $res;
    }

    public function getSocialStatus($id) {
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $queryRes = $this->db->query($sql, [$id])->find();
        return new SocialStatus($queryRes['id'], $queryRes['social_status']);
    }


}