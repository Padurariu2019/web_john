<?php
require_once BASE_PATH . '/Models/UserRole.php';

class UserRoleService{
    private $db;
    private $table;

    public function __construct($db, $table){
        $this->db = $db;
        $this->table = $table;
    }

    public function getUserRole($id){
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $queryRes = $this->db->query($sql, [$id])->find();
        return new UserRole($queryRes['id'], $queryRes['user_role']);
    }
}
