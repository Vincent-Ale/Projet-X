<?php include 'src/View/templates/header.php'; ?>


<form id="upload-form" method="post" action="/characters/save" enctype="multipart/form-data">
    <div class="all-form">
        <div class="formulaire">
            <div class="char_sheet">
                <legend>Ajouter un nouveau personnage</legend>
                <div class="name_char">
                    <label for="name">Nom:</label>
                    <input type="text" id="name" name="name">
                </div>
                <div class="img_card"><img src="/assets/images/avatar4.png" alt=""></div>
                <div class="lvlexp">
                    <div class="labeltop">
                        <label for="level">Niveau:</label>
                        <input type="number" id="level" name="level">
                    </div>
                    <div class="labeltop">
                        <label for="exp_max">EXP par niveau:</label>
                        <input type="number" id="exp_max" name="exp_max">
                    </div>
                </div>
                <div class="vie">
                    <div class="labeltop">
                        <label for="health">Santé:</label>
                        <input type="number" id="health" name="health">
                    </div>
                </div>
                <div class="mana">
                    <div class="labeltop">
                        <label for="mana">Mana:</label>
                        <input type="number" id="mana" name="mana">
                    </div>
                </div>
                <div class="stamina">
                    <div class="labeltop">
                        <label for="stamina">Endurance:</label>
                        <input type="number" id="stamina" name="stamina">
                    </div>
                </div>

                
                <input type="hidden" name="crop_x" id="crop_x">
                <input type="hidden" name="crop_y" id="crop_y">
                <input type="hidden" name="crop_width" id="crop_width">
                <input type="hidden" name="crop_height" id="crop_height">
                <input type="hidden" name="rotate" id="rotate" value="">
                <input type="hidden" name="mirror" id="mirror" value="">

                <!-- Modal pour le recadrage -->
                <div id="crop-modal" style="display: none;">
                    <div class="modal-content">
                        <div class="cropper-container" style="overflow: hidden; display: flex; justify-content: center; align-items: center;">
                            <img id="image-to-crop" src="" alt="Image à recadrer" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                        </div>
                        <!-- Options de rotation et de retournement miroir -->
                        <div class="crop-options">
                            <div class="degre">
                                <p>90°</p>
                                <span id="rotateLeftBtn"><i class="fas fa-undo"></i></span>
                            </div>
                            <div class="degre">
                                <p>10°</p>
                                <span id="rotateLeftBtn10"><i class="fas fa-undo"></i></span>
                            </div>
                            <div class="degre">
                                <p>90°</p>
                                <span id="rotateRightBtn"><i class="fas fa-redo"></i></span>
                            </div>
                            <div class="degre">
                                <p>10°</p>
                                <span id="rotateRightBtn10"><i class="fas fa-redo"></i></span>
                            </div>
                            <span id="mirrorHorizontalBtn"><i class="fas fa-arrows-alt-h"></i></span>
                            <span id="mirrorVerticalBtn"><i class="fas fa-arrows-alt-v"></i></span>
                        </div>
                        <div class="close-crop-btn">
                            <button id="crop-btn">Recadrer</button>
                            <span class="close">Annuler</span>
                        </div>
                    </div>
                </div>
                

                <div class="up-img">
                    <p>Choisir son avatar:</p>
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
                    <td class="check-width"><input type="checkbox" class="custom-checkbox" id="weapon-<?= $weapon['id'] ?>" name="weapons[]" value="<?= $weapon['id'] ?>"></td>
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
                    <td class="check-width"><input type="checkbox" class="custom-checkbox" id="armor-<?= $armor['id'] ?>" name="armors[]" value="<?= $armor['id'] ?>"></td>
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
                    <td class="check-width"><input type="checkbox" class="custom-checkbox" id="spell-<?= $spell['id'] ?>" name="spells[]" value="<?= $spell['id'] ?>"></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>

        <div class="btn">
            <input type="submit" value="Ajouter">
            <a class="cancelbtn" href="/characters">Annuler</a>
        </div>
    </div>

</form>

<?php include 'src/View/templates/footer.php'; ?>