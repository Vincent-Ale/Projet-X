<?php

namespace App\Controller;

use App\Model\SpellModel;

class SpellController {
    private $model;

    public function __construct() {
        $this->model = new SpellModel();
    }

    public function index() {
        $spells = $this->model->getAllSpells();
        include 'src/View/spells/index.php';
    }
    public function create() {
        include 'src/View/spells/create.php';
    }
    
    public function store() {
        $name = $_POST['name'];
        $type = $_POST['type'];
        $power = $_POST['power'];
        $mana_cost = $_POST['mana_cost'];
        if (isset($_POST['unique'])) {
            $unique = 1;
        }
        else{
            $unique = 0;
        }

        $image_path = null;

        $crop_x = isset($_POST['crop_x']) ? (int)$_POST['crop_x'] : 0;
        $crop_y = isset($_POST['crop_y']) ? (int)$_POST['crop_y'] : 0;
        $crop_width = isset($_POST['crop_width']) ? (int)$_POST['crop_width'] : 0;
        $crop_height = isset($_POST['crop_height']) ? (int)$_POST['crop_height'] : 0;

        $rotate = isset($_POST['rotate']) ? (int)$_POST['rotate'] : 0;
        $mirror = isset($_POST['mirror']) ? json_decode($_POST['mirror'], true) : ['horizontal' => false, 'vertical' => false];

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

                        // Rotation de l'image si nécessaire
                        if ($rotate !== 0) {
                            $src_image = imagerotate($src_image, $rotate, 0);
                        }
    
                        // Miroir de l'image si nécessaire
                        if ($mirror['horizontal']) {
                            imageflip($src_image, IMG_FLIP_HORIZONTAL);
                        }
                        if ($mirror['vertical']) {
                            imageflip($src_image, IMG_FLIP_VERTICAL);
                        }
                        
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

        $this->model->addSpell($name, $type, $power, $mana_cost, $unique, $image_path);
        header('Location: /spells');
    }

    public function edit($id) {
        $spell = $this->model->getSpellById($id);
        include 'src/View/spells/edit.php';
    }
    
    public function update() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $type = $_POST['type'];
        $power = $_POST['power'];
        $mana_cost = $_POST['mana_cost'];
        if (isset($_POST['unique'])) {
            $unique = 1;
        }
        else{
            $unique = 0;
        }

        $crop_x = isset($_POST['crop_x']) ? (int)$_POST['crop_x'] : 0;
        $crop_y = isset($_POST['crop_y']) ? (int)$_POST['crop_y'] : 0;
        $crop_width = isset($_POST['crop_width']) ? (int)$_POST['crop_width'] : 0;
        $crop_height = isset($_POST['crop_height']) ? (int)$_POST['crop_height'] : 0;

        $rotate = isset($_POST['rotate']) ? (int)$_POST['rotate'] : 0;
        $mirror = isset($_POST['mirror']) ? json_decode($_POST['mirror'], true) : ['horizontal' => false, 'vertical' => false];
    
        $spell = $this->model->getSpellById($id);
        $image_path = $spell['image_path']; // Utilisez l'image existante par défaut
    
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

                        // Rotation de l'image si nécessaire
                        if ($rotate !== 0) {
                            $src_image = imagerotate($src_image, $rotate, 0);
                        }
    
                        // Miroir de l'image si nécessaire
                        if ($mirror['horizontal']) {
                            imageflip($src_image, IMG_FLIP_HORIZONTAL);
                        }
                        if ($mirror['vertical']) {
                            imageflip($src_image, IMG_FLIP_VERTICAL);
                        }
                        
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
                if ($spell['image_path'] && file_exists($spell['image_path'])) {
                    unlink($spell['image_path']);
                }

                $image_path = $file_path;  // Mettre à jour le chemin de l'image

            } else {
                // Gérer l'erreur de téléchargement
                echo "Erreur lors du téléchargement de l'image.";
                return;
            }

        $this->model->updateSpell($id, $name, $type, $power, $mana_cost, $unique, $image_path);
        header('Location: /spells');
        }
    }

    public function delete($id) {

        $spell = $this->model->getSpellById($id);
        $image_path = $spell['image_path'];

        // Supprimer l'image associée, si elle existe
        if (!empty($image_path)) {
            if (file_exists($image_path)) {
                unlink($image_path); // Suppression du fichier image
            }
        }
        $this->model->deleteSpell($id);
        header('Location: /spells');
    }
    
}

