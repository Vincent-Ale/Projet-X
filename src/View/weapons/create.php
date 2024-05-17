<?php include 'src/View/templates/header.php'; ?>


<form method="post" action="/weapons/save" enctype="multipart/form-data">
    <div class="formulaire-weapon">
        <div class="weapon_sheet">
            <legend>Ajouter une Arme</legend>
            <div class="name_wpn">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name">
            </div>

            <div class="img_card"><img src="/assets/images/pointint2.png" alt=""></div>

            <div class="type_wpn">
                <label for="type">Type:</label>
                <select id="type" name="type">
                    <option value="sword">Epée</option>
                    <option value="magical">Magique</option>
                    <option value="bow">Arc</option>
                    <option value="axe">Hache</option>
                    <option value="dagger">Dague</option>
                    <option value="hammer">Marteau</option>
                </select>
            </div>

            <div class="phy_dmg">
                <label for="phy_dmg">Dégâts Physiques:</label>
                <input type="number" id="phy_dmg" name="physical_damage">
            </div> 
            
            <div class="ele_dmg">
                <label for="ele_dmg">Dégâts Elémentaux:</label>
                <input type="number" id="ele_dmg" name="elemental_damage">
            </div>

            <div class="unique">
                <label for="unique">Unique:</label>
                <input type="checkbox" class="custom-checkbox2" id="unique" name="unique">
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
                <p>Choisir son avatar:</p>
                <input type="file" id="file-upload" name="image" accept="image/*">

                <!-- Label stylisé qui agit comme un bouton -->
                <label for="file-upload" class="custom-file-upload">Importer une image</label>
            </div>

        </div>
    </div>

    <div class="btn">
        <input type="submit" value="Ajouter">
        <a class="cancelbtn" href="/weapons">Annuler</a>
    </div>
</form>

<?php include 'src/View/templates/footer.php'; ?>