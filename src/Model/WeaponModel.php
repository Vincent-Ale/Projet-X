<?php

namespace App\Model;

use PDO;
use App\Model\Database;

class WeaponModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAllWeapons() {
        $stmt = $this->db->query("SELECT * FROM `weapon`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addWeapon(
        $name,
        $type,
        $physical_damage,
        $elemental_damage,
        $unique,
        $image_path
        ) {
        $stmt = $this->db->prepare("
        INSERT INTO `weapon` (name, type, physical_damage, elemental_damage, `unique`, image_path)
        VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $name,
            $type,
            $physical_damage,
            $elemental_damage,
            $unique,
            $image_path
        ]);
    }

    public function updateWeapon(
        $id,
        $name,
        $type,
        $physical_damage,
        $elemental_damage,
        $unique,
        $image_path
        ) {
        $stmt = $this->db->prepare("
        UPDATE `weapon` SET 
        name = :name,
        type = :type,
        physical_damage = :physical_damage,
        elemental_damage = :elemental_damage,
        `unique` = :unique,
        image_path = :image_path
        WHERE id = :id"
    );
    $stmt->execute([
        'name' => $name,
        'type' => $type,
        'physical_damage' => $physical_damage,
        'elemental_damage' => $elemental_damage,
        'unique' => $unique,
        'image_path' => $image_path,
        'id' => $id
    ]);
    }

    public function getWeaponById($id): array 
    {
    $stmt = $this->db->prepare("SELECT * FROM `weapon` WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteWeapon($id) {
    $stmt = $this->db->prepare("DELETE FROM `weapon` WHERE id = ?");
    $stmt->execute([$id]);
}

}