<?php

namespace App\Controller;

use App\Model\WeaponModel;

class WeaponsUserController {

    protected $model;

    public function __construct() {
        // Instancier le modèle
        $this->model = new WeaponModel();
    }
    public function index() {
        $weapons = $this->model->getAllWeapons();
        include 'src/View/weapons_user/index.php';
    }
}