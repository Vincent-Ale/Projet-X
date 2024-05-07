<?php include 'src/View/templates/header.php'; ?>

<form action="/items/update" method="post">
    <div class="formulaire-item">
        <div class="item_sheet">
            <legend>Objet</legend>
            <div class="hidden">
                <input type="hidden" id="id" name="id" value="<?= $item['id'] ?>">
            </div>
            <div class="name_wpn">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name" value="<?= $item['name'] ?>">
            </div>

            <div class="type_wpn">
                <label for="type">Type:</label>
                <input type="text" id="type" name="type" value="<?= $item['type'] ?>">
            </div>

            <div class="power">
                <label for="power">Puissance:</label>
                <input type="number" id="power" name="power" value="<?= $item['power'] ?>">
            </div> 
            
            <div class="unique">
                <label for="unique">Unique:</label>
                <input type="checkbox" id="unique" name="unique" <?= $item['unique'] ? 'checked' : '' ?> >
            </div>
        </div>

        <div class="btn">
            <input type="submit" value="Mettre à jour">
            <a class="cancelbtn" href="/items">Annuler</a>
        </div>
    </div>

</form>

<?php include 'src/View/templates/footer.php'; ?>