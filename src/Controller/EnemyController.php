<?php

namespace App\Controller;

use App\Model\EnemyModel;

class EnemyController {
    private $model;

    public function __construct() {
        $this->model = new EnemyModel();
    }

    public function index() {
        $enemies = $this->model->getAllEnemies();
        include 'src/View/enemies/index.php';
    }
    public function create() {
        include 'src/View/enemies/create.php';
    }
    
    public function store() {
        $name = $_POST['name'];
        $health = $_POST['health'];
        $health_max = $_POST['health_max'];
        $mana = $_POST['mana'];
        $mana_max = $_POST['mana_max'];
        $stamina = $_POST['stamina'];
        $stamina_max = $_POST['stamina_max'];
        $attack = $_POST['attack'];
        $defense = $_POST['defense'];
        if (isset($_POST['is_boss'])) {
            $is_boss = 1;
        }
        else{
            $is_boss = 0;
        }

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

        $this->model->addEnemy($name, $health, $health_max, $mana, $mana_max, $stamina, $stamina_max, $attack, $defense, $is_boss, $image_path);
        header('Location: /enemies');
    }

    public function edit($id) {
        $enemy = $this->model->getEnemyById($id);
        include 'src/View/enemies/edit.php';
    }
    
    public function update() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $health = $_POST['health'];
        $health_max = $_POST['health_max'];
        $mana = $_POST['mana'];
        $mana_max = $_POST['mana_max'];
        $stamina = $_POST['stamina'];
        $stamina_max = $_POST['stamina_max'];
        $attack = $_POST['attack'];
        $defense = $_POST['defense'];
        if (isset($_POST['is_boss'])) {
            $is_boss = 1;
        }
        else{
            $is_boss = 0;
        }

        $enemy = $this->model->getEnemyById($id);
        $image_path = $enemy['image_path']; // Utilisez l'image existante par défaut
        
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
                if ($enemy['image_path'] && file_exists($enemy['image_path'])) {
                    unlink($enemy['image_path']);
                }
        
                // Mettez à jour le chemin de l'image
                $image_path = $filePath;
            }

        $this->model->updateEnemy($id, $name, $health, $health_max, $mana, $mana_max, $stamina, $stamina_max, $attack, $defense, $is_boss, $image_path);
        header('Location: /enemies');
    }

    public function delete($id) {
        $this->model->deleteEnemy($id);
        header('Location: /enemies');
    }
    
}

