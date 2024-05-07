<?php

namespace App\Controller;

use App\Model\SpellModel;

class SpellController {
    private $model;

    public function __construct() {
        $this->model = new SpellModel();
    }

    public function index() {
        $spells = $this->model->getAllSpells();
        include 'src/View/spells/index.php';
    }
    public function create() {
        include 'src/View/spells/create.php';
    }
    
    public function store() {
        $name = $_POST['name'];
        $type = $_POST['type'];
        $power = $_POST['power'];
        $mana_cost = $_POST['mana_cost'];
        if (isset($_POST['unique'])) {
            $unique = 1;
        }
        else{
            $unique = 0;
        }
        $this->model->addSpell($name, $type, $power, $mana_cost, $unique);
        header('Location: /spells');
    }

    public function edit($id) {
        $spell = $this->model->getSpellById($id);
        include 'src/View/spells/edit.php';
    }
    
    public function update() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $type = $_POST['type'];
        $power = $_POST['power'];
        $mana_cost = $_POST['mana_cost'];
        if (isset($_POST['unique'])) {
            $unique = 1;
        }
        else{
            $unique = 0;
        }
        $this->model->updateSpell($id, $name, $type, $power, $mana_cost, $unique);
        header('Location: /spells');
    }

    public function delete($id) {
        $this->model->deleteSpell($id);
        header('Location: /spells');
    }
    
}

