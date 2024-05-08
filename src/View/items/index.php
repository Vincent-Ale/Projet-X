<?php include 'src/View/templates/header.php'; ?>


<!-- // Afficher les données dans un tableau -->
<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Type</th>
        <th>Puissance</th>
        <th>Unique</th>
        <th>Actions</th>
    </tr>

    <?php foreach($items as $item): ?>
    <tr>
        <td> <?= $item["id"] ?></td>
        <td> <?= $item["name"] ?></td>
        <td> <?= $item["type"] ?></td>
        <td> <?= $item["power"] ?></td>
        <td> <?= ($item["unique"] ? "Oui" : "Non") ?></td>
        <td>
            <!-- // Liens d'action pour chaque ligne -->
            <a id="iconpen<?= $item["id"] ?>" href="/items/edit/<?= $item["id"] ?>"><i class="fa fa-pencil-alt"></i></a>
            <span class="span" id="span<?= $item["id"] ?>">|</span>
            <a id="originalButton<?= $item["id"] ?>" onclick="showDeleteButtons(<?= $item['id'] ?>)"><i class="fa fa-trash"></i></a>
                    <!-- Boutons de suppression et d'annulation -->
                <div id="deleteButtons<?= $item["id"] ?>" style="display: none;">
                    <a href="/items/delete/<?= $item['id'] ?>"><i class="fa fa-square-check"></i></a>
                    <span class="span" >|</span>
                    <a id="cancelButton<?= $item["id"] ?>" onclick="hideDeleteButtons(<?= $item['id'] ?>)"><i class="fa fa-square-xmark"></i></a>
                </div>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

    <div class="btn_add_param"><a class="button_add" href="items/create">Ajouter un objet</a></div>

<?php include 'src/View/templates/footer.php'; ?>