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

CREATE USER 'admin_donjon'@'%' IDENTIFIED BY 'Donjon1234';
GRANT ALL PRIVILEGES ON *.* TO 'admin_donjon'@'%';
FLUSH PRIVILEGES;

-- Listage de la structure de table naheulbeuk. armor
CREATE TABLE IF NOT EXISTS `armor` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `physical_resistance` int DEFAULT NULL,
  `magical_resistance` int DEFAULT NULL,
  `unique` tinyint(1) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table naheulbeuk.armor : ~8 rows (environ)
INSERT INTO `armor` (`id`, `name`, `type`, `physical_resistance`, `magical_resistance`, `unique`, `image_path`) VALUES
	(1, 'Wizard\'s Robe', 'Light', 5, 30, 0, 'assets/images\\6644630514925_Wizard\'s Robe.png'),
	(2, 'Archer\'s Tunic', 'Medium', 15, 10, 0, 'assets/images\\6644632981e4b_Archer\'s Tunic.png'),
	(3, 'Knight\'s plate', 'Heavy', 30, 5, 0, 'assets/images\\6644634c2d934_Knight\'s plate.png'),
	(5, 'Elf\'s Tunic', 'Medium', 15, 10, 0, 'assets/images\\66446664aff51_Elf\'s Tunic.png'),
	(6, 'Dwarf\'s plate', 'Heavy', 30, 5, 0, 'assets/images\\664463b4a55c4_Dwarf\'s plate.png'),
	(7, 'Slip', 'Light', 5, 5, 0, 'assets/images\\6644663f45cd1_Slip.png'),
	(12, 'Slip avec une tâche', 'Light', 1, 1, 1, 'assets/images\\664466347b716_Slip avec une tâche.png');

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
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table naheulbeuk.character : ~6 rows (environ)
INSERT INTO `character` (`id`, `name`, `level`, `health`, `health_max`, `mana`, `mana_max`, `stamina`, `stamina_max`, `EXP`, `EXP_max`, `image_path`) VALUES
	(1, 'Le Ranger', 1, 100, 100, 0, 0, 100, 100, 0, 100, 'assets/images\\6643637a44845_Le Ranger.png'),
	(2, 'L\'Elfe', 1, 100, 100, 0, 0, 100, 100, 0, 100, 'assets/images\\664363cbd3f70_L\'Elfe.png'),
	(3, 'Le Nain', 1, 100, 100, 0, 0, 100, 100, 0, 100, 'assets/images\\66436403cd232_Le Nain.png'),
	(4, 'La Magicienne', 1, 100, 100, 200, 200, 50, 50, 0, 100, 'assets/images\\6643644c49475_La Magicienne.png'),
	(5, 'Le Barbare', 1, 100, 100, 0, 0, 100, 100, 0, 100, 'assets/images\\664364af3c124_Le Barbare.png'),
	(6, 'L\'Ogre', 1, 100, 100, 0, 0, 100, 100, 0, 100, 'assets/images\\664365bac00c8_L\'Ogre.png');

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

-- Listage des données de la table naheulbeuk.character_has_armor : ~7 rows (environ)
INSERT INTO `character_has_armor` (`character_id`, `armor_id`) VALUES
	(1, 1),
	(4, 1),
	(1, 2),
	(5, 3),
	(2, 5),
	(3, 6),
	(6, 7);

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

-- Listage des données de la table naheulbeuk.character_has_spell : ~3 rows (environ)
INSERT INTO `character_has_spell` (`character_id`, `spell_id`) VALUES
	(4, 1),
	(4, 8),
	(4, 11);

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

-- Listage des données de la table naheulbeuk.character_has_weapon : ~6 rows (environ)
INSERT INTO `character_has_weapon` (`character_id`, `weapon_id`) VALUES
	(1, 1),
	(5, 2),
	(4, 5),
	(2, 8),
	(3, 11),
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
  `image_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table naheulbeuk.enemy : ~8 rows (environ)
INSERT INTO `enemy` (`id`, `name`, `health`, `health_max`, `mana`, `mana_max`, `stamina`, `stamina_max`, `attack`, `defense`, `is_boss`, `image_path`) VALUES
	(1, 'Gobelin', 100, 100, 0, 0, 100, 100, 20, 10, 0, 'assets/images\\6644a2f97f559_Gobelin.png'),
	(2, 'Archer Gobelin', 100, 100, 0, 0, 100, 100, 20, 10, 0, 'assets/images\\6644a3442e414_Archer Gobelin.png'),
	(3, 'Orc', 100, 100, 0, 0, 100, 100, 30, 15, 0, 'assets/images\\6644a3ccf3f1b_Orc.png'),
	(4, 'Sorcier', 100, 100, 200, 200, 50, 50, 35, 5, 0, 'assets/images\\6644a4299cfc1_Sorcier.png'),
	(5, 'Squelette', 100, 100, 0, 0, 100, 100, 25, 5, 0, 'assets/images\\6644a48279ce8_Squelette.png'),
	(6, 'Troll', 200, 200, 0, 0, 200, 200, 40, 20, 1, 'assets/images\\6644a4ce83098_Troll.png'),
	(9, 'Dragon de feu', 300, 300, 0, 0, 300, 300, 40, 30, 1, 'assets\\images\\6644a532f403c_Dragon de feu.png'),
	(10, 'Nécromancien', 100, 100, 200, 200, 100, 100, 20, 10, 0, 'assets/images\\6644a6b7910f7_Nécromancien.png');

-- Listage de la structure de table naheulbeuk. item
CREATE TABLE IF NOT EXISTS `item` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `power` int DEFAULT NULL,
  `unique` tinyint(1) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table naheulbeuk.item : ~4 rows (environ)
INSERT INTO `item` (`id`, `name`, `type`, `power`, `unique`, `image_path`) VALUES
	(14, 'Healing Potion', 'potion', 30, 0, 'assets/images\\6644977a92a0b_Healing Potion.png'),
	(15, 'Mana Potion', 'potion', 30, 0, 'assets/images\\66449845f1047_Mana Potion.png'),
	(16, 'Stamina Potion', 'potion', 30, 0, 'assets/images\\6644985203827_Stamina Potion.png'),
	(17, 'Special Potion', 'potion', 40, 0, 'assets/images\\6644985c6f05c_Special Potion.png');

-- Listage de la structure de table naheulbeuk. spell
CREATE TABLE IF NOT EXISTS `spell` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `power` int DEFAULT NULL,
  `mana_cost` int DEFAULT NULL,
  `unique` tinyint(1) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table naheulbeuk.spell : ~13 rows (environ)
INSERT INTO `spell` (`id`, `name`, `type`, `power`, `mana_cost`, `unique`, `image_path`) VALUES
	(1, 'Fireball', 'offensive', 20, 50, 0, 'assets/images\\6644779ba2125_Fireball.png'),
	(2, 'Iceshard', 'offensive', 20, 50, 0, 'assets/images\\664477df360fe_Iceshard.png'),
	(3, 'Lightning', 'offensive', 20, 50, 0, 'assets/images\\6644787754408_Lightning.png'),
	(4, 'Firewall', 'defensive', 10, 25, 0, 'assets/images\\6644797aacffc_Firewall.png'),
	(5, 'Storm', 'offensive', 30, 100, 0, 'assets/images\\66447d899a193_Storm.png'),
	(6, 'Lightbeam', 'offensive', 10, 50, 1, 'assets/images\\66447e0fc9855_Lightbeam.png'),
	(7, 'Calling Eagle', 'support', 100, 150, 1, 'assets/images\\66447c50b7d1c_Calling Eagle.png'),
	(8, 'Shockwave', 'offensive', 10, 100, 1, 'assets/images\\66447dc1b6b0c_Shockwave.png'),
	(9, 'Shield', 'defensive', 50, 100, 0, 'assets/images\\664479c86d67b_Shield.png'),
	(10, 'Revive', 'support', 100, 200, 0, 'assets/images\\66447d9be66eb_Revive.png'),
	(11, 'Healing', 'support', 50, 100, 0, 'assets/images\\66447a2787277_Healing.png'),
	(12, 'You shall not pass', 'defensive', 300, 100, 1, 'assets/images\\66447bcc6bc1a_You shall not pass.jpg'),
	(13, 'Secret fire', 'defensive', 200, 100, 1, 'assets/images\\66447b3e5acbc_Secret fire.png');

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
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `physical_damage` int DEFAULT NULL,
  `elemental_damage` int DEFAULT NULL,
  `unique` tinyint(1) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table naheulbeuk.weapon : ~19 rows (environ)
INSERT INTO `weapon` (`id`, `name`, `type`, `physical_damage`, `elemental_damage`, `unique`, `image_path`) VALUES
	(1, 'one-handed-sword', 'sword', 20, 0, 0, 'assets/images\\66434679a0ba8_one-handed-sword.png'),
	(2, 'two-handed-sword', 'sword', 35, 0, 0, 'assets/images\\664347f7b2d0a_two-handed-sword.png'),
	(3, 'one-handed-lightning-sword', 'sword', 20, 15, 1, 'assets/images\\66434a43baa2f_one-handed-lightning-sword.png'),
	(4, 'wand', 'magical', 1, 15, 0, 'assets/images\\66434a9c965c9_wand.png'),
	(5, 'staff', 'magical', 5, 30, 0, 'assets/images\\66434ae898bab_staff.png'),
	(6, 'book', 'magical', 1, 20, 0, 'assets/images\\66434bf45e612_book.png'),
	(7, 'Zangdar\'s Staff', 'magical', 5, 40, 1, 'assets/images\\66434c37b788e_Zangdar\'s Staff.png'),
	(8, 'short-bow', 'bow', 20, 0, 0, 'assets/images\\66434d6c009b8_short-bow.png'),
	(9, 'long-bow', 'bow', 30, 0, 0, 'assets/images\\66434d7dc56ba_long-bow.png'),
	(10, 'magical-rain-bow', 'bow', 15, 15, 1, 'assets/images\\66435bd705e4f_magical-rain-bow.png'),
	(11, 'one-handed-axe', 'axe', 15, 0, 0, 'assets/images\\66434ecc6f554_one-handed-axe.png'),
	(12, 'two-handed-axe', 'axe', 30, 0, 0, 'assets/images\\66434ee1105c8_two-handed-axe.png'),
	(13, 'two-handed-fire-axe', 'axe', 30, 15, 1, 'assets/images\\664350644dcd1_two-handed-fire-axe.png'),
	(14, 'dagger', 'dagger', 10, 0, 0, 'assets/images\\664353a687e19_dagger.png'),
	(15, 'poisoned-dagger', 'dagger', 10, 15, 1, 'assets/images\\6643541c65189_poisoned-dagger.png'),
	(16, 'Iron-hammer', 'hammer', 40, 0, 0, 'assets/images\\66435ac8c3bff_Iron-hammer.png'),
	(17, 'Iron-mace', 'hammer', 30, 0, 0, 'assets/images\\664359209f4f1_Iron-mace.png'),
	(18, 'King Dwarf\'s Hammer', 'hammer', 80, 15, 1, 'assets/images\\66435a1c93326_King Dwarf\'s Hammer.png'),
	(19, 'Club', 'hammer', 30, 0, 0, 'assets/images\\664357af1cd75_Club.png');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
