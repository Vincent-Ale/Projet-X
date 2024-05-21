<?php

namespace App\Model;

use PDO;
use PDOException;

class Database {
    private static $instance = null;

    public static function getInstance() {
        if (self::$instance === null) {
            try {
                $host = 'db'; // Utilisez le nom du service Docker ici
                $dbname = 'naheulbeuk';
                $username = 'admin_donjon';
                $password = 'Donjon1234';

                $dsn = "mysql:host=$host;dbname=$dbname";
                self::$instance = new PDO($dsn, $username, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage(), (int)$e->getCode());
            }
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
