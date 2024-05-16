<?php

namespace App\Controller;

use App\Model\ItemModel;

class ItemsUserController {

    protected $model;

    public function __construct() {
        // Instancier le modèle
        $this->model = new ItemModel();
    }

    public function index() {
        $items = $this->model->getAllItems();
        include 'src/View/items_user/index.php';
    }
}