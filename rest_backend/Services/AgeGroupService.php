<?php
require_once BASE_PATH . '/Models/AgeGroup.php';

class AgeGroupService{
    private $db;
    private $table;

    public function __construct($db, $table){
        $this->db = $db;
        $this->table = $table;
    }

    public function getAgeGroups(){
        $sql = "SELECT * FROM $this->table";
        $queryRes = $this->db->query($sql)->findAll();
        $res = [];
        foreach ($queryRes as $age_group) {
            $res[] = new AgeGroup($age_group['id'], $age_group['age_group'], $age_group['description']);
        }
        return $res;
    }

    public function getAgeGroup($id){
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $queryRes = $this->db->query($sql, [$id])->find();
        return new AgeGroup($queryRes['id'], $queryRes['age_group'], $queryRes['description']);
    }

}