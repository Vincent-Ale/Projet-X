<?php

namespace App\Model;

use PDO;
use App\Model\Database;

class SpellModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAllSpells() {
        $stmt = $this->db->query("SELECT * FROM `spell`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addSpell(
        $name,
        $type,
        $power,
        $mana_cost,
        $unique,
        $image_path
        ) {
        $stmt = $this->db->prepare("
        INSERT INTO `spell` (name, type, power, mana_cost, `unique`, image_path)
        VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $name,
            $type,
            $power,
            $mana_cost,
            $unique,
            $image_path
        ]);
    }

    public function updateSpell(
        $id,
        $name,
        $type,
        $power,
        $mana_cost,
        $unique,
        $image_path
        ) {
        $stmt = $this->db->prepare("
        UPDATE `spell` SET 
        name = :name,
        type = :type,
        power = :power,
        mana_cost = :mana_cost,
        `unique` = :unique,
        image_path = :image_path
        WHERE id = :id"
    );
    $stmt->execute([
        'name' => $name,
        'type' => $type,
        'power' => $power,
        'mana_cost' => $mana_cost,
        'unique' => $unique,
        'image_path'=> $image_path,
        'id' => $id
    ]);
    }

    public function getSpellById($id): array 
    {
    $stmt = $this->db->prepare("SELECT * FROM `spell` WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteSpell($id) {
    $stmt = $this->db->prepare("DELETE FROM `spell` WHERE id = ?");
    $stmt->execute([$id]);
}

}