<?php include 'src/View/templates/header_user.php'; ?>

<h5>Sorts</h5>

<div class="instruction">
    <div class="armor-type">
        <p class="unique-text" >Unique</p>
        <div class="sample unique"></div>
    </div>
</div>


<div class="card-container">
    <?php foreach($spells as $spell): ?>
    
    <div class="spell_sheet_user <?= $spell["unique"] ? 'unique' : 'non-unique' ?>">
        <div class="title-card">
            <h6><?= $spell["name"] ?></h6>
        </div>
        <div class="img_card <?= $spell["unique"] ? 'unique' : 'non-unique' ?>"><img src="<?php echo $spell['image_path']; ?>" alt=""></div>
        <div class="stat_spell_user">

        
        <div class="allstat-spell">
            <div class="stat-lign">
                <div class="text-stat-spell" ><p>Type: </p></div>
                <div class="type <?php echo strtolower($spell["type"]); ?>"><?= $spell["type"] ?></div>
            </div>
            <div class="stat-lign">
                <div class="text-stat-spell"><p>Puissance: </p></div>
                <div class="power"><?= $spell["power"] ?></div>
            </div>
            <div class="stat-lign">
                <div class="text-stat-spell" ><p>Coût du sort: </p></div>
                <div class="mana_cost"><?= $spell["mana_cost"] ?></div>
            </div>
        </div>

        </div>
    </div>
    
    <?php endforeach; ?>
</div>



<?php include 'src/View/templates/footer.php'; ?>