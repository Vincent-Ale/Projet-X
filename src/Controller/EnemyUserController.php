<?php

namespace App\Controller;

use App\Model\EnemyModel;

class EnemyUserController {

    protected $model;

    public function __construct() {
        // Instancier le modèle
        $this->model = new EnemyModel();
    }
    
    public function index() {
        $enemies = $this->model->getAllEnemies();
        include 'src/View/enemies_user/index.php';
    }
}