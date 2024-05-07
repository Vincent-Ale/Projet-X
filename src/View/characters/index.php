<?php include 'src/View/templates/header.php'; ?>


<!-- // Afficher les données dans un tableau -->
<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Niveau</th>
        <th>Santé</th>
        <th>Santé Max</th>
        <th>Mana</th>
        <th>Mana Max</th>
        <th>Endurance</th>
        <th>Endurance Max</th>
        <th>EXP</th>
        <th>EXP Max</th>
        <th>Actions</th>
    </tr>

    <?php foreach($characters as $character): ?>
    <tr>
        <td> <?= $character["id"] ?></td>
        <td> <?= $character["name"] ?></td>
        <td> <?= $character["level"] ?></td>
        <td> <?= $character["health"] ?></td>
        <td> <?= $character["health_max"] ?></td>
        <td> <?= $character["mana"] ?></td>
        <td> <?= $character["mana_max"] ?></td>
        <td> <?= $character["stamina"] ?></td>
        <td> <?= $character["stamina_max"] ?></td>
        <td> <?= $character["EXP"] ?></td>
        <td> <?= $character["EXP_max"] ?></td>
        <td>
            <!-- // Liens d'action pour chaque ligne -->
            <a id="iconpen<?= $character["id"] ?>" href="/characters/edit/<?= $character["id"] ?>"><i class="fa fa-pencil-alt"></i></a>
            <span class="span" id="span<?= $character["id"] ?>">|</span>
            <a id="originalButton<?= $character["id"] ?>" onclick="showDeleteButtons(<?= $character['id'] ?>)"><i class="fa fa-trash"></i></a>
                    <!-- Boutons de suppression et d'annulation -->
                <div id="deleteButtons<?= $character["id"] ?>" style="display: none;">
                    <a href="/characters/delete/<?= $character['id'] ?>"><i class="fa fa-square-check"></i></a>
                    <span class="span" >|</span>
                    <a id="cancelButton<?= $character["id"] ?>" onclick="hideDeleteButtons(<?= $character['id'] ?>)"><i class="fa fa-square-xmark"></i></a>
                </div>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

    <div class="btn_add_param"><a class="button_add" href="characters/create">Ajouter un personnage</a></div>

<?php include 'src/View/templates/footer.php'; ?>