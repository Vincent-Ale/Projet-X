<?php include 'src/View/templates/header.php'; ?>


<form method="post" action="/enemies/save" enctype="multipart/form-data">
    <div class="formulaire-enemies">
        <div class="enemy_sheet">
            <legend>Ajouter un nouvel Enemi</legend>
            <div class="name_char">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name">
            </div>

            <div class="img_card"><img src="" alt=""></div>

            <div class="vie">
                <div class="labeltop">
                    <label for="health">Santé:</label>
                    <input type="number" id="health" name="health">
                </div>
                <div class="labeltop">
                    <label for="health_max">Santé Max:</label>
                    <input type="number" id="health_max" name="health_max">
                </div>
            </div>
            <div class="mana">
                <div class="labeltop">
                    <label for="mana">Mana:</label>
                    <input type="number" id="mana" name="mana">
                </div>
                <div class="labeltop">
                    <label for="mana_max">Mana Max:</label>
                    <input type="number" id="mana_max" name="mana_max">
                </div>
            </div>
            <div class="stamina">
                <div class="labeltop">
                    <label for="stamina">Endurance:</label>
                    <input type="number" id="stamina" name="stamina">
                </div>
                <div class="labeltop">
                    <label for="stamina_max">Endurance Max:</label>
                    <input type="number" id="stamina_max" name="stamina_max">
                </div>
            </div>
            <div class="atk-def">
                <div>
                    <label for="attack">Attaque:</label>
                    <input type="number" id="attack" name="attack">
                </div>
                <div>
                    <label for="defense">Défense:</label>
                    <input type="number" id="defense" name="defense">
                </div>
            </div>
            <div class="is_boss">
                <label for="is_boss">Est un Boss:</label>
                <input type="checkbox" id="is_boss" name="is_boss">
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
        <a class="cancelbtn" href="/enemies">Annuler</a>
    </div>

</form>

<?php include 'src/View/templates/footer.php'; ?>