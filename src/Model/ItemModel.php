<?php

namespace App\Model;

use PDO;
use App\Model\Database;

class ItemModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAllItems() {
        $stmt = $this->db->query("SELECT * FROM `item`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addItem(
        $name,
        $type,
        $power,
        $unique,
        $image_path
        ) {
        $stmt = $this->db->prepare("
        INSERT INTO `item` (name, type, power, `unique`, image_path)
        VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $name,
            $type,
            $power,
            $unique,
            $image_path
        ]);
    }

    public function updateItem(
        $id,
        $name,
        $type,
        $power,
        $unique,
        $image_path
        ) {
        $stmt = $this->db->prepare("
        UPDATE `item` SET 
        name = :name,
        type = :type,
        power = :power,
        `unique` = :unique,
        image_path = :image_path
        WHERE id = :id"
    );
    $stmt->execute([
        'name' => $name,
        'type' => $type,
        'power' => $power,
        'unique' => $unique,
        'image_path' => $image_path,
        'id' => $id
    ]);
    }

    public function getItemById($id): array 
    {
    $stmt = $this->db->prepare("SELECT * FROM `item` WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteItem($id) {
    $stmt = $this->db->prepare("DELETE FROM `item` WHERE id = ?");
    $stmt->execute([$id]);
}

}