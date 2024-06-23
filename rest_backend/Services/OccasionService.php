<?php
require_once BASE_PATH . '/Models/Occasion.php';

class OccasionService {
    private $db;
    private $table;

    public function __construct($db, $table) {
        $this->db = $db;
        $this->table = $table;
    }

    public function getOccasions() {
        $sql = "SELECT * FROM $this->table";
        $queryRes = $this->db->query($sql)->findAll();
        $res = [];
        foreach ($queryRes as $occasion) {
            $res[] = new Occasion($occasion['id'], $occasion['occasion'], $occasion['description']);
        }
        return $res;
    }

    public function getOccasion($id) {
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $queryRes = $this->db->query($sql, [$id])->find();
        return new Occasion($queryRes['id'], $queryRes['occasion'], $queryRes['description']);
    }

}

