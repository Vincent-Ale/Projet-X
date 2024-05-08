<?php include 'src/View/templates/header.php'; ?>


<form method="post" action="/enemies/save">
    <div class="formulaire">
        <div class="enemy_sheet">
            <legend>Ajouter un nouvel Enemi</legend>
            <div class="name_char">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="vie">
                <div class="labeltop">
                    <label for="health">Santé:</label>
                    <input type="number" id="health" name="health">
                </div>
                <div class="labeltop">
                    <label for="health_max">Santé Max:</label>
                    <input type="number" id="health_max" name="health_max">
                </div>
            </div>
            <div class="mana">
                <div class="labeltop">
                    <label for="mana">Mana:</label>
                    <input type="number" id="mana" name="mana">
                </div>
                <div class="labeltop">
                    <label for="mana_max">Mana Max:</label>
                    <input type="number" id="mana_max" name="mana_max">
                </div>
            </div>
            <div class="stamina">
                <div class="labeltop">
                    <label for="stamina">Endurance:</label>
                    <input type="number" id="stamina" name="stamina">
                </div>
                <div class="labeltop">
                    <label for="stamina_max">Endurance Max:</label>
                    <input type="number" id="stamina_max" name="stamina_max">
                </div>
            </div>
            <div class="atk-def">
                <div>
                    <label for="attack">Attaque:</label>
                    <input type="number" id="attack" name="attack">
                </div>
                <div>
                    <label for="defense">Défense:</label>
                    <input type="number" id="defense" name="defense">
                </div>
            </div>
            <div class="is_boss">
                <label for="is_boss">Est un Boss:</label>
                <input type="checkbox" id="is_boss" name="is_boss">
            </div>
        </div>
    </div>

    <div class="btn">
        <input type="submit" value="Ajouter">
        <a class="cancelbtn" href="/enemies">Annuler</a>
    </div>

</form>

<?php include 'src/View/templates/footer.php'; ?>