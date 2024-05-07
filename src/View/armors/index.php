<?php include 'src/View/templates/header.php'; ?>


<!-- // Afficher les données dans un tableau -->
<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Type</th>
        <th>Résistance Physique</th>
        <th>Résistance Magique</th>
        <th>Unique</th>
        <th>Actions</th>
    </tr>

    <?php foreach($armors as $armor): ?>
    <tr>
        <td> <?= $armor["id"] ?></td>
        <td> <?= $armor["name"] ?></td>
        <td> <?= $armor["type"] ?></td>
        <td> <?= $armor["physical_resistance"] ?></td>
        <td> <?= $armor["magical_resistance"] ?></td>
        <td> <?= ($armor["unique"] ? "Oui" : "Non") ?></td>
        <td>
            <!-- // Liens d'action pour chaque ligne -->
            <a id="iconpen<?= $armor["id"] ?>" href="/armors/edit/<?= $armor["id"] ?>"><i class="fa fa-pencil-alt"></i></a>
            <span class="span" id="span<?= $armor["id"] ?>">|</span>
            <a id="originalButton<?= $armor["id"] ?>" onclick="showDeleteButtons(<?= $armor['id'] ?>)"><i class="fa fa-trash"></i></a>
                    <!-- Boutons de suppression et d'annulation -->
                <div id="deleteButtons<?= $armor["id"] ?>" style="display: none;">
                    <a href="/armors/delete/<?= $armor['id'] ?>"><i class="fa fa-square-check"></i></a>
                    <span class="span" >|</span>
                    <a id="cancelButton<?= $armor["id"] ?>" onclick="hideDeleteButtons(<?= $armor['id'] ?>)"><i class="fa fa-square-xmark"></i></a>
                </div>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

    <div class="btn_add_param"><a class="button_add" href="armors/create">Ajouter une armure</a></div>

<?php include 'src/View/templates/footer.php'; ?>