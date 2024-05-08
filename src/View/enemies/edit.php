<?php include 'src/View/templates/header.php'; ?>

<form action="/enemies/update" method="post">
    <div class="formulaire-enemies">
        <div class="enemy_sheet">
            <legend>Fiche Ennemi</legend>
            <div class="hidden">
                <input type="hidden" id="id" name="id" value="<?= $enemy['id'] ?>">
            </div>
            <div class="name_char">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name" value="<?= $enemy['name'] ?>">
            </div>
            <div class="vie">
                <div class="labeltop">
                    <label for="health">Santé:</label>
                    <input type="number" id="health" name="health" value="<?= $enemy['health'] ?>">
                </div>
                <div class="labeltop">
                    <label for="health_max">Santé Max:</label>
                    <input type="number" id="health_max" name="health_max" value="<?= $enemy['health_max'] ?>">
                </div>
            </div>
            <div class="mana">
                <div class="labeltop">
                    <label for="mana">Mana:</label>
                    <input type="number" id="mana" name="mana" value="<?= $enemy['mana'] ?>">
                </div>
                <div class="labeltop">
                    <label for="mana_max">Mana Max:</label>
                    <input type="number" id="mana_max" name="mana_max" value="<?= $enemy['mana_max'] ?>">
                </div>
            </div>
            <div class="stamina">
                <div class="labeltop">
                    <label for="stamina">Endurance:</label>
                    <input type="number" id="stamina" name="stamina" value="<?= $enemy['stamina'] ?>">
                </div>
                <div class="labeltop">
                    <label for="stamina_max">Endurance Max:</label>
                    <input type="number" id="stamina_max" name="stamina_max" value="<?= $enemy['stamina_max'] ?>">
                </div>
            </div>

            <div class="atk-def">
                <div>
                    <label for="attack">Attaque:</label>
                    <input type="number" id="attack" name="attack" value="<?= $enemy['attack'] ?>">
                </div>
                <div>
                    <label for="defense">Défense:</label>
                    <input type="number" id="defense" name="defense" value="<?= $enemy['defense'] ?>">
                </div>
            </div>

            <div class="is_boss">
                <label for="is_boss">Est un Boss:</label>
                <input type="checkbox" id="is_boss" name="is_boss" <?= $enemy['is_boss'] ? 'checked' : '' ?> >
            </div>
        </div>
    </div>
    
    <div class="btn">
        <input type="submit" value="Mettre à jour">
        <a class="cancelbtn" href="/enemies">Annuler</a>
    </div>

</form>

<?php include 'src/View/templates/footer.php'; ?>