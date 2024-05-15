<?php

namespace App\Controller;

use App\Model\SpellModel;

class SpellsUserController {

    protected $model;

    public function __construct() {
        // Instancier le modèle
        $this->model = new SpellModel();
    }

    public function index() {
        $spells = $this->model->getAllSpells();
        include 'src/View/spells_user/index.php';
    }
}