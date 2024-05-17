// Variable globale pour stocker l'identifiant de l'élément avec des boutons affichés
let currentElementId = null;

// Fonction pour montrer les boutons de suppression et gérer le bouton précédent
function showDeleteButtons(id) {
    // Si un autre élément est déjà affiché, masquer les boutons de suppression de cet élément
    if (currentElementId !== null && currentElementId !== id) {
        hideDeleteButtons();
    }

    // Afficher les boutons de suppression et masquer le bouton original
    document.getElementById(`originalButton${id}`).style.display = 'none';
    document.getElementById(`deleteButtons${id}`).style.display = 'inline';
    document.getElementById(`iconpen${id}`).style.display = 'none';
    document.getElementById(`span${id}`).style.display = 'none';

    // Mettre à jour l'identifiant de l'élément actuellement affiché
    currentElementId = id;
}

// Fonction pour masquer les boutons de suppression
function hideDeleteButtons() {
    if (currentElementId !== null) {
        // Réafficher le bouton original et masquer les boutons de suppression
        document.getElementById(`originalButton${currentElementId}`).style.display = 'inline';
        document.getElementById(`deleteButtons${currentElementId}`).style.display = 'none';
        document.getElementById(`iconpen${currentElementId}`).style.display = 'inline';
        document.getElementById(`span${currentElementId}`).style.display = 'inline';

        // Réinitialiser l'identifiant de l'élément actuellement affiché
        currentElementId = null;
    }
}

// Écouter les événements de clic sur tout le document
document.addEventListener('click', function(event) {
    // Si l'élément cliqué n'est pas l'élément actuellement affiché, masquer les boutons de suppression
    if (currentElementId !== null) {
        // Vérifier si l'élément cliqué est à l'extérieur de l'élément actuellement affiché
        const clickedElement = event.target;
        const elementToHide = document.getElementById(`deleteButtons${currentElementId}`);

        if (!elementToHide.contains(clickedElement) && !clickedElement.closest(`#originalButton${currentElementId}`)) {
            hideDeleteButtons();
        }
    }
});





// file-upload

document.addEventListener('DOMContentLoaded', function () {
    const fileUpload = document.getElementById('file-upload');
    const imageToCrop = document.getElementById('image-to-crop');
    const cropModal = document.getElementById('crop-modal');
    const cropBtn = document.getElementById('crop-btn');
    const imgCard = document.querySelector('.img_card img'); // Récupération de l'élément img de la div img_card
    const rotateInput = document.getElementById('rotate');
    const mirrorInput = document.getElementById('mirror');
    
    
    let cropper;
    let rotate = 0;
    let mirror = { horizontal: false, vertical: false };

    fileUpload.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imageToCrop.src = e.target.result;
                cropModal.style.display = 'flex';
                cropper = new Cropper(imageToCrop, {
                    aspectRatio: 230 / 150, // Ratio d'image 230x150
                    viewMode: 1, // Limiter la zone visible de l'image
                    dragMode: 'crop', // Définir le mode de glisser-déposer sur le recadrage
                    cropBoxMovable: true, // Autoriser le déplacement de la zone de recadrage
                    cropBoxResizable: true // Autoriser le redimensionnement de la zone de recadrage
                });
            };
            reader.readAsDataURL(file);
        }
    });
    

    // Fermer la modal
    function closeModal() {
        cropModal.style.display = 'none';
        if (cropper) {
            cropper.destroy();
        }
    }

    document.querySelector('.close').addEventListener('click', closeModal);


    cropBtn.addEventListener('click', function (event) {
        event.preventDefault();

        if (cropper) {
            // Obtenir les données de recadrage
            const cropData = cropper.getData();

            // Convertir le canvas en blob pour mettre à jour l'élément img_card
            const croppedCanvas = cropper.getCroppedCanvas();
            croppedCanvas.toBlob(function (blob) {
                const url = URL.createObjectURL(blob);
                const imgCard = document.querySelector('.img_card img');
                imgCard.src = url;

                // Libérer l'URL blob
                imgCard.onload = () => {
                    URL.revokeObjectURL(url);
                };

                // Enregistrer les données de recadrage dans un formulaire caché
                document.querySelector('input[name="crop_x"]').value = cropData.x;
                document.querySelector('input[name="crop_y"]').value = cropData.y;
                document.querySelector('input[name="crop_width"]').value = cropData.width;
                document.querySelector('input[name="crop_height"]').value = cropData.height;
                document.querySelector('input[name="rotate"]').value = cropData.rotate;
                document.querySelector('input[name="mirror"]').value = cropData.mirror;
                

                // Fermer la modal
                closeModal();
            });
        }
    });

    // Fonction pour faire pivoter l'image à gauche
    document.getElementById('rotateLeftBtn').addEventListener('click', function() {
        console.log("Bouton de rotation gauche cliqué !");
        if (cropper) {
            cropper.rotate(-90);
            rotate -= 90; // Mettre à jour la valeur de rotation
            updateRotateInput(); // Mettre à jour la valeur de rotation dans l'input hidden

        }
    });

    // Fonction pour faire pivoter l'image à droite
    document.getElementById('rotateRightBtn').addEventListener('click', function() {
        console.log("Bouton de rotation droite cliqué !");
        if (cropper) {
            cropper.rotate(90);
            rotate += 90; // Mettre à jour la valeur de rotation
            updateRotateInput(); // Mettre à jour la valeur de rotation dans l'input hidden
        }
    });

    // Fonction pour faire pivoter l'image à gauche
    document.getElementById('rotateLeftBtn10').addEventListener('click', function() {
        console.log("Bouton de rotation gauche cliqué !");
        if (cropper) {
            cropper.rotate(-10);
            rotate -= 10; // Mettre à jour la valeur de rotation
            updateRotateInput(); // Mettre à jour la valeur de rotation dans l'input hidden
        }
    });

    // Fonction pour faire pivoter l'image à droite
    document.getElementById('rotateRightBtn10').addEventListener('click', function() {
        console.log("Bouton de rotation droite cliqué !");
        if (cropper) {
            cropper.rotate(10);
            rotate += 10; // Mettre à jour la valeur de rotation
            updateRotateInput(); // Mettre à jour la valeur de rotation dans l'input hidden
        }
    });

    // Fonction pour retourner horizontalement l'image
    document.getElementById('mirrorHorizontalBtn').addEventListener('click', function() {
        console.log("Bouton de retournement horizontal cliqué !");
        if (cropper) {
            mirror.horizontal = !mirror.horizontal; // Mettre à jour la valeur de miroir horizontal
            cropper.scaleX(-1 * cropper.getData().scaleX); // Inverser l'échelle horizontale
            updateMirrorInput(); // Mettre à jour la valeur de miroir dans l'input hidden
        }
    });

    // Fonction pour retourner verticalement l'image
    document.getElementById('mirrorVerticalBtn').addEventListener('click', function() {
        console.log("Bouton de retournement vertical cliqué !");
        if (cropper) {
            mirror.vertical = !mirror.vertical; // Mettre à jour la valeur de miroir vertical
            cropper.scaleY(-1 * cropper.getData().scaleY); // Inverser l'échelle verticale
            updateMirrorInput(); // Mettre à jour la valeur de miroir dans l'input hidden
        }
    });

});

// Fonction pour mettre à jour la valeur de rotation dans l'input hidden
function updateRotateInput() {
    if (rotate < 0) {
        rotate += 360; // Assurer que la rotation est dans l'intervalle [0, 360)
    } else if (rotate >= 360) {
        rotate %= 360; // Assurer que la rotation est dans l'intervalle [0, 360)
    }
    rotateInput.value = rotate; // Mettre à jour la valeur de rotation dans l'input hidden
}

// Fonction pour mettre à jour la valeur de miroir dans l'input hidden
function updateMirrorInput() {
    mirrorInput.value = JSON.stringify(mirror); // Mettre à jour la valeur de miroir dans l'input hidden
}



function hideError() {
    document.getElementById('errorMessage').style.display = 'none';
}


