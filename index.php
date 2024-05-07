<?php

require_once __DIR__.'/vendor/autoload.php';

// Initialiser Dotenv
use Symfony\Component\Dotenv\Dotenv;
use App\Router;
use App\Controller\HomeController;
use App\Controller\CharacterController;
use App\Controller\WeaponController;
use App\Controller\ArmorController;
use App\Controller\SpellController;
use App\Controller\ItemController;
use App\Controller\EnemyController;
use App\Controller\CodexController;
use App\Controller\CharactersUserController;
use App\Controller\ArmorsUserController;
use App\Controller\WeaponsUserController;
use App\Controller\SpellsUserController;
use App\Controller\EnemyUserController;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

session_start();

$router = new Router();

$router->register('GET', '/', function() {
    $controller = new HomeController();
    $controller->index();
});

// Codex Router ====================================

    $router->register('GET', '/codex', function() {
    $controller = new CodexController();
    $controller->index();
});

$router->register('GET', '/characters_user', function() {
    $controller = new CharactersUserController();
    $controller->index();
});

$router->register('GET', '/armors_user', function() {
    $controller = new ArmorsUserController();
    $controller->index();
});

$router->register('GET', '/weapons_user', function() {
    $controller = new WeaponsUserController();
    $controller->index();
});

$router->register('GET', '/spells_user', function() {
    $controller = new SpellsUserController();
    $controller->index();
});

$router->register('GET', '/enemies_user', function() {
    $controller = new EnemyUserController();
    $controller->index();
});


// Characters Router ====================================

$router->register('GET', '/characters', function() {
    $controller = new CharacterController();
    $controller->index();
});

$router->register('GET', '/characters/create', function() {
    $controller = new CharacterController();
    $controller->create();
});

$router->register('GET', '/characters/edit/{id}', function($id) {
    $controller = new CharacterController();
    $controller->edit($id);
});

$router->register('POST', '/characters/save', function() {
    $controller = new CharacterController();
    $controller->store();
});

// Mise à jour d'un personnage
$router->register('POST', '/characters/update', function() {
    $controller = new CharacterController();
    $controller->update();
});

// Suppression d'un personnage
$router->register('GET', '/characters/delete/{id}', function($id) {
    $controller = new CharacterController();
    $controller->delete($id);
});


// Weapons Router ====================================

$router->register('GET', '/weapons', function() {
    $controller = new WeaponController();
    $controller->index();
});

$router->register('GET', '/weapons/create', function() {
    $controller = new WeaponController();
    $controller->create();
});

$router->register('GET', '/weapons/edit/{id}', function($id) {
    $controller = new WeaponController();
    $controller->edit($id);
});

$router->register('POST', '/weapons/save', function() {
    $controller = new WeaponController();
    $controller->store();
});

// Mise à jour d'un personnage
$router->register('POST', '/weapons/update', function() {
    $controller = new WeaponController();
    $controller->update();
});

// Suppression d'un personnage
$router->register('GET', '/weapons/delete/{id}', function($id) {
    $controller = new WeaponController();
    $controller->delete($id);
});

// Armors Router ====================================

$router->register('GET', '/armors', function() {
    $controller = new ArmorController();
    $controller->index();
});

$router->register('GET', '/armors/create', function() {
    $controller = new ArmorController();
    $controller->create();
});

$router->register('GET', '/armors/edit/{id}', function($id) {
    $controller = new ArmorController();
    $controller->edit($id);
});

$router->register('POST', '/armors/save', function() {
    $controller = new ArmorController();
    $controller->store();
});

// Mise à jour d'un personnage
$router->register('POST', '/armors/update', function() {
    $controller = new ArmorController();
    $controller->update();
});

// Suppression d'un personnage
$router->register('GET', '/armors/delete/{id}', function($id) {
    $controller = new ArmorController();
    $controller->delete($id);
});



// Spells Router ====================================

$router->register('GET', '/spells', function() {
    $controller = new SpellController();
    $controller->index();
});

$router->register('GET', '/spells/create', function() {
    $controller = new SpellController();
    $controller->create();
});

$router->register('GET', '/spells/edit/{id}', function($id) {
    $controller = new SpellController();
    $controller->edit($id);
});

$router->register('POST', '/spells/save', function() {
    $controller = new SpellController();
    $controller->store();
});

// Mise à jour d'un personnage
$router->register('POST', '/spells/update', function() {
    $controller = new SpellController();
    $controller->update();
});

// Suppression d'un personnage
$router->register('GET', '/spells/delete/{id}', function($id) {
    $controller = new SpellController();
    $controller->delete($id);
});


// Items Router ====================================

$router->register('GET', '/items', function() {
    $controller = new ItemController();
    $controller->index();
});

$router->register('GET', '/items/create', function() {
    $controller = new ItemController();
    $controller->create();
});

$router->register('GET', '/items/edit/{id}', function($id) {
    $controller = new ItemController();
    $controller->edit($id);
});

$router->register('POST', '/items/save', function() {
    $controller = new ItemController();
    $controller->store();
});

$router->register('POST', '/items/update', function() {
    $controller = new ItemController();
    $controller->update();
});

$router->register('GET', '/items/delete/{id}', function($id) {
    $controller = new ItemController();
    $controller->delete($id);
});

// Enemies Router ====================================

$router->register('GET', '/enemies', function() {
    $controller = new EnemyController();
    $controller->index();
});

$router->register('GET', '/enemies/create', function() {
    $controller = new EnemyController();
    $controller->create();
});

$router->register('GET', '/enemies/edit/{id}', function($id) {
    $controller = new EnemyController();
    $controller->edit($id);
});

$router->register('POST', '/enemies/save', function() {
    $controller = new EnemyController();
    $controller->store();
});

// Mise à jour d'un personnage
$router->register('POST', '/enemies/update', function() {
    $controller = new EnemyController();
    $controller->update();
});

// Suppression d'un personnage
$router->register('GET', '/enemies/delete/{id}', function($id) {
    $controller = new EnemyController();
    $controller->delete($id);
});


$router->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));