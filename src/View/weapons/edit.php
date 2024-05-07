<?php include 'src/View/templates/header.php'; ?>

<form action="/weapons/update" method="post">
    <div class="formulaire">
        <div class="weapon_sheet">
            <legend>Arme</legend>
            <div class="hidden">
                <input type="hidden" id="id" name="id" value="<?= $weapon['id'] ?>">
            </div>
            <div class="name_wpn">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name" value="<?= $weapon['name'] ?>">
            </div>

            <div class="type_wpn">
                <label for="type">Type:</label>
                <input type="text" id="type" name="type" value="<?= $weapon['type'] ?>">
            </div>

            <div class="phy_dmg">
                <label for="phy_dmg">Dégâts Physiques:</label>
                <input type="number" id="phy_dmg" name="physical_damage" value="<?= $weapon['physical_damage'] ?>">
            </div> 
            
            <div class="ele_dmg">
                <label for="ele_dmg">Dégâts Elémentaux:</label>
                <input type="number" id="ele_dmg" name="elemental_damage" value="<?= $weapon['elemental_damage'] ?>">
            </div>

            <div class="unique">
                <label for="unique">Unique:</label>
                <input type="checkbox" id="unique" name="unique" <?= $weapon['unique'] ? 'checked' : '' ?> >
            </div>
            
            <div class="btn">
                <input type="submit" value="Mettre à jour">
                <a class="cancelbtn" href="/weapons">Annuler</a>
            </div>
        </div>
    </div>

</form>

<?php include 'src/View/templates/footer.php'; ?>