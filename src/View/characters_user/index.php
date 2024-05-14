<?php include 'src/View/templates/header_user.php'; ?>


<h5>Personnages</h5>

<div class="card-container">
    <?php foreach($characters as $character): ?>
    
    <div class="char_sheet_user">
        <div class="title-card">
            <h6><?= $character["name"] ?></h6>
        </div>
        <div class="img_card"><img src="<?php echo $character['image_path']; ?>" alt=""></div>
        <div class="stat_char_user">
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
    </div>
    
    <?php endforeach; ?>
</div>



<?php include 'src/View/templates/footer.php'; ?>