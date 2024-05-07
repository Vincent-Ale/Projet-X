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
        $unique
        ) {
        $stmt = $this->db->prepare("
        INSERT INTO `spell` (name, type, power, mana_cost, `unique`)
        VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $name,
            $type,
            $power,
            $mana_cost,
            $unique
        ]);
    }

    public function updateSpell(
        $id,
        $name,
        $type,
        $power,
        $mana_cost,
        $unique
        ) {
        $stmt = $this->db->prepare("
        UPDATE `spell` SET 
        name = :name,
        type = :type,
        power = :power,
        mana_cost = :mana_cost,
        `unique` = :unique
        WHERE id = :id"
    );
    $stmt->execute([
        'name' => $name,
        'type' => $type,
        'power' => $power,
        'mana_cost' => $mana_cost,
        'unique' => $unique,
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