<?php include 'src/View/templates/header.php'; ?>


<!-- // Afficher les données dans un tableau -->
<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Type</th>
        <th>Puissance</th>
        <th>Coût en Mana</th>
        <th>Unique</th>
        <th>Actions</th>
    </tr>

    <?php foreach($spells as $spell): ?>
    <tr>
        <td> <?= $spell["id"] ?></td>
        <td> <?= $spell["name"] ?></td>
        <td> <?= $spell["type"] ?></td>
        <td> <?= $spell["power"] ?></td>
        <td> <?= $spell["mana_cost"] ?></td>
        <td> <?= ($spell["unique"] ? "Oui" : "Non") ?></td>
        <td>
            <!-- // Liens d'action pour chaque ligne -->
            <a id="iconpen<?= $spell["id"] ?>" href="/spells/edit/<?= $spell["id"] ?>"><i class="fa fa-pencil-alt"></i></a>
            <span class="span" id="span<?= $spell["id"] ?>">|</span>
            <a id="originalButton<?= $spell["id"] ?>" onclick="showDeleteButtons(<?= $spell['id'] ?>)"><i class="fa fa-trash"></i></a>
                    <!-- Boutons de suppression et d'annulation -->
                <div id="deleteButtons<?= $spell["id"] ?>" style="display: none;">
                    <a href="/spells/delete/<?= $spell['id'] ?>"><i class="fa fa-square-check"></i></a>
                    <span class="span" >|</span>
                    <a id="cancelButton<?= $spell["id"] ?>" onclick="hideDeleteButtons(<?= $spell['id'] ?>)"><i class="fa fa-square-xmark"></i></a>
                </div>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

    <div class="btn_add_param"><a class="button_add" href="spells/create">Ajouter un sort</a></div>

<?php include 'src/View/templates/footer.php'; ?>