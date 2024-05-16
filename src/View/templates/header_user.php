<?php
$date = new DateTime();
$dateString = $date->format('Y-m-d H:i:s');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_ENV['APP_NAME'] ?></title>
    <link rel="stylesheet" href="<?= '/assets/css/style.css?version='.$dateString ?>">
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=Bangers:300,400,500,600,700,800">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script src="/assets/js/main.js" defer></script>

</head>
<h1>Le Donjon de Besançon</h1>

<div class="flame" ><img src="/assets/images/background/flame.gif" alt=""></div>
<div class="flame2" ><img src="/assets/images/background/flame.gif" alt=""></div>

<body class="admin_page">
<header>

    <nav>
        <div class="menu_user">
            <ul>
                <li><a href="/">Accueil</a></li>
                <li><a href="/">Mes Equipes</a></li>
                <li><a href="/codex">Le Codex</a></li>
                <li><a href="/">Mes Scores</a></li>
                <li><a href="/">Administration du site</a></li>
                <li><a href="/">Déconnexion</a></li>
            </ul>
        </div>
    </nav>

    <nav>
    <div class="menu_codex">
            <ul>
                <li class="choice_user" >Choisir une liste : </li>
                <li><a href="/characters_user">Les Personnages</a></li>
                <li><a href="/weapons_user">Les Armes</a></li>
                <li><a href="/armors_user">Les Armures</a></li>
                <li><a href="/spells_user">Les Sorts</a></li>
                <li><a href="/items_user">Les Objets</a></li>
                <li><a href="/enemies_user">Les Méchants</a></li>
            </ul>
        </div>
    </nav>
</header>