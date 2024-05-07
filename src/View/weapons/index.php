<?php include 'src/View/templates/header.php'; ?>


<!-- // Afficher les données dans un tableau -->
<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Type</th>
        <th>Dégâts Physiques</th>
        <th>Dégâts élémentaux</th>
        <th>Unique</th>
        <th>Actions</th>
    </tr>

    <?php foreach($weapons as $weapon): ?>
    <tr>
        <td> <?= $weapon["id"] ?></td>
        <td> <?= $weapon["name"] ?></td>
        <td> <?= $weapon["type"] ?></td>
        <td> <?= $weapon["physical_damage"] ?></td>
        <td> <?= $weapon["elemental_damage"] ?></td>
        <td> <?= ($weapon["unique"] ? "Oui" : "Non") ?></td>
        <td>
            <!-- // Liens d'action pour chaque ligne -->
            <a id="iconpen<?= $weapon["id"] ?>" href="/weapons/edit/<?= $weapon["id"] ?>"><i class="fa fa-pencil-alt"></i></a>
            <span class="span" id="span<?= $weapon["id"] ?>">|</span>
            <a id="originalButton<?= $weapon["id"] ?>" onclick="showDeleteButtons(<?= $weapon['id'] ?>)"><i class="fa fa-trash"></i></a>
                    <!-- Boutons de suppression et d'annulation -->
                <div id="deleteButtons<?= $weapon["id"] ?>" style="display: none;">
                    <a href="/weapons/delete/<?= $weapon['id'] ?>"><i class="fa fa-square-check"></i></a>
                    <span class="span" >|</span>
                    <a id="cancelButton<?= $weapon["id"] ?>" onclick="hideDeleteButtons(<?= $weapon['id'] ?>)"><i class="fa fa-square-xmark"></i></a>
                </div>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

    <div class="btn_add_param"><a class="button_add" href="weapons/create">Ajouter une arme</a></div>

<?php include 'src/View/templates/footer.php'; ?>