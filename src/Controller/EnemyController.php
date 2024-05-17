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
        $health_max = $health;
        $mana = $_POST['mana'];
        $mana_max = $mana;
        $stamina = $_POST['stamina'];
        $stamina_max = $stamina;
        $attack = $_POST['attack'];
        $defense = $_POST['defense'];
        if (isset($_POST['is_boss'])) {
            $is_boss = 1;
        }
        else{
            $is_boss = 0;
        }

        $image_path = null;

        $crop_x = isset($_POST['crop_x']) ? (int)$_POST['crop_x'] : 0;
        $crop_y = isset($_POST['crop_y']) ? (int)$_POST['crop_y'] : 0;
        $crop_width = isset($_POST['crop_width']) ? (int)$_POST['crop_width'] : 0;
        $crop_height = isset($_POST['crop_height']) ? (int)$_POST['crop_height'] : 0;

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = 'assets/images'; // Chemin du dossier d'uploads
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $filename = uniqid() . '_' . $name;
            $file_path = $upload_dir . DIRECTORY_SEPARATOR . $filename . '.' . $extension;

            if (!is_dir($upload_dir)) {
                echo "Le répertoire d'upload n'existe pas.";
                return;
            }

            if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {
                // Crop the image using GD Library
                if ($crop_width > 0 && $crop_height > 0) {
                    try {
                        $src_image = imagecreatefromstring(file_get_contents($file_path));
                        $cropped_image = imagecreatetruecolor($crop_width, $crop_height);
                        
                        // Keep transparency for PNG images
                        if ($extension === 'png') {
                            imagealphablending($cropped_image, false);
                            imagesavealpha($cropped_image, true);
                            $transparent = imagecolorallocatealpha($cropped_image, 0, 0, 0, 127);
                            imagefilledrectangle($cropped_image, 0, 0, $crop_width, $crop_height, $transparent);
                        }

                        imagecopyresampled(
                            $cropped_image,
                            $src_image,
                            0, 0,
                            $crop_x, $crop_y,
                            $crop_width, $crop_height,
                            $crop_width, $crop_height
                        );

                        if ($extension === 'png') {
                            imagepng($cropped_image, $file_path);
                        } else {
                            imagejpeg($cropped_image, $file_path);
                        }

                        imagedestroy($src_image);
                        imagedestroy($cropped_image);
                    } catch (Exception $e) {
                        echo 'Erreur lors du traitement de l\'image : ', $e->getMessage();
                        return;
                    }
                }
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
        $health_max = $health;
        $mana = $_POST['mana'];
        $mana_max = $mana;
        $stamina = $_POST['stamina'];
        $stamina_max = $stamina;
        $attack = $_POST['attack'];
        $defense = $_POST['defense'];
        if (isset($_POST['is_boss'])) {
            $is_boss = 1;
        }
        else{
            $is_boss = 0;
        }

        $crop_x = isset($_POST['crop_x']) ? (int)$_POST['crop_x'] : 0;
        $crop_y = isset($_POST['crop_y']) ? (int)$_POST['crop_y'] : 0;
        $crop_width = isset($_POST['crop_width']) ? (int)$_POST['crop_width'] : 0;
        $crop_height = isset($_POST['crop_height']) ? (int)$_POST['crop_height'] : 0;
    
        $enemy = $this->model->getEnemyById($id);
        $image_path = $enemy['image_path']; // Utilisez l'image existante par défaut
    
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Traitez l'image téléchargée
            $uploadDir = 'assets/images';
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $filename = uniqid() . '_' . $name . '.' . $extension;
            $file_path = $uploadDir . DIRECTORY_SEPARATOR . $filename;
    
            if (!is_dir($uploadDir)) {
                echo "Le répertoire d'upload n'existe pas.";
                return;
            }
    
            if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {
                // Crop the image using GD Library
                if ($crop_width > 0 && $crop_height > 0) {
                    try {
                        $src_image = imagecreatefromstring(file_get_contents($file_path));
                        $cropped_image = imagecreatetruecolor($crop_width, $crop_height);
                        
                        // Keep transparency for PNG images
                        if ($extension === 'png') {
                            imagealphablending($cropped_image, false);
                            imagesavealpha($cropped_image, true);
                            $transparent = imagecolorallocatealpha($cropped_image, 0, 0, 0, 127);
                            imagefilledrectangle($cropped_image, 0, 0, $crop_width, $crop_height, $transparent);
                        }

                        imagecopyresampled(
                            $cropped_image,
                            $src_image,
                            0, 0,
                            $crop_x, $crop_y,
                            $crop_width, $crop_height,
                            $crop_width, $crop_height
                        );

                        if ($extension === 'png') {
                            imagepng($cropped_image, $file_path);
                        } else {
                            imagejpeg($cropped_image, $file_path);
                        }

                        imagedestroy($src_image);
                        imagedestroy($cropped_image);
                    } catch (Exception $e) {
                        echo 'Erreur lors du traitement de l\'image : ', $e->getMessage();
                        return;
                    }
                }

                // Supprimez l'ancienne image si elle existe
                if ($enemy['image_path'] && file_exists($enemy['image_path'])) {
                    unlink($enemy['image_path']);
                }

                $image_path = $file_path;  // Mettre à jour le chemin de l'image

            } else {
                // Gérer l'erreur de téléchargement
                echo "Erreur lors du téléchargement de l'image.";
                return;
            }

        $this->model->updateEnemy($id, $name, $health, $health_max, $mana, $mana_max, $stamina, $stamina_max, $attack, $defense, $is_boss, $image_path);
        header('Location: /enemies');
        }
    }

    public function delete($id) {

        $enemy = $this->model->getEnemyById($id);
        $image_path = $enemy['image_path'];

        // Supprimer l'image associée, si elle existe
        if (!empty($image_path)) {
            if (file_exists($image_path)) {
                unlink($image_path); // Suppression du fichier image
            }
        }
        $this->model->deleteEnemy($id);
        header('Location: /enemies');
    }
    
}

