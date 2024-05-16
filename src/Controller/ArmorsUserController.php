<?php

namespace App\Controller;

use App\Model\ArmorModel;

class ArmorsUserController {

    protected $model;

    public function __construct() {
        // Instancier le modèle
        $this->model = new ArmorModel();
    }

    public function index() {
        $armors = $this->model->getAllArmors();
        include 'src/View/armors_user/index.php';
    }
}