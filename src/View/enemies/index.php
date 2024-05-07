<?php include 'src/View/templates/header.php'; ?>


<!-- // Afficher les données dans un tableau -->
<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Santé</th>
        <th>Santé Max</th>
        <th>Mana</th>
        <th>Mana Max</th>
        <th>Endurance</th>
        <th>Endurance Max</th>
        <th>Attaque</th>
        <th>Défense</th>
        <th>Est un Boss</th>
        <th>Actions</th>
    </tr>

    <?php foreach($enemies as $enemy): ?>
    <tr>
        <td> <?= $enemy["id"] ?></td>
        <td> <?= $enemy["name"] ?></td>
        <td> <?= $enemy["health"] ?></td>
        <td> <?= $enemy["health_max"] ?></td>
        <td> <?= $enemy["mana"] ?></td>
        <td> <?= $enemy["mana_max"] ?></td>
        <td> <?= $enemy["stamina"] ?></td>
        <td> <?= $enemy["stamina_max"] ?></td>
        <td> <?= $enemy["attack"] ?></td>
        <td> <?= $enemy["defense"] ?></td>
        <td> <?= ($enemy["is_boss"]  ? "Oui" : "Non") ?></td>
        <td>
            <!-- // Liens d'action pour chaque ligne -->
            <a id="iconpen<?= $enemy["id"] ?>" href="/enemies/edit/<?= $enemy["id"] ?>"><i class="fa fa-pencil-alt"></i></a>
            <span class="span" id="span<?= $enemy["id"] ?>">|</span>
            <a id="originalButton<?= $enemy["id"] ?>" onclick="showDeleteButtons(<?= $enemy['id'] ?>)"><i class="fa fa-trash"></i></a>
                    <!-- Boutons de suppression et d'annulation -->
                <div id="deleteButtons<?= $enemy["id"] ?>" style="display: none;">
                    <a href="/enemies/delete/<?= $enemy['id'] ?>"><i class="fa fa-square-check"></i></a>
                    <span class="span" >|</span>
                    <a id="cancelButton<?= $enemy["id"] ?>" onclick="hideDeleteButtons(<?= $enemy['id'] ?>)"><i class="fa fa-square-xmark"></i></a>
                </div>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

    <div class="btn_add_param"><a class="button_add" href="enemies/create">Ajouter un ennemi</a></div>

<?php include 'src/View/templates/footer.php'; ?>