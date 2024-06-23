<?php

class Database
{
    private $connection;
    private $statement;

    public function __construct($database, $user, $password) {
        $dsn = 'mysql:' . http_build_query($database, '', ';');

        $this->connection = new PDO($dsn, $user, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    public function query($query, $params = []) {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params); //prevents SQL injection
        return $this;
    }

    public function findAll() {
        return $this->statement->fetchAll();
    }

    public function find() {
        return $this->statement->fetch();
    }

    public function statement() {
        return $this->statement();
    }

    public function lastInsertId() {
        return $this->connection->lastInsertId();
    }
}