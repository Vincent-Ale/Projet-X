<?php include 'src/View/templates/header_user.php'; ?>

<h5>Objets</h5>

<div class="instruction">
    <div class="armor-type">
        <p class="unique-text" >Unique</p>
        <div class="sample unique"></div>
    </div>
</div>


<div class="card-container">
    <?php foreach($items as $item): ?>
    
    <div class="item_sheet_user <?= $item["unique"] ? 'unique' : 'non-unique' ?>">
        <div class="title-card">
            <h6><?= $item["name"] ?></h6>
        </div>
        <div class="img_card <?= $item["unique"] ? 'unique' : 'non-unique' ?>"><img src="<?php echo $item['image_path']; ?>" alt=""></div>
        <div class="stat_item_user">

        
        <div class="allstat-item">
            <div class="stat-lign">
                <div class="text-stat-item" ><p>Type: </p></div>
                <div class="type <?php echo strtolower($item["type"]); ?>"><?= $item["type"] ?></div>
            </div>
            <div class="stat-lign">
                <div class="text-stat-item"><p>Puissance: </p></div>
                <div class="power"><?= $item["power"] ?></div>
            </div>
        </div>

        </div>
    </div>
    
    <?php endforeach; ?>
</div>



<?php include 'src/View/templates/footer.php'; ?>