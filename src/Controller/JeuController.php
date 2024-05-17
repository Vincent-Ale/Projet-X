<?php

namespace App\Controller;
use App\Model\CharacterModel;
use App\Model\WeaponModel;
use App\Model\ArmorModel;
use App\Model\SpellModel;
use App\Model\ItemModel;
use App\Model\EnemyModel;

class JeuController {

    protected $model;
    protected $modelweapon;
    protected $modelarmor;
    protected $modelspell;
    protected $modelitem;
    protected $modelenemy;

    public function __construct() {
        // Instancier le modèle
        $this->model = new CharacterModel();
        $this->modelweapon = new WeaponModel();
        $this->modelarmor = new ArmorModel();
        $this->modelspell = new SpellModel();
        $this->modelitem = new ItemModel();
        $this->modelenemy = new EnemyModel();
    }
    public function index() {
        $characters = $this->model->getAllCharacters();
        $weapons = $this->modelweapon->getAllWeapons();
        $armors = $this->modelarmor->getAllArmors();
        $spells = $this->modelspell->getAllSpells();
        $items = $this->modelitem->getAllItems();
        $enemies = $this->modelenemy->getAllEnemies();
        include 'src/View/jeu/index.php';
    }
}