document.addEventListener('DOMContentLoaded', () => {
    // Récupérez les éléments HTML pertinents
    const closeAddPictureModalButton = document.querySelector('.delete[data-target="add-picture-modal"]');
    const addPictureModal = document.getElementById('add-picture-modal');
    let activeModal = null; // Définissez la variable activeModal en dehors de la fonction

    // Fonction pour ouvrir la modal d'ajout d'image
    function openAddPictureModal() {
        // Fermez la modal précédente si elle est ouverte
        if (activeModal !== null) {
            activeModal.classList.remove('is-active');
        }

        // Ouvrez la nouvelle modal d'ajout d'image
        addPictureModal.classList.add('is-active');
        activeModal = addPictureModal; // Définissez la nouvelle modal comme active
    }

    // Ajoutez un gestionnaire d'événements pour fermer la modal lorsque vous cliquez sur le bouton de fermeture
    closeAddPictureModalButton.addEventListener('click', () => {
        if (activeModal !== null) {
            activeModal.classList.remove('is-active');
        }
    });

    // Mettez à jour le nom du fichier pour le champ de fichier de l'image
    const pictureFileInput = document.querySelector('.add-picture-input');
    const pictureFileName = document.querySelector('.add-picture-name');

    pictureFileInput.addEventListener('change', () => {
        pictureFileName.textContent = pictureFileInput.files[0] ? pictureFileInput.files[0].name : 'No file selected';
    });

    const openAddPictureModalButton = document.getElementById('open-add-picture-modal');
    if (openAddPictureModalButton) {
        openAddPictureModalButton.addEventListener('click', () => {
            openAddPictureModal();
        });
    }

});
