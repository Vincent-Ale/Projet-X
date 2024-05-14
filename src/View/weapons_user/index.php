<?php include 'src/View/templates/header_user.php'; ?>

<h5>Armes</h5>

<div class="instruction">
    <div class="armor-type">
        <p class="unique-text" >Unique</p>
        <div class="sample unique"></div>
    </div>
</div>


<div class="card-container">
    <?php foreach($weapons as $weapon): ?>
    
    <div class="weapon_sheet_user <?= $weapon["unique"] ? 'unique' : 'non-unique' ?>">
        <div class="title-card">
            <h6><?= $weapon["name"] ?></h6>
        </div>
        <div class="img_card <?= $weapon["unique"] ? 'unique' : 'non-unique' ?>"><img src="<?php echo $weapon['image_path']; ?>" alt=""></div>
        <div class="stat_weapon_user">

        <div class="icon-weapon">
            <div class="allstat">
                <p class="atk-text">Dégâts</p>
                <div class="stat-lign">
                    <div class="text-stat-weapon"><p>Physique: </p></div>
                    <div class="physical_damage"><?= $weapon["physical_damage"] ?></div>
                </div>
                <div class="stat-lign">
                    <div class="text-stat-weapon" ><p>Magique: </p></div>
                    <div class="elemental_damage"><?= $weapon["elemental_damage"] ?></div>
                </div>
            </div>
            <div class="weapon_icon <?php echo strtolower($weapon["type"]); ?>"></div>
        </div>

        </div>
    </div>
    
    <?php endforeach; ?>
</div>



<?php include 'src/View/templates/footer.php'; ?>