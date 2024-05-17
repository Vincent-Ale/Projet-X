<?php include 'src/View/templates/header.php'; ?>

<form action="/enemies/update" method="post" enctype="multipart/form-data">
    <div class="formulaire-enemies">
        <div class="enemy_sheet">
            <legend>Fiche Ennemi</legend>
            <div class="hidden">
                <input type="hidden" id="id" name="id" value="<?= $enemy['id'] ?>">
            </div>
            <div class="name_char">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name" value="<?= $enemy['name'] ?>">
            </div>

            <div class="img_card">
                <img src="<?php echo '/'.$enemy['image_path']; ?>" alt="<?php echo $enemy['name']; ?>">
            </div>

            <div class="vie">
                <div class="labeltop">
                    <label for="health">Santé:</label>
                    <input type="number" id="health" name="health" value="<?= $enemy['health'] ?>">
                </div>
            </div>
            <div class="mana">
                <div class="labeltop">
                    <label for="mana">Mana:</label>
                    <input type="number" id="mana" name="mana" value="<?= $enemy['mana'] ?>">
                </div>
            </div>
            <div class="stamina">
                <div class="labeltop">
                    <label for="stamina">Endurance:</label>
                    <input type="number" id="stamina" name="stamina" value="<?= $enemy['stamina'] ?>">
                </div>
            </div>

            <div class="atk-def">
                <div>
                    <label for="attack">Attaque:</label>
                    <input type="number" id="attack" name="attack" value="<?= $enemy['attack'] ?>">
                </div>
                <div>
                    <label for="defense">Défense:</label>
                    <input type="number" id="defense" name="defense" value="<?= $enemy['defense'] ?>">
                </div>
            </div>

            <div class="is_boss">
                <label for="is_boss">Est un Boss:</label>
                <input type="checkbox" class="custom-checkbox2" id="is_boss" name="is_boss" <?= $enemy['is_boss'] ? 'checked' : '' ?> >
            </div>

            <input type="hidden" name="crop_x" id="crop_x">
            <input type="hidden" name="crop_y" id="crop_y">
            <input type="hidden" name="crop_width" id="crop_width">
            <input type="hidden" name="crop_height" id="crop_height">

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
                <p>Changer son avatar:</p>
                <input type="file" id="file-upload" name="image" accept="image/*">

                <!-- Label stylisé qui agit comme un bouton -->
                <label for="file-upload" class="custom-file-upload">Importer une image</label>
            </div>
            
        </div>
    </div>
    
    <div class="btn">
        <input type="submit" value="Mettre à jour">
        <a class="cancelbtn" href="/enemies">Annuler</a>
    </div>

</form>

<?php include 'src/View/templates/footer.php'; ?>