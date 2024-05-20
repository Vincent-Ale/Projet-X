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



function hideError() {
    document.getElementById('errorMessage').style.display = 'none';
}


document.addEventListener('DOMContentLoaded', function () {
    const fileUpload = document.getElementById('file-upload');
    const imageToCrop = document.getElementById('image-to-crop');
    const cropModal = document.getElementById('crop-modal');
    const cropBtn = document.getElementById('crop-btn');
    const imgCard = document.querySelector('.img_card img');
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
                    aspectRatio: 300 / 300,
                    viewMode: 1,
                    dragMode: 'crop',
                    cropBoxMovable: true,
                    cropBoxResizable: true
                });
            };
            reader.readAsDataURL(file);
        }
    });

    function closeModal() {
        cropModal.style.display = 'none';
        if (cropper) {
            cropper.destroy();
            cropper = null;
            imageToCrop.src = '';
        }
    }

    document.querySelector('.close').addEventListener('click', closeModal);

    cropBtn.addEventListener('click', function (event) {
        event.preventDefault();
        if (cropper) {
            const cropData = cropper.getData();
            const croppedCanvas = cropper.getCroppedCanvas();
            croppedCanvas.toBlob(function (blob) {
                const url = URL.createObjectURL(blob);
                imgCard.src = url;
                imgCard.onload = () => {
                    URL.revokeObjectURL(url);
                };

                document.querySelector('input[name="crop_x"]').value = cropData.x;
                document.querySelector('input[name="crop_y"]').value = cropData.y;
                document.querySelector('input[name="crop_width"]').value = cropData.width;
                document.querySelector('input[name="crop_height"]').value = cropData.height;
                document.querySelector('input[name="rotate"]').value = rotate;
                document.querySelector('input[name="mirror"]').value = JSON.stringify(mirror);

                closeModal();
            });
        }
    });

    document.getElementById('rotateLeftBtn').addEventListener('click', function() {
        if (cropper) {
            rotate -= 90;
            cropper.rotate(-90);
            updateRotateInput();
        }
    });

    document.getElementById('rotateRightBtn').addEventListener('click', function() {
        if (cropper) {
            rotate += 90;
            cropper.rotate(90);
            updateRotateInput();
        }
    });

    document.getElementById('rotateLeftBtn10').addEventListener('click', function() {
        if (cropper) {
            rotate -= 10;
            cropper.rotate(-10);
            updateRotateInput();
        }
    });

    document.getElementById('rotateRightBtn10').addEventListener('click', function() {
        if (cropper) {
            rotate += 10;
            cropper.rotate(10);
            updateRotateInput();
        }
    });

    document.getElementById('mirrorHorizontalBtn').addEventListener('click', function() {
        if (cropper) {
            mirror.horizontal = !mirror.horizontal;
            cropper.scaleX(-cropper.getData().scaleX);
            updateMirrorInput();
        }
    });

    document.getElementById('mirrorVerticalBtn').addEventListener('click', function() {
        if (cropper) {
            mirror.vertical = !mirror.vertical;
            cropper.scaleY(-cropper.getData().scaleY);
            updateMirrorInput();
        }
    });

    function updateRotateInput() {
        if (rotateInput) {
            rotateInput.value = rotate % 360;
        } else {
            console.error("rotateInput n'est pas défini dans le DOM");
        }
    }
    
    function updateMirrorInput() {
        if (mirrorInput) {
            mirrorInput.value = JSON.stringify(mirror);
        } else {
            console.error("mirrorInput n'est pas défini dans le DOM");
        }
    }
});
