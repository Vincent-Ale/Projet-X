<?php

namespace App\Controller;

use App\Model\ArmorModel;

class ArmorController {
    private $model;

    public function __construct() {
        $this->model = new ArmorModel();
    }

    public function index() {
        $armors = $this->model->getAllArmors();
        include 'src/View/armors/index.php';
    }
    public function create() {
        include 'src/View/armors/create.php';
    }
    
    public function store() {
        $name = $_POST['name'];
        $type = $_POST['type'];
        $physical_resistance = $_POST['physical_resistance'];
        $magical_resistance = $_POST['magical_resistance'];
        if (isset($_POST['unique'])) {
            $unique = 1;
        }
        else{
            $unique = 0;
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

        $this->model->addArmor($name, $type, $physical_resistance, $magical_resistance, $unique, $image_path);
        header('Location: /armors');
    }

    public function edit($id) {
        $armor = $this->model->getArmorById($id);
        include 'src/View/armors/edit.php';
    }
    
    public function update() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $type = $_POST['type'];
        $physical_resistance = $_POST['physical_resistance'];
        $magical_resistance = $_POST['magical_resistance'];
        if (isset($_POST['unique'])) {
            $unique = 1;
        }
        else{
            $unique = 0;
        }

        $armor = $this->model->getArmorById($id);
        $image_path = $armor['image_path']; // Utilisez l'image existante par défaut
        
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
                if ($armor['image_path'] && file_exists($armor['image_path'])) {
                    unlink($armor['image_path']);
                }
        
                // Mettez à jour le chemin de l'image
                $image_path = $filePath;
            }

        $this->model->updateArmor($id, $name, $type, $physical_resistance, $magical_resistance, $unique, $image_path);
        header('Location: /armors');
    }

    public function delete($id) {
        $this->model->deleteArmor($id);
        header('Location: /armors');
    }
    
}

