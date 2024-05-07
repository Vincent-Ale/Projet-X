<?php

namespace App\Controller;

use App\Model\CharacterModel;
use App\Model\ArmorModel;
use App\Model\WeaponModel;
use App\Model\SpellModel;

class CharacterController {
    private $model;
    private $model_armor;
    private $model_weapon;
    private $model_spell;

    

    public function __construct() {
        $this->model = new CharacterModel();
        $this->model_armor = new ArmorModel();
        $this->model_spell = new SpellModel();
        $this->model_weapon = new WeaponModel();
    }

    public function index() {
        $characters = $this->model->getAllCharacters();
        include 'src/View/characters/index.php';
    }
    public function create() {
        $armors = $this->model_armor->getAllArmors();
        $weapons = $this->model_weapon->getAllWeapons();
        $spells = $this->model_spell->getAllSpells();
        include 'src/View/characters/create.php';
    }
    
    public function store() {
        $name = $_POST['name'];
        $level = $_POST['level'];
        $exp = $_POST['exp'];
        $exp_max = $_POST['exp_max'];
        $health = $_POST['health'];
        $health_max = $_POST['health_max'];
        $mana = $_POST['mana'];
        $mana_max = $_POST['mana_max'];
        $stamina = $_POST['stamina'];
        $stamina_max = $_POST['stamina_max'];

        $image_path = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = 'assets\images'; // Chemin du dossier d'uploads
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $filename = uniqid() . '_' . $name;
            $file_path = $upload_dir . DIRECTORY_SEPARATOR . $filename . '.' . $extension;

            if (!is_dir($upload_dir)) {
                echo "Le répertoire d'upload n'existe pas.";
                return;
            }

            if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {
                $image_path = $file_path;  // Mettre à jour le chemin de l'image
            } else {
                // Gérer l'erreur de téléchargement
                echo "Erreur lors du téléchargement de l'image.";
                return;
            }
        }

        $this->model->addCharacter($name, $level, $exp, $exp_max, $health, $health_max, $mana, $mana_max, $stamina, $stamina_max, $image_path);

        $last_id = $this->model->getLastCharacterID();

        // Initialisation des variables
            $selected_weapons = [];
            $selected_armors = [];
            $selected_spells = [];

        // Vérifier les identifiants d'objets et les lier au personnage
        if (isset($_POST['weapons'])) {
            $selected_weapons = array_map('intval', $_POST['weapons']);
            foreach ($selected_weapons as $weapon_id) {
            $this->model->addWeaponToCharacter($last_id, intval($weapon_id));
            }
        }
    
        if (isset($_POST['armors'])) {
            $selected_armors = array_map('intval', $_POST['armors']);
            foreach ($selected_armors as $armor_id) {
            $this->model->addArmorToCharacter($last_id, intval($armor_id));
            }
        }
    
        if (isset($_POST['spells'])) {
            $selected_spells = array_map('intval', $_POST['spells']);
            foreach ($selected_spells as $spell_id) {
            $this->model->addSpellToCharacter($last_id, intval($spell_id));
            }
        }
        
            header('Location: /characters');
    }


    public function edit($id) {
        $character = $this->model->getCharacterById($id);
        $armors = $this->model_armor->getAllArmors();
        $weapons = $this->model_weapon->getAllWeapons();
        $spells = $this->model_spell->getAllSpells();
        $characterWeapons = $this->model->getCharacterWeapons($character['id']);
        $weaponIds = array_column($characterWeapons, 'id');
        $characterArmors = $this->model->getCharacterArmors($character['id']);
        $armorIds = array_column($characterArmors, 'id');
        $characterSpells = $this->model->getCharacterSpells($character['id']);
        $spellIds = array_column($characterSpells, 'id');
        include 'src/View/characters/edit.php';
    }
    
    public function update() {
            // Récupérez les données du formulaire
            $id = $_POST['id'];
            $name = $_POST['name'];
            $level = $_POST['level'];
            $exp = $_POST['exp'];
            $exp_max = $_POST['exp_max'];
            $health = $_POST['health'];
            $health_max = $_POST['health_max'];
            $mana = $_POST['mana'];
            $mana_max = $_POST['mana_max'];
            $stamina = $_POST['stamina'];
            $stamina_max = $_POST['stamina_max'];
        
            // Obtenez les détails du personnage existant
            $character = $this->model->getCharacterById($id);

            // Traitez l'image téléchargée (s'il y en a une)
            $image_path = $character['image_path'];  // Utilisez l'image existante par défaut

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = 'assets/images';
                $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $filename = uniqid() . '_' . $name;
                $file_path = $upload_dir . DIRECTORY_SEPARATOR . $filename . '.' . $extension;

                if (!is_dir($upload_dir)) {
                    echo "Le répertoire d'upload n'existe pas.";
                    return;
                }

                if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {
                    // Supprimez l'ancienne image si elle existe
                    if ($character['image_path']) {
                        unlink($character['image_path']);
                    }
        
                    // Mettez à jour le chemin de l'image
                    $image_path = $file_path;
                } else {
                    // Gérez l'erreur de téléchargement
                    echo "Erreur lors du téléchargement de l'image.";
                    return;
                }
            }
            
              
        // Appelez la méthode updateCharacter avec les nouvelles données, y compris le chemin de l'image
        $this->model->updateCharacter($id, $name, $level, $exp, $exp_max, $health, $health_max, $mana, $mana_max, $stamina, $stamina_max, $image_path);
    

        // Code pour delete toutes les entrées des tables de jointures avec le personnage concerné
        
            $this->model->deleteWeaponToCharacter($id);
            $this->model->deleteArmorToCharacter($id);
            $this->model->deleteSpellToCharacter($id);

        // Pour recréer les liens entre les personnages avec les armes/armures/sorts dans les tables de jointures
        if (isset($_POST['weapons'])) {
            $selected_weapons = array_map('intval', $_POST['weapons']);
            foreach ($selected_weapons as $weapon_id) {
            $this->model->addWeaponToCharacter($id, intval($weapon_id));
            }
        }
    
        if (isset($_POST['armors'])) {
            $selected_armors = array_map('intval', $_POST['armors']);
            foreach ($selected_armors as $armor_id) {
            $this->model->addArmorToCharacter($id, intval($armor_id));
            }
        }
    
        if (isset($_POST['spells'])) {
            $selected_spells = array_map('intval', $_POST['spells']);
            foreach ($selected_spells as $spell_id) {
            $this->model->addSpellToCharacter($id, intval($spell_id));
            }
        }

        header('Location: /characters');
    }

    public function delete($id) {
        $this->model->deleteWeaponToCharacter($id);
        $this->model->deleteArmorToCharacter($id);
        $this->model->deleteSpellToCharacter($id);
        $this->model->deleteCharacter($id);
        header('Location: /characters');
    }
    
}

