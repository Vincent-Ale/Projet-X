<?php include 'src/View/templates/header_user.php'; ?>

<h5>Armures</h5>

<div class="instruction">
    <div class="armor-type">
        <p>Légère</p>
        <div class="sample light"></div>
    </div>
    <div class="armor-type">
        <p>Moyenne</p>
        <div class="sample medium"></div>
    </div>
    <div class="armor-type">
        <p>Lourde</p>
        <div class="sample heavy"></div>
    </div>
    <div class="armor-type">
        <p class="unique-text" >Unique</p>
        <div class="sample unique"></div>
    </div>
</div>


<div class="card-container">
    <?php foreach($armors as $armor): ?>
    
    <div class="armor_sheet_user <?php echo strtolower($armor["type"]); ?> <?= $armor["unique"] ? 'unique' : 'non-unique' ?>">
        <div class="title-card">
            <h6><?= $armor["name"] ?></h6>
        </div>
        <div class="img_card <?= $armor["unique"] ? 'unique' : 'non-unique' ?>"><img src="<?php echo $armor['image_path']; ?>" alt=""></div>
        <div class="stat_char_user">
            <p class="def-text">Défense</p>
            <div class="stat-lign">
                <div class="text-stat-armor"><p>Physique: </p></div>
                <div class="physical_resistance"><?= $armor["physical_resistance"] ?></div>
            </div>
            <div class="stat-lign">
                <div class="text-stat-armor" ><p>Magique: </p></div>
                <div class="magical_resistance"><?= $armor["magical_resistance"] ?></div>
            </div>
        </div>
    </div>
    
    <?php endforeach; ?>
</div>



<?php include 'src/View/templates/footer.php'; ?>