<?php
require_once BASE_PATH . '/Models/SkinType.php';

class SkinTypeService {
    private $db;
    private $table;

    public function __construct($db, $table) {
        $this->db = $db;
        $this->table = $table;
    }

    public function getSkinTypes() {
        $sql = "SELECT * FROM $this->table";
        $queryRes = $this->db->query($sql)->findAll();
        $res = [];
        foreach ($queryRes as $skinType) {
            $res[] = new SkinType($skinType['id'], $skinType['skintype'], $skinType['description']);
        }
        return $res;
    }

    public function getSkinType($id) {
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $queryRes = $this->db->query($sql, [$id])->find();
        return new SkinType($queryRes['id'], $queryRes['skintype'], $queryRes['description']);
    }

}