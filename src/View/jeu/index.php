<?php include 'src/View/templates/header_jeu.php'; ?>

<?php
$character = null;
foreach ($characters as $char) {
    if ($char['name'] === 'Le Ranger') {
        $character = $char;
        break;
    }
}
?>

<?php
$enemy = null;
foreach ($enemies as $enemy) {
    if ($enemy['name'] === 'Gobelin') {
        $enemies = $enemy;
        break;
    }
}
?>

<main>
    
<div class="game">

    <div class="game_char_sheet">
        <h6><?= $character["name"] ?></h6>
        <div class="stat-lign">
                <div class="text-stat"><p>Santé: </p></div>
                <div class="health"><?= $character["health"] ?></div>
            </div>
            <div class="stat-lign">
                <div class="text-stat"><p>Endurance: </p></div>
                <div class="stamina"><?= $character["stamina"] ?></div>
            </div>
            <div class="stat-lign">
                <div class="text-stat"><p>Mana: </p></div>
                <div class="mana"><?= $character["mana"] ?></div>
            </div>
    </div>

    <div class="game_window">
        <div class="window">
        <img class="img_battle" src="<?php echo $character['image_path']; ?>" alt="">
        <img class="img_battle" src="<?php echo $enemy['image_path']; ?>" alt="">
        </div>
        <div class="action_bar"></div>
    </div>

    <div class="game_enemy_sheet">
        <h6><?= $enemy["name"] ?></h6>
        <div class="stat-lign">
            <div class="text-stat"><p>Santé: </p></div>
            <div class="health"><?= $enemy["health"] ?></div>
        </div>
        <div class="stat-lign">
            <div class="text-stat"><p>Endurance: </p></div>
            <div class="stamina"><?= $enemy["stamina"] ?></div>
        </div>
        <div class="stat-lign">
            <div class="text-stat"><p>Mana: </p></div>
            <div class="mana"><?= $enemy["mana"] ?></div>
        </div>
    </div>

</div>

<div class="char_item"></div>


</main>

<?php include 'src/View/templates/footer.php'; ?>