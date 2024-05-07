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

document.addEventListener('DOMContentLoaded', function () {
    var fileInput = document.getElementById('file-upload');
    var imgCard = document.querySelector('.img_card img'); // Cibler l'élément img dans la div img_card
    var modal = document.getElementById('myModal');
    var modalImage = document.getElementById('modal-image');
    var cropButton = document.getElementById('crop-button');
    var closeModal = document.querySelector('.close');
    
    var cropper;

    fileInput.addEventListener('change', function (event) {
        var files = event.target.files;
        if (files && files.length > 0) {
            var file = files[0];
            var reader = new FileReader();

            reader.onload = function (e) {
                // Ouvrir la modal
                modal.style.display = 'block';
                modalImage.src = e.target.result;

                // Instancier Cropper dans la modal
                cropper = new Cropper(modalImage, {
                    aspectRatio: 230 / 150, // Ratio de recadrage souhaité
                    viewMode: 1 // Vue par défaut
                });
            };

            reader.readAsDataURL(file);
        }
    });

    // Gérer le recadrage
    cropButton.addEventListener('click', function (event) {
        // Empêcher la soumission du formulaire lors du clic sur "Recadrer"
        event.preventDefault();

        // Obtenir le canvas de l'image recadrée
        var croppedCanvas = cropper.getCroppedCanvas({ width: 230, height: 150 });

        // Convertir le canvas en URL de données
        var croppedDataUrl = croppedCanvas.toDataURL();

        // Mettre à jour la source de l'image dans la div .img_card
        imgCard.src = croppedDataUrl;

        // Fermer la modal
        modal.style.display = 'none';

        // Détruire Cropper pour nettoyer
        cropper.destroy();
    });

    // Gérer la fermeture de la modal
    closeModal.addEventListener('click', function () {
        modal.style.display = 'none';

        // Détruire Cropper si existant
        if (cropper) {
            cropper.destroy();
        }
    });
});
