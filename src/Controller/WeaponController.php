<?php

namespace App\Controller;

use App\Model\WeaponModel;

class WeaponController {
    private $model;

    public function __construct() {
        $this->model = new WeaponModel();
    }

    public function index() {
        $weapons = $this->model->getAllWeapons();
        include 'src/View/weapons/index.php';
    }
    public function create() {
        include 'src/View/weapons/create.php';
    }
    
    public function store() {
        $name = $_POST['name'];
        $type = $_POST['type'];
        $physical_damage = $_POST['physical_damage'];
        $elemental_damage = $_POST['elemental_damage'];
        if (isset($_POST['unique'])) {
            $unique = 1;
        }
        else{
            $unique = 0;
        }
        $this->model->addWeapon($name, $type, $physical_damage, $elemental_damage, $unique);
        header('Location: /weapons');
    }

    public function edit($id) {
        $weapon = $this->model->getWeaponById($id);
        include 'src/View/weapons/edit.php';
    }
    
    public function update() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $type = $_POST['type'];
        $physical_damage = $_POST['physical_damage'];
        $elemental_damage = $_POST['elemental_damage'];
        if (isset($_POST['unique'])) {
            $unique = 1;
        }
        else{
            $unique = 0;
        }
        $this->model->updateWeapon($id, $name, $type, $physical_damage, $elemental_damage, $unique);
        header('Location: /weapons');
    }

    public function delete($id) {
        $this->model->deleteWeapon($id);
        header('Location: /weapons');
    }
    
}

