<?php
require_once BASE_PATH . '/Models/TimeOfDay.php';

class TimeOfDayService {
    private $db;
    private $table;

    public function __construct($db, $table) {
        $this->db = $db;
        $this->table = $table;
    }

    public function getTimeOfDays() {
        $sql = "SELECT * FROM $this->table";
        $queryRes = $this->db->query($sql)->findAll();
        $res = [];
        foreach ($queryRes as $timeOfDay) {
            $res[] = new TimeOfDay($timeOfDay['id'], $timeOfDay['time_of_day'], $timeOfDay['description']);
        }
        return $res;
    }

    public function getTimeOfDay($id) {
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $queryRes = $this->db->query($sql, [$id])->find();
        return new TimeOfDay($queryRes['id'], $queryRes['time_of_day'], $queryRes['description']);
    }

}