<?php

namespace App\Controller;

use App\Model\ItemModel;

class ItemController {
    private $model;

    public function __construct() {
        $this->model = new ItemModel();
    }

    public function index() {
        $items = $this->model->getAllItems();
        include 'src/View/items/index.php';
    }
    public function create() {
        include 'src/View/items/create.php';
    }
    
    public function store() {
        $name = $_POST['name'];
        $type = $_POST['type'];
        $power = $_POST['power'];
        if (isset($_POST['unique'])) {
            $unique = 1;
        }
        else{
            $unique = 0;
        }
        $this->model->addItem($name, $type, $power, $unique);
        header('Location: /items');
    }

    public function edit($id) {
        $item = $this->model->getItemById($id);
        include 'src/View/items/edit.php';
    }
    
    public function update() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $type = $_POST['type'];
        $power = $_POST['power'];
        if (isset($_POST['unique'])) {
            $unique = 1;
        }
        else{
            $unique = 0;
        }
        $this->model->updateItem($id, $name, $type, $power, $unique);
        header('Location: /items');
    }

    public function delete($id) {
        $this->model->deleteItem($id);
        header('Location: /items');
    }
    
}

