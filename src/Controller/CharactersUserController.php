<?php

namespace App\Controller;

use App\Model\CharacterModel;

class CharactersUserController {

    protected $model;

    public function __construct() {
        // Instancier le modèle
        $this->model = new CharacterModel();
    }
    
    public function index() {
        $characters = $this->model->getAllCharacters();
        include 'src/View/characters_user/index.php';
    }
}