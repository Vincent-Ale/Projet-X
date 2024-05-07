<?php

class UserModel {
    protected $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    // Méthodes pour interagir avec la base de données
}