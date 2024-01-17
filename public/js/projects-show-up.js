document.addEventListener('DOMContentLoaded', () => {
    // Récupérez les éléments HTML pertinents
    const closeEditPictureModalButton = document.querySelector('.delete[data-target="edit-picture-modal"]');
    const galleryModal = document.getElementById('edit-picture-gallery');
    let activeModal = null; // Définissez la variable activeModal en dehors de la fonction

    // Fonction pour ouvrir la modal avec l'ID
    function openEditPictureModalWithId(id) {
        // Fermez la modal précédente si elle est ouverte
        if (activeModal !== null) {
            activeModal.classList.remove('is-active');
        }

        // Ouvrez la nouvelle modal en utilisant l'ID dynamique
        const editPictureModal = document.getElementById('edit-picture-modal');
        const modalEditPictureInput = document.getElementById('modal-edit-picture');

        // Mettez à jour le champ caché de l'ID dans la modal avec l'ID dynamique
        modalEditPictureInput.value = id;

        // Mettez à jour le nom du fichier pour le champ de fichier de l'image
        const pictureFileInput = document.querySelector('.picture-file-input');
        const pictureFileName = document.querySelector('.picture-file-name');

        pictureFileInput.addEventListener('change', () => {
            pictureFileName.textContent = pictureFileInput.files[0] ? pictureFileInput.files[0].name : 'No file selected';
        });

        // Fermez la modal de la galerie
        galleryModal.classList.remove('is-active');

        // Ouvrez la modal d'édition
        editPictureModal.classList.add('is-active');
        activeModal = editPictureModal; // Définissez la nouvelle modal comme active

        // Utilisez l'ID récupéré ici (dans cet exemple, nous allons simplement l'afficher)
        console.log("ID récupéré:", id);
    }

    // Ajoutez un gestionnaire d'événements pour fermer la modal lorsque vous cliquez sur le bouton de fermeture
    closeEditPictureModalButton.addEventListener('click', () => {
        if (activeModal !== null) {
            activeModal.classList.remove('is-active');
        }
    });

    // Ajoutez des gestionnaires d'événements pour chaque bouton "Edit" en utilisant les identifiants uniques
    const editButtons = document.querySelectorAll('[id^="open-edit-picture-modal-"]');
    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.id; // Récupérez l'ID à partir de l'attribut data-id
            openEditPictureModalWithId(id);
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    // Récupérez les éléments HTML pertinents
    const openGalleryModalButton = document.getElementById('open-gallery-modal');
    const closeGalleryModalButton = document.getElementById('close-gallery-modal');
    const galleryModal = document.getElementById('edit-picture-gallery');
    const modalContent = document.querySelector('.modal-content');

    // Fonction pour ouvrir la modal
    function openGalleryModal() {
        galleryModal.classList.add('is-active');
        modalContent.classList.add('is-clipped'); // Ajoutez la classe is-clipped au corps du modal
    }

    // Ajoutez un gestionnaire d'événements pour ouvrir la modal lorsque vous cliquez sur le bouton
    openGalleryModalButton.addEventListener('click', openGalleryModal);

    // Fonction pour fermer la modal
    function closeGalleryModal() {
        galleryModal.classList.remove('is-active');
        modalContent.classList.remove('is-clipped'); // Supprimez la classe is-clipped du corps du modal
    }

    // Ajoutez un gestionnaire d'événements pour fermer la modal lorsque vous cliquez sur le bouton de fermeture
    closeGalleryModalButton.addEventListener('click', closeGalleryModal);
});
