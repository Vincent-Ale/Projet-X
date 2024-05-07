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
        $this->model->addArmor($name, $type, $physical_resistance, $magical_resistance, $unique);
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
        $this->model->updateArmor($id, $name, $type, $physical_resistance, $magical_resistance, $unique);
        header('Location: /armors');
    }

    public function delete($id) {
        $this->model->deleteArmor($id);
        header('Location: /armors');
    }
    
}

