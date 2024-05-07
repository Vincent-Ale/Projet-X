<?php include 'src/View/templates/header.php'; ?>

<form action="/spells/update" method="post">
    <div class="formulaire">
        <div class="spell_sheet">
            <legend>Arme</legend>
            <div class="hidden">
                <input type="hidden" id="id" name="id" value="<?= $spell['id'] ?>">
            </div>
            <div class="name_spell">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name" value="<?= $spell['name'] ?>">
            </div>

            <div class="type_spell">
                <label for="type">Type:</label>
                <input type="text" id="type" name="type" value="<?= $spell['type'] ?>">
            </div>

            <div class="power">
                <label for="power">Puissance:</label>
                <input type="number" id="power" name="power" value="<?= $spell['power'] ?>">
            </div> 
            
            <div class="mana_cost">
                <label for="mana_cost">Coût en Mana:</label>
                <input type="number" id="mana_cost" name="mana_cost" value="<?= $spell['mana_cost'] ?>">
            </div>

            <div class="unique">
                <label for="unique">Unique:</label>
                <input type="checkbox" id="unique" name="unique" <?= $spell['unique'] ? 'checked' : '' ?> >
            </div>
            
            <div class="btn">
                <input type="submit" value="Mettre à jour">
                <a class="cancelbtn" href="/spells">Annuler</a>
            </div>
        </div>
    </div>

</form>

<?php include 'src/View/templates/footer.php'; ?>