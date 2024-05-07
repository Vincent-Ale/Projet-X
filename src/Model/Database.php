<?php

namespace App\Model;

use PDO;

class Database {
    private static $instance = null;

    private function __construct() {}

    /**
     * Get the instance of the database
     * @return PDO
     */
    public static function getInstance() {
        if (self::$instance === null) {
            $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=utf8';
            $username = $_ENV['DB_USER'];
            $password = $_ENV['DB_PASS'];
            self::$instance = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        return self::$instance;
    }
    /**
     * Test the connection to the database
     * @return array
     */
    public static function testConnection() {
        $conn = self::getInstance();
        $stmt = $conn->query("SHOW TABLES;");
        return $stmt->fetchAll();
    }
}