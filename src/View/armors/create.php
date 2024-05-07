<?php include 'src/View/templates/header.php'; ?>


<form method="post" action="/armors/save">
    <div class="formulaire">
        <div class="armor_sheet">
            <legend>Ajouter une Armure</legend>
            <div class="name_wpn">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name">
            </div>

            <div class="type_wpn">
                <label for="type">Type:</label>
                <input type="text" id="type" name="type">
            </div>

            <div class="phy_dmg">
                <label for="phy_dmg">Résistance Physique:</label>
                <input type="number" id="phy_dmg" name="physical_damage">
            </div> 
            
            <div class="ele_dmg">
                <label for="ele_dmg">Résistance Magique:</label>
                <input type="number" id="ele_dmg" name="elemental_damage">
            </div>

            <div class="unique">
                <label for="unique">Unique:</label>
                <input type="checkbox" id="unique" name="unique">
            </div>
            
            <div class="btn">
                <input type="submit" value="Ajouter">
                <a class="cancelbtn" href="/armors">Annuler</a>
            </div>
        </div>
    </div>
</form>

<?php include 'src/View/templates/footer.php'; ?>