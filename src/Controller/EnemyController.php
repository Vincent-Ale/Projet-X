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
        $health_max = $_POST['health_max'];
        $mana = $_POST['mana'];
        $mana_max = $_POST['mana_max'];
        $stamina = $_POST['stamina'];
        $stamina_max = $_POST['stamina_max'];
        $attack = $_POST['attack'];
        $defense = $_POST['defense'];
        if (isset($_POST['is_boss'])) {
            $is_boss = 1;
        }
        else{
            $is_boss = 0;
        }
        $this->model->addEnemy($name, $health, $health_max, $mana, $mana_max, $stamina, $stamina_max, $attack, $defense, $is_boss);
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
        $health_max = $_POST['health_max'];
        $mana = $_POST['mana'];
        $mana_max = $_POST['mana_max'];
        $stamina = $_POST['stamina'];
        $stamina_max = $_POST['stamina_max'];
        $attack = $_POST['attack'];
        $defense = $_POST['defense'];
        if (isset($_POST['is_boss'])) {
            $is_boss = 1;
        }
        else{
            $is_boss = 0;
        }
        $this->model->updateEnemy($id, $name, $health, $health_max, $mana, $mana_max, $stamina, $stamina_max, $attack, $defense, $is_boss);
        header('Location: /enemies');
    }

    public function delete($id) {
        $this->model->deleteEnemy($id);
        header('Location: /enemies');
    }
    
}

