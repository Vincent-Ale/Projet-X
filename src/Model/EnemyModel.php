<?php

namespace App\Model;

use PDO;
use App\Model\Database;

class EnemyModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAllEnemies() {
        $stmt = $this->db->query("SELECT * FROM `enemy`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function addEnemy(
        $name,
        $health,
        $health_max,
        $mana,
        $mana_max,
        $stamina,
        $stamina_max,
        $attack,
        $defense,
        $is_boss,
        $image_path
        ) {
        $stmt = $this->db->prepare("
        INSERT INTO `enemy` (name, health, health_max, mana, mana_max, stamina, stamina_max, attack, defense, is_boss, image_path)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $name,
            $health,
            $health_max,
            $mana,
            $mana_max,
            $stamina,
            $stamina_max,
            $attack,
            $defense,
            $is_boss,
            $image_path
        ]);
    }

    public function updateEnemy(
        $id,
        $name,
        $health,
        $health_max,
        $mana,
        $mana_max,
        $stamina,
        $stamina_max,
        $attack,
        $defense,
        $is_boss,
        $image_path
        ) {
        $stmt = $this->db->prepare("
        UPDATE `enemy` SET 
        name = :name,
        health = :health,
        health_max = :health_max,
        mana = :mana,
        mana_max = :mana_max,
        stamina = :stamina,
        stamina_max = :stamina_max,
        attack = :attack,
        defense= :defense,
        is_boss = :is_boss,
        image_path = :image_path
        WHERE id = :id"
    );
    $stmt->execute([
        'name' => $name,
        'health' => $health,
        'health_max' => $health_max,
        'mana' => $mana,
        'mana_max' => $mana_max,
        'stamina' => $stamina,
        'stamina_max' => $stamina_max,
        'attack'=> $attack,
        'defense'=> $defense,
        'is_boss'=> $is_boss,
        'image_path' => $image_path,
        'id' => $id
    ]);
    }

    public function getEnemyById($id): array 
    {
    $stmt = $this->db->prepare("SELECT * FROM `enemy` WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteEnemy($id) {
    $stmt = $this->db->prepare("DELETE FROM `enemy` WHERE id = ?");
    $stmt->execute([$id]);
}

}