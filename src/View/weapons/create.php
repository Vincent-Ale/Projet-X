<?php include 'src/View/templates/header.php'; ?>


<form method="post" action="/weapons/save">
    <div class="formulaire">
        <div class="weapon_sheet">
            <legend>Ajouter une Arme</legend>
            <div class="name_wpn">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name">
            </div>

            <div class="type_wpn">
                <label for="type">Type:</label>
                <input type="text" id="type" name="type">
            </div>

            <div class="phy_dmg">
                <label for="phy_dmg">Dégâts Physiques:</label>
                <input type="number" id="phy_dmg" name="physical_damage">
            </div> 
            
            <div class="ele_dmg">
                <label for="ele_dmg">Dégâts Elémentaux:</label>
                <input type="number" id="ele_dmg" name="elemental_damage">
            </div>

            <div class="unique">
                <label for="unique">Unique:</label>
                <input type="checkbox" id="unique" name="unique">
            </div>
            
            <div class="btn">
                <input type="submit" value="Ajouter">
                <a class="cancelbtn" href="/weapons">Annuler</a>
            </div>
        </div>
    </div>
</form>

<?php include 'src/View/templates/footer.php'; ?>