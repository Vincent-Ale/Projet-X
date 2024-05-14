<?php include 'src/View/templates/header.php'; ?>

<form action="/spells/update" method="post" enctype="multipart/form-data">
    <div class="formulaire-spell">
        <div class="spell_sheet">
            <legend>Sort</legend>
            <div class="hidden">
                <input type="hidden" id="id" name="id" value="<?= $spell['id'] ?>">
            </div>
            <div class="name_spell">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name" value="<?= $spell['name'] ?>">
            </div>

            <div class="img_card">
                <img src="<?php echo '/'.$spell['image_path']; ?>" alt="<?php echo $spell['name']; ?>">
            </div>

            <div class="type_spell">
                <label for="type">Type:</label>
                <select id="type" name="type">
                    <option value="offensive" <?php if ($weapon['type'] === 'offensive') echo 'selected'; ?>>Offensif</option>
                    <option value="defensive" <?php if ($weapon['type'] === 'defensive') echo 'selected'; ?>>Défensif</option>
                    <option value="support" <?php if ($weapon['type'] === 'support') echo 'selected'; ?>>Support</option>
                </select>
            </div>

            <div class="power">
                <label for="power">Puissance:</label>
                <input type="number" id="power" name="power" value="<?= $spell['power'] ?>">
            </div> 
            
            <div class="mana_cost">
                <label for="mana_cost">Coût en Mana:</label>
                <input type="number" id="mana_cost" name="mana_cost" value="<?= $spell['mana_cost'] ?>">
            </div>

            <div class="unique">
                <label for="unique">Unique:</label>
                <input type="checkbox" id="unique" name="unique" <?= $spell['unique'] ? 'checked' : '' ?> >
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

        

    </div>
    
    <div class="btn">
        <input type="submit" value="Mettre à jour">
        <a class="cancelbtn" href="/spells">Annuler</a>
    </div>
    
</form>

<?php include 'src/View/templates/footer.php'; ?>