<?php include 'src/View/templates/header.php'; ?>


<form method="post" action="/items/save" enctype="multipart/form-data">
    <div class="formulaire-item">
        <div class="item_sheet">
            <legend>Ajouter un Objet</legend>
            <div class="name_wpn">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name">
            </div>

            <div class="img_card"><img src="" alt=""></div>

            <div class="type_wpn">
                <label for="type">Type:</label>
                <input type="text" id="type" name="type">
            </div>

            <div class="power">
                <label for="power">Puissance:</label>
                <input type="number" id="power" name="power">
            </div> 
            
            <div class="unique">
                <label for="unique">Unique:</label>
                <input type="checkbox" id="unique" name="unique">
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

        <div class="btn">
            <input type="submit" value="Ajouter">
            <a class="cancelbtn" href="/items">Annuler</a>
        </div>
    </div>
</form>

<?php include 'src/View/templates/footer.php'; ?>