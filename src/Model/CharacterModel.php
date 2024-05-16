<?php

namespace App\Model;

use PDO;
use App\Model\Database;

class CharacterModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAllCharacters() {
        $stmt = $this->db->query("SELECT * FROM `character`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function weaponExistsForCharacter($character_id, $weapon_id) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM `character_has_weapon`
            WHERE character_id = :character_id AND weapon_id = :weapon_id
        ");
        $stmt->execute([
            ':character_id' => $character_id,
            ':weapon_id' => $weapon_id
        ]);
        // Retourne true si l'armure est associée au personnage, sinon false
        return $stmt->fetchColumn() > 0;
    }

    public function armorExistsForCharacter($character_id, $armor_id) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM `character_has_armor`
            WHERE character_id = :character_id AND armor_id = :armor_id
        ");
        $stmt->execute([
            ':character_id' => $character_id,
            ':armor_id' => $armor_id
        ]);
        // Retourne true si l'armure est associée au personnage, sinon false
        return $stmt->fetchColumn() > 0;
    }

    public function spellExistsForCharacter($character_id, $spell_id) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM `character_has_spell`
            WHERE character_id = :character_id AND spell_id = :spell_id
        ");
        $stmt->execute([
            ':character_id' => $character_id,
            ':spell_id' => $spell_id
        ]);
        // Retourne true si l'armure est associée au personnage, sinon false
        return $stmt->fetchColumn() > 0;
    }




    public function getCharacterWeapons($character_id) {
        $stmt = $this->db->prepare("
            SELECT weapon.*
            FROM `character_has_weapon`
            JOIN `weapon` ON character_has_weapon.weapon_id = weapon.id
            WHERE character_has_weapon.character_id = :character_id
        ");
        $stmt->execute([':character_id' => $character_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCharacterArmors($character_id) {
        $stmt = $this->db->prepare("
            SELECT armor.*
            FROM `character_has_armor`
            JOIN `armor` ON character_has_armor.armor_id = armor.id
            WHERE character_has_armor.character_id = :character_id
        ");
        $stmt->execute([':character_id' => $character_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCharacterSpells($character_id) {
        $stmt = $this->db->prepare("
            SELECT spell.*
            FROM `character_has_spell`
            JOIN `spell` ON character_has_spell.spell_id = spell.id
            WHERE character_has_spell.character_id = :character_id
        ");
        $stmt->execute([':character_id' => $character_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastCharacterID() {
        // Exécute la requête SQL pour obtenir l'ID maximal dans la table `character`
        $stmt = $this->db->query("SELECT MAX(id) AS last_id FROM `character`");
        
        // Récupère le résultat de la requête sous forme de tableau associatif
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Retourne l'ID du dernier caractère créé
        return $row['last_id'];
    }


    public function addCharacter(
        $name,
        $level,
        $health,
        $health_max,
        $mana,
        $mana_max,
        $stamina,
        $stamina_max,
        $exp,
        $exp_max,
        $image_path
        ) {
        $stmt = $this->db->prepare("
        INSERT INTO `character` (name, level, health, health_max, mana, mana_max, stamina, stamina_max, EXP, EXP_max, image_path)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $name,
            $level,
            $health,
            $health_max,
            $mana,
            $mana_max,
            $stamina,
            $stamina_max,
            $exp,
            $exp_max,
            $image_path
        ]);
    }

    // ===========================================
    // ADD lignes dans une table de jointure
    // ===========================================
    public function addWeaponToCharacter(
        $character_id,
        $weapon_id
        ) {
        $stmt = $this->db->prepare("
        INSERT INTO `character_has_weapon` (character_id, weapon_id)
        VALUES (?, ?)"
        );
        $stmt->execute([
            $character_id,
            $weapon_id
        ]);
    }

    public function addArmorToCharacter(
        $character_id,
        $armor_id
        ) {
        $stmt = $this->db->prepare("
        INSERT INTO `character_has_armor` (character_id, armor_id)
        VALUES (?, ?)"
        );
        $stmt->execute([
            $character_id,
            $armor_id
        ]);
    }

    public function addSpellToCharacter(
        $character_id,
        $spell_id
        ) {
        $stmt = $this->db->prepare("
        INSERT INTO `character_has_spell` (character_id, spell_id)
        VALUES (?, ?)"
        );
        $stmt->execute([
            $character_id,
            $spell_id
        ]);
    }

    // ===========================================
    // DELETE Lignes dans une table de jointure
    // ===========================================
    public function deleteWeaponToCharacter(
        $character_id
        ) {
        $stmt = $this->db->prepare("
        DELETE FROM `character_has_weapon` WHERE character_id = :character_id"
        );
        $stmt->execute([
            ':character_id' => $character_id
        ]);
    }

    public function deleteArmorToCharacter(
        $character_id
        ) {
        $stmt = $this->db->prepare("
        DELETE FROM `character_has_armor`WHERE character_id = :character_id"
        );
        $stmt->execute([
            ':character_id' => $character_id
        ]);
    }

    public function deleteSpellToCharacter(
        $character_id
        ) {
        $stmt = $this->db->prepare("
        DELETE FROM `character_has_spell`WHERE character_id = :character_id"
        );
        $stmt->execute([
            ':character_id' => $character_id
        ]);
    }


    public function updateCharacter(
        $id,
        $name,
        $level,
        $health,
        $health_max,
        $mana,
        $mana_max,
        $stamina,
        $stamina_max,
        $exp,
        $exp_max,
        $image_path
        ) {
        $stmt = $this->db->prepare("
        UPDATE `character` SET 
        name = :name,
        level = :level,
        health = :health,
        health_max = :health_max,
        mana = :mana,
        mana_max = :mana_max,
        stamina = :stamina,
        stamina_max = :stamina_max,
        exp = :exp,
        exp_max = :exp_max,
        image_path = :image_path WHERE id = :id"
    );
    $stmt->execute([
        'name' => $name,
        'level' => $level,
        'health' => $health,
        'health_max' => $health_max,
        'mana' => $mana,
        'mana_max' => $mana_max,
        'stamina' => $stamina,
        'stamina_max' => $stamina_max,
        'exp' => $exp,
        'exp_max' => $exp_max,
        'image_path' => $image_path,
        'id' => $id
    ]);
    }

    public function getCharacterById($id): array 
    {
    $stmt = $this->db->prepare("SELECT * FROM `character` WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteCharacter($id) {
    $stmt = $this->db->prepare("DELETE FROM `character` WHERE id = ?");
    $stmt->execute([$id]);
}

}