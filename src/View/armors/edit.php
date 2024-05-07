<?php include 'src/View/templates/header.php'; ?>

<form action="/armors/update" method="post">
    <div class="formulaire-armor">
        <div class="armor_sheet">
            <legend>Armure</legend>
            <div class="hidden">
                <input type="hidden" id="id" name="id" value="<?= $armor['id'] ?>">
            </div>
            <div class="name_wpn">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name" value="<?= $armor['name'] ?>">
            </div>

            <div class="type_wpn">
                <label for="type">Type:</label>
                <input type="text" id="type" name="type" value="<?= $armor['type'] ?>">
            </div>

            <div class="phy_resist">
                <label for="phy_resist">Résistance Physique:</label>
                <input type="number" id="phy_resist" name="physical_resistance" value="<?= $armor['physical_resistance'] ?>">
            </div> 
            
            <div class="ele_resist">
                <label for="ele_resist">Résistance Magique:</label>
                <input type="number" id="ele_resist" name="magical_resistance" value="<?= $armor['magical_resistance'] ?>">
            </div>

            <div class="unique">
                <label for="unique">Unique:</label>
                <input type="checkbox" id="unique" name="unique" <?= $armor['unique'] ? 'checked' : '' ?> >
            </div>
        </div>
        
        <div class="btn">
            <input type="submit" value="Mettre à jour">
            <a class="cancelbtn" href="/armors">Annuler</a>
        </div>
    </div>

</form>

<?php include 'src/View/templates/footer.php'; ?>