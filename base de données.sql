-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour naheulbeuk
CREATE DATABASE IF NOT EXISTS `naheulbeuk` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `naheulbeuk`;

-- Listage de la structure de table naheulbeuk. armor
CREATE TABLE IF NOT EXISTS `armor` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `physical_resistance` int DEFAULT NULL,
  `magical_resistance` int DEFAULT NULL,
  `unique` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table naheulbeuk.armor : ~11 rows (environ)
INSERT INTO `armor` (`id`, `name`, `type`, `physical_resistance`, `magical_resistance`, `unique`) VALUES
	(1, 'Wizard\'s Robe', 'Light', 5, 30, 0),
	(2, 'Archer\'s Tunic', 'Medium', 15, 10, 0),
	(3, 'Knight\'s plate', 'Heavy', 30, 5, 0),
	(4, 'Zangdar\'s Robe', 'Light', 5, 30, 1),
	(5, 'Elf\'s Tunic', 'Medium', 15, 10, 0),
	(6, 'Dwarf\'s plate', 'Heavy', 30, 5, 0),
	(7, 'Slip', 'Light', 5, 5, 0),
	(9, 'Slip2', 'Light', 5, 5, 0),
	(10, 'Slip3', 'Light', 5, 5, 0),
	(11, 'Slip4', 'Light', 5, 5, 0),
	(12, 'Slip avec une tâche', 'Light', 1, 1, 1);

-- Listage de la structure de table naheulbeuk. character
CREATE TABLE IF NOT EXISTS `character` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `level` int DEFAULT NULL,
  `health` int DEFAULT NULL,
  `health_max` int DEFAULT NULL,
  `mana` int DEFAULT NULL,
  `mana_max` int DEFAULT NULL,
  `stamina` int DEFAULT NULL,
  `stamina_max` int DEFAULT NULL,
  `EXP` int DEFAULT NULL,
  `EXP_max` int DEFAULT NULL,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `check_health_max` CHECK ((`health` <= `health_max`)),
  CONSTRAINT `check_mana_max` CHECK ((`mana` <= `mana_max`)),
  CONSTRAINT `check_stamina_max` CHECK ((`stamina` <= `stamina_max`))
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table naheulbeuk.character : ~7 rows (environ)
INSERT INTO `character` (`id`, `name`, `level`, `health`, `health_max`, `mana`, `mana_max`, `stamina`, `stamina_max`, `EXP`, `EXP_max`, `image_path`) VALUES
	(1, 'Le Ranger', 1, 100, 100, 0, 0, 100, 100, 0, 100, NULL),
	(2, 'L\'Elfe', 1, 100, 100, 0, 0, 100, 100, 0, 100, NULL),
	(3, 'Le Nain', 1, 100, 100, 0, 0, 100, 100, 0, 100, NULL),
	(4, 'La Magicienne', 1, 100, 100, 200, 200, 50, 50, 0, 100, NULL),
	(5, 'Le Barbare', 1, 100, 100, 0, 0, 100, 100, 0, 100, NULL),
	(6, 'L\'Ogre', 1, 100, 100, 0, 0, 100, 100, 0, 100, NULL),
	(52, 'Irene Ford', 14, 91, 800, 2, 310, 37, 1000, 70, 220, 'assets\\images\\6638e7533d3ed_Irene Ford.png');

-- Listage de la structure de table naheulbeuk. character_has_armor
CREATE TABLE IF NOT EXISTS `character_has_armor` (
  `character_id` int unsigned NOT NULL,
  `armor_id` int unsigned NOT NULL,
  PRIMARY KEY (`character_id`,`armor_id`),
  KEY `fk_character_has_character_armor_idx` (`armor_id`),
  KEY `fk_armor_has_character_armor_idx` (`character_id`),
  CONSTRAINT `fk_armor_has_character_armor` FOREIGN KEY (`armor_id`) REFERENCES `armor` (`id`),
  CONSTRAINT `fk_character_has_character_armor` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table naheulbeuk.character_has_armor : ~9 rows (environ)
INSERT INTO `character_has_armor` (`character_id`, `armor_id`) VALUES
	(1, 1),
	(4, 1),
	(1, 2),
	(5, 3),
	(2, 5),
	(3, 6),
	(6, 7),
	(52, 7),
	(52, 10);

-- Listage de la structure de table naheulbeuk. character_has_spell
CREATE TABLE IF NOT EXISTS `character_has_spell` (
  `character_id` int unsigned NOT NULL,
  `spell_id` int unsigned NOT NULL,
  PRIMARY KEY (`character_id`,`spell_id`),
  KEY `fk_character_has_character_spell_idx` (`spell_id`),
  KEY `fk_spell_has_character_spell_idx` (`character_id`),
  CONSTRAINT `fk_character_has_character_spell` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`),
  CONSTRAINT `fk_spell_has_character_spell` FOREIGN KEY (`spell_id`) REFERENCES `spell` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table naheulbeuk.character_has_spell : ~9 rows (environ)
INSERT INTO `character_has_spell` (`character_id`, `spell_id`) VALUES
	(4, 1),
	(52, 2),
	(52, 4),
	(52, 6),
	(4, 8),
	(52, 9),
	(4, 11),
	(52, 11),
	(52, 12);

-- Listage de la structure de table naheulbeuk. character_has_weapon
CREATE TABLE IF NOT EXISTS `character_has_weapon` (
  `character_id` int unsigned NOT NULL,
  `weapon_id` int unsigned NOT NULL,
  PRIMARY KEY (`character_id`,`weapon_id`),
  KEY `fk_character_has_character_weapon_idx` (`weapon_id`),
  KEY `fk_weapon_has_character_weapon_idx` (`character_id`),
  CONSTRAINT `fk_class_has_character_weapon` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`),
  CONSTRAINT `fk_weapon_has_character_weapon` FOREIGN KEY (`weapon_id`) REFERENCES `weapon` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table naheulbeuk.character_has_weapon : ~21 rows (environ)
INSERT INTO `character_has_weapon` (`character_id`, `weapon_id`) VALUES
	(1, 1),
	(52, 1),
	(5, 2),
	(52, 2),
	(4, 5),
	(52, 5),
	(52, 7),
	(2, 8),
	(52, 9),
	(3, 11),
	(52, 12),
	(52, 13),
	(52, 14),
	(52, 15),
	(52, 16),
	(52, 17),
	(52, 18),
	(6, 19);

-- Listage de la structure de table naheulbeuk. enemy
CREATE TABLE IF NOT EXISTS `enemy` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `health` int DEFAULT NULL,
  `health_max` int DEFAULT NULL,
  `mana` int DEFAULT NULL,
  `mana_max` int DEFAULT NULL,
  `stamina` int DEFAULT NULL,
  `stamina_max` int DEFAULT NULL,
  `attack` int DEFAULT NULL,
  `defense` int DEFAULT NULL,
  `is_boss` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table naheulbeuk.enemy : ~6 rows (environ)
INSERT INTO `enemy` (`id`, `name`, `health`, `health_max`, `mana`, `mana_max`, `stamina`, `stamina_max`, `attack`, `defense`, `is_boss`) VALUES
	(1, 'Gobelin', 100, 100, 0, 0, 100, 100, 20, 10, 0),
	(2, 'Archer Gobelin', 100, 100, 0, 0, 100, 100, 20, 10, 0),
	(3, 'Orc', 100, 100, 0, 0, 100, 100, 30, 15, 0),
	(4, 'Sorcier', 100, 100, 200, 200, 50, 50, 35, 5, 0),
	(5, 'Squelette', 100, 100, 0, 0, 100, 100, 25, 5, 0),
	(6, 'Troll', 200, 200, 0, 0, 200, 200, 40, 20, 1);

-- Listage de la structure de table naheulbeuk. spell
CREATE TABLE IF NOT EXISTS `spell` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `power` int DEFAULT NULL,
  `mana_cost` int DEFAULT NULL,
  `unique` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table naheulbeuk.spell : ~13 rows (environ)
INSERT INTO `spell` (`id`, `name`, `type`, `power`, `mana_cost`, `unique`) VALUES
	(1, 'Fireball', 'offensive', 20, 50, 0),
	(2, 'Iceshard', 'offensive', 20, 50, 0),
	(3, 'Lightning', 'offensive', 20, 50, 0),
	(4, 'Firewall', 'defensive', 10, 25, 0),
	(5, 'Storm', 'offensive', 30, 100, 0),
	(6, 'Lightbeam', 'offensive', 10, 50, 1),
	(7, 'Calling-Eagle', 'support', 100, 150, 1),
	(8, 'Shockwave', 'offensive', 10, 100, 1),
	(9, 'Shield', 'defensive', 50, 100, 0),
	(10, 'Revive', 'support', 100, 200, 0),
	(11, 'Healing', 'support', 50, 100, 0),
	(12, 'You_shall_not_pass', 'defensive', 300, 100, 1),
	(13, 'Secret_fire', 'defensive', 200, 100, 1);

-- Listage de la structure de table naheulbeuk. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table naheulbeuk.user : ~2 rows (environ)
INSERT INTO `user` (`id`, `username`, `password`, `email`, `is_admin`) VALUES
	(1, 'Admin', 'admin1234', 'admin@gmail.com', 1),
	(5, 'sjufgnhbisduj', 'admin1234', 'admin56651@gmail.com', 0);

-- Listage de la structure de table naheulbeuk. weapon
CREATE TABLE IF NOT EXISTS `weapon` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `physical_damage` int DEFAULT NULL,
  `elemental_damage` int DEFAULT NULL,
  `unique` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table naheulbeuk.weapon : ~20 rows (environ)
INSERT INTO `weapon` (`id`, `name`, `type`, `physical_damage`, `elemental_damage`, `unique`) VALUES
	(1, 'one-handed-sword', 'sword', 20, 0, 0),
	(2, 'two-handed-sword', 'sword', 35, 0, 0),
	(3, 'one-handed-lightning-sword', 'sword', 20, 15, 1),
	(4, 'wand', 'magical', 1, 15, 0),
	(5, 'staff', 'magical', 5, 30, 0),
	(6, 'book', 'magical', 1, 20, 0),
	(7, 'Zangdar\'s Staff', 'magical', 5, 40, 1),
	(8, 'short-bow', 'bow', 20, 0, 0),
	(9, 'long-bow', 'bow', 30, 0, 0),
	(10, 'magical-rain-bow', 'bow', 15, 15, 1),
	(11, 'one-handed-axe', 'axe', 15, 0, 0),
	(12, 'two-handed-axe', 'axe', 30, 0, 0),
	(13, 'two-handed-fire-axe', 'axe', 30, 15, 1),
	(14, 'dagger', 'dagger', 10, 0, 0),
	(15, 'poisoned-dagger', 'dagger', 10, 15, 1),
	(16, 'Iron-hammer', 'hammer', 40, 0, 0),
	(17, 'Iron-mace', 'hammer', 30, 0, 0),
	(18, 'King Dwarf\'s Mace', 'hammer', 80, 15, 1),
	(19, 'Club', 'hammer', 30, 0, 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
