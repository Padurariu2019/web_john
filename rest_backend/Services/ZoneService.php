<?php
require_once BASE_PATH . '/Models/Zone.php';

class ZoneService {
    private $db;
    private $table;

    public function __construct($db, $table) {
        $this->db = $db;
        $this->table = $table;
    }

    public function getZones() {
        $sql = "SELECT * FROM $this->table";
        $queryRes = $this->db->query($sql)->findAll();
        $res = [];
        foreach ($queryRes as $zone) {
            $res[] = new Zone($zone['id'], $zone['zone']);
        }
        return $res;
    }

    public function getZone($id) {
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $queryRes = $this->db->query($sql, [$id])->find();
        return new Zone($queryRes['id'], $queryRes['zone']);
    }

}