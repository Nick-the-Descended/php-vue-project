<?php

namespace backend\config;

use mysqli;
use mysqli_result;

class Database {
    private mysqli $connection;

    public function __construct() {
        $this->connection = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        $this->connection->set_charset("utf8mb4");
    }

    public function execute(string $query): mysqli_result|bool
    {
        return $this->connection->query($query);
    }
}
