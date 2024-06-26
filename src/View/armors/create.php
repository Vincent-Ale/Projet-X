<?php include 'src/View/templates/header.php'; ?>


<form method="post" action="/armors/save" enctype="multipart/form-data">
    <div class="formulaire-armor">
        <div class="armor_sheet">
            <legend>Ajouter une Armure</legend>
            <div class="name_wpn">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name">
            </div>

            <div class="img_card"><img src="/assets/images/pointint2.png" alt=""></div>

            <div class="type_armor">
                <label for="type">Type:</label>
                <select id="type" name="type">
                    <option value="Light">Léger</option>
                    <option value="Medium">Moyen</option>
                    <option value="Heavy">Lourd</option>
                </select>
            </div>

            <div class="phy_dmg">
                <label for="phy_dmg">Résistance Physique:</label>
                <input type="number" id="phy_dmg" name="physical_resistance">
            </div> 
            
            <div class="ele_dmg">
                <label for="ele_dmg">Résistance Magique:</label>
                <input type="number" id="ele_dmg" name="magical_resistance">
            </div>

            <div class="unique">
                <label for="unique">Unique:</label>
                <input type="checkbox" class="custom-checkbox2" id="unique" name="unique">
            </div>

            <input type="hidden" name="crop_x" id="crop_x">
            <input type="hidden" name="crop_y" id="crop_y">
            <input type="hidden" name="crop_width" id="crop_width">
            <input type="hidden" name="crop_height" id="crop_height">
            <input type="hidden" name="rotate" value="">
            <input type="hidden" name="mirror" value="">

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
        <div class="btn">
            <input type="submit" value="Ajouter">
            <a class="cancelbtn" href="/armors">Annuler</a>
        </div>
    </div>
</form>

<?php include 'src/View/templates/footer.php'; ?>