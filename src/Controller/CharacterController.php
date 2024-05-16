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
        $health = $_POST['health'];
        $health_max = $health;
        $mana = $_POST['mana'];
        $mana_max = $mana;
        $stamina = $_POST['stamina'];
        $stamina_max = $stamina;
        $exp = 0;
        $exp_max = $_POST['exp_max'];

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

        $this->model->addCharacter($name, $level, $health, $health_max, $mana, $mana_max, $stamina, $stamina_max, $exp, $exp_max, $image_path);

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
            $health = $_POST['health'];
            $health_max = $health;
            $mana = $_POST['mana'];
            $mana_max = $mana;
            $stamina = $_POST['stamina'];
            $stamina_max = $stamina;
            $exp = 0;
            $exp_max = $_POST['exp_max'];
        
            // Obtenez les détails du personnage existant
            $character = $this->model->getCharacterById($id);
            $image_path = $character['image_path']; // Utilisez l'image existante par défaut
        
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Traitez l'image téléchargée
                $uploadDir = 'assets/images';
                $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $filename = uniqid() . '_' . $name . '.' . $extension;
                $filePath = $uploadDir . DIRECTORY_SEPARATOR . $filename;
        
                if (!is_dir($uploadDir)) {
                    echo "Le répertoire d'upload n'existe pas.";
                    return;
                }
        
                if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
                    // Vérifiez l'extension et le type MIME de l'image
                    $fileType = mime_content_type($filePath);
                    
                    if ($fileType == 'image/jpeg') {
                        $sourceImage = imagecreatefromjpeg($filePath);
                    } elseif ($fileType == 'image/png') {
                        $sourceImage = imagecreatefrompng($filePath);
                    } elseif ($fileType == 'image/gif') {
                        $sourceImage = imagecreatefromgif($filePath);
                    } else {
                        // Type d'image non pris en charge
                        echo "Le format d'image n'est pas pris en charge.";
                        return;
                    }
        
                    // Assurez-vous que l'image est correctement chargée
                    if (!$sourceImage) {
                        echo "Erreur lors du chargement de l'image.";
                        return;
                    }
        
                    // Recadrer l'image selon les données de recadrage
                    $cropX = isset($_POST['crop_x']) ? floatval($_POST['crop_x']) : 0;
                    $cropY = isset($_POST['crop_y']) ? floatval($_POST['crop_y']) : 0;
                    $cropWidth = isset($_POST['crop_width']) ? floatval($_POST['crop_width']) : 0;
                    $cropHeight = isset($_POST['crop_height']) ? floatval($_POST['crop_height']) : 0;
        
                    $croppedImage = imagecrop($sourceImage, [
                        'x' => $cropX,
                        'y' => $cropY,
                        'width' => $cropWidth,
                        'height' => $cropHeight,
                    ]);
        
                    if ($croppedImage) {
                        // Enregistrer l'image recadrée
                        imagejpeg($croppedImage, $filePath);
                    }
        
                    // Libérer les ressources
                    imagedestroy($sourceImage);
                    imagedestroy($croppedImage);
                } else {
                    echo "Erreur lors du téléchargement de l'image.";
                    return;
                }
        
                // Supprimez l'ancienne image si elle existe
                if ($character['image_path'] && file_exists($character['image_path'])) {
                    unlink($character['image_path']);
                }
        
                // Mettez à jour le chemin de l'image
                $image_path = $filePath;
            }
        
            // Appelez la méthode updateCharacter avec les nouvelles données, y compris le chemin de l'image
            $this->model->updateCharacter($id, $name, $level, $health, $health_max, $mana, $mana_max, $stamina, $stamina_max, $exp, $exp_max, $image_path);
       

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
        $character = $this->model->getCharacterById($id);
        $image_path = $character['image_path'];

        $this->model->deleteWeaponToCharacter($id);
        $this->model->deleteArmorToCharacter($id);
        $this->model->deleteSpellToCharacter($id);

        // Supprimer l'image associée, si elle existe
        if (!empty($image_path)) {
            if (file_exists($image_path)) {
                unlink($image_path); // Suppression du fichier image
            }
        }

        $this->model->deleteCharacter($id);
        header('Location: /characters');
    }
    
}

