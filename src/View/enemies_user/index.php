<?php include 'src/View/templates/header_user.php'; ?>


<h5>Ennemis</h5>

<div class="instruction">
    <div class="armor-type">
        <p class="unique-text" >Boss</p>
        <div class="sample boss"></div>
    </div>
</div>

<div class="card-container">
    <?php foreach($enemies as $enemy): ?>
    
    <div class="enemy_sheet_user <?= $enemy["is_boss"] ? 'is_boss' : 'is_not_boss' ?>">
        <div class="title-card">
            <h6><?= $enemy["name"] ?></h6>
        </div>
        <div class="img_card"><img src="<?php echo $enemy['image_path']; ?>" alt=""></div>
        <div class="stat_enemy_user">
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
    
    <?php endforeach; ?>
</div>



<?php include 'src/View/templates/footer.php'; ?>