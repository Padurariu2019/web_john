<?php
require_once BASE_PATH . '/Models/Gender.php';

class GenderService {
    private $db;
    private $table;

    public function __construct($db, $table) {
        $this->db = $db;
        $this->table = $table;
    }

    public function getGenders() {
        $sql = "SELECT * FROM $this->table";
        $queryRes = $this->db->query($sql)->findAll();
        $res = [];
        foreach ($queryRes as $gender) {
            $res[] = new Gender($gender['id'], $gender['gender']);
        }
        return $res;
    }

    public function getGender($id) {
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $queryRes = $this->db->query($sql, [$id])->find();
        return new Gender($queryRes['id'], $queryRes['gender']);
    }

}