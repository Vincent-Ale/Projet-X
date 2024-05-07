<?php include 'src/View/templates/header.php'; ?>


<form method="post" action="/items/save">
    <div class="formulaire-item">
        <div class="item_sheet">
            <legend>Ajouter un Objet</legend>
            <div class="name_wpn">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name">
            </div>

            <div class="type_wpn">
                <label for="type">Type:</label>
                <input type="text" id="type" name="type">
            </div>

            <div class="power">
                <label for="power">Puissance:</label>
                <input type="number" id="power" name="power">
            </div> 
            
            <div class="unique">
                <label for="unique">Unique:</label>
                <input type="checkbox" id="unique" name="unique">
            </div>
        </div>
        <div class="btn">
            <input type="submit" value="Ajouter">
            <a class="cancelbtn" href="/items">Annuler</a>
        </div>
    </div>
</form>

<?php include 'src/View/templates/footer.php'; ?>