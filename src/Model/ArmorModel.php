<?php

namespace App\Model;

use PDO;
use App\Model\Database;

class ArmorModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAllArmors() {
        $stmt = $this->db->query("SELECT * FROM `armor`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addArmor(
        $name,
        $type,
        $physical_resistance,
        $magical_resistance,
        $unique
        ) {
        $stmt = $this->db->prepare("
        INSERT INTO `armor` (name, type, physical_resistance, magical_resistance, `unique`)
        VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $name,
            $type,
            $physical_resistance,
            $magical_resistance,
            $unique
        ]);
    }

    public function updateArmor(
        $id,
        $name,
        $type,
        $physical_resistance,
        $magical_resistance,
        $unique
        ) {
        $stmt = $this->db->prepare("
        UPDATE `armor` SET 
        name = :name,
        type = :type,
        physical_resistance = :physical_resistance,
        magical_resistance = :magical_resistance,
        `unique` = :unique
        WHERE id = :id"
    );
    $stmt->execute([
        'name' => $name,
        'type' => $type,
        'physical_resistance' => $physical_resistance,
        'magical_resistance' => $magical_resistance,
        'unique' => $unique,
        'id' => $id
    ]);
    }

    public function getArmorById($id): array 
    {
    $stmt = $this->db->prepare("SELECT * FROM `armor` WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteArmor($id) {
    $stmt = $this->db->prepare("DELETE FROM `armor` WHERE id = ?");
    $stmt->execute([$id]);
}

}