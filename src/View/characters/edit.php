<?php include 'src/View/templates/header.php'; ?>

<form action="/characters/update" method="post" enctype="multipart/form-data">
    <div class="formulaire">
        <div class="char_sheet">
            <legend>Fiche Personnage</legend>
            <div class="hidden">
                <input type="hidden" id="id" name="id" value="<?= $character['id'] ?>">
            </div>
            <div class="name_char">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name" value="<?= $character['name'] ?>">
            </div>
            <div class="img_card"><img src="<?php echo '/'.$character['image_path']; ?>" alt="<?php echo $character['name']; ?>"></div>
            <div class="lvlexp">
                <div class="labeltop">
                    <label for="level">Niveau:</label>
                    <input type="number" id="level" name="level" value="<?= $character['level'] ?>">
                </div>
                <div class="labeltop">
                    <label for="exp">EXP:</label>
                    <input type="number" id="exp" name="exp" value="<?= $character['EXP'] ?>">
                </div>
                <div class="labeltop">
                    <label for="exp_max">EXP Max:</label>
                    <input type="number" id="exp_max" name="exp_max" value="<?= $character['EXP_max'] ?>">
                </div>
            </div>
            <div class="vie">
                <div class="labeltop">
                    <label for="health">Santé:</label>
                    <input type="number" id="health" name="health" value="<?= $character['health'] ?>">
                </div>
                <div class="labeltop">
                    <label for="health_max">Santé Max:</label>
                    <input type="number" id="health_max" name="health_max" value="<?= $character['health_max'] ?>">
                </div>
            </div>
            <div class="mana">
                <div class="labeltop">
                    <label for="mana">Mana:</label>
                    <input type="number" id="mana" name="mana" value="<?= $character['mana'] ?>">
                </div>
                <div class="labeltop">
                    <label for="mana_max">Mana Max:</label>
                    <input type="number" id="mana_max" name="mana_max" value="<?= $character['mana_max'] ?>">
                </div>
            </div>
            <div class="stamina">
                <div class="labeltop">
                    <label for="stamina">Endurance:</label>
                    <input type="number" id="stamina" name="stamina" value="<?= $character['stamina'] ?>">
                </div>
                <div class="labeltop">
                    <label for="stamina_max">Endurance Max:</label>
                    <input type="number" id="stamina_max" name="stamina_max" value="<?= $character['stamina_max'] ?>">
                </div>
            </div>

            <input type="hidden" name="crop_x" id="crop_x">
            <input type="hidden" name="crop_y" id="crop_y">
            <input type="hidden" name="crop_width" id="crop_width">
            <input type="hidden" name="crop_height" id="crop_height">

            <!-- Modal pour le recadrage -->
            <div id="crop-modal" style="display: none;">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div class="cropper-container" style="overflow: hidden; display: flex; justify-content: center; align-items: center;">
                        <img id="image-to-crop" src="" alt="Image à recadrer" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                    </div>
                    <button id="crop-btn">Recadrer</button>
                </div>
            </div>
            

            <div class="up-img">
                <p>Changer son avatar:</p>
                <input type="file" id="file-upload" name="image" accept="image/*">

                <!-- Label stylisé qui agit comme un bouton -->
                <label for="file-upload" class="custom-file-upload">Importer une image</label>
            </div>
            
        </div>
        <!-- Armes -->
        <div class="table_stuff">
            <legend>Armes</legend>
            <!-- En-têtes de la table -->
            <table class="table-jointures">
                <thead>
                <tr>
                <th>Nom de l'Arme</th>
                <th class="title-width">Équiper</th>
                </tr>
                </thead>
            </table>
            <!-- Contenu de la table avec défilement -->
            <div class="overflow">
            <table class="table-jointures">
                <tbody>
                <?php foreach ($weapons as $weapon): ?>
                <tr>
                <td><label for="weapon-<?= $weapon['id'] ?>"><?= $weapon['name'] ?></label></td>
                <td class="check-width"><input type="checkbox" class="custom-checkbox" id="weapon-<?= $weapon['id'] ?>" name="weapons[]" value="<?= $weapon['id'] ?>"
                <?php
                    if (in_array($weapon['id'], $weaponIds)) {
                        echo 'checked';
                    }
                    ?>
                    >
                </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>

        <!-- Armures -->
        <div class="table_stuff">
            <legend>Armures</legend>
            <!-- En-têtes de la table -->
            <table class="table-jointures">
                <thead>
                <tr>
                <th>Nom de l'Armure</th>
                <th class="title-width">Équiper</th>
                </tr>
                </thead>
            </table>
            <!-- Contenu de la table avec défilement -->
            <div class="overflow">
            <table class="table-jointures">
                <tbody>
                <?php foreach ($armors as $armor): ?>
                <tr>
                    <td><label for="armor-<?= $armor['id'] ?>"><?= $armor['name'] ?></label></td>
                    <td class="check-width"><input type="checkbox" class="custom-checkbox" id="armor-<?= $armor['id'] ?>" name="armors[]" value="<?= $armor['id'] ?>"
                        <?php
                        if (in_array($armor['id'], $armorIds)) {
                            echo 'checked';
                        }
                        ?>
                        >
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>


        <!-- Sorts -->
        <div class="table_stuff">
            <legend>Sorts</legend>
            <!-- En-têtes de la table -->
            <table class="table-jointures">
                <thead>
                <tr>
                <th>Nom du Sort</th>
                <th class="title-width">Équiper</th>
                </tr>
                </thead>
            </table>
            <!-- Contenu de la table avec défilement -->
            <div class="overflow">
            <table class="table-jointures">
                <tbody>
                <?php foreach ($spells as $spell): ?>
                <tr>
                <td><label for="spell-<?= $spell['id'] ?>"><?= $spell['name'] ?></label></td>
                <td class="check-width"><input type="checkbox" class="custom-checkbox" id="spell-<?= $spell['id'] ?>" name="spells[]" value="<?= $spell['id'] ?>"
                    <?php
                    if (in_array($spell['id'], $spellIds)) {
                        echo 'checked';
                    }
                    ?>
                    >
                </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>

    <div class="btn">
        <input type="submit" value="Mettre à jour">
        <a class="cancelbtn" href="/characters">Annuler</a>
    </div>

</form>

<?php include 'src/View/templates/footer.php'; ?>