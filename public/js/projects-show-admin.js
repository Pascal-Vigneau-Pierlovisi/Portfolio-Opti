document.addEventListener('DOMContentLoaded', function () {
    const editTitleButton = document.getElementById('edit-title');
    const editTitleModal = document.getElementById('edit-title-modal');
    const saveTitleButton = document.getElementById('save-title-button');
    const editedTitleInput = document.getElementById('edited-title');
    const typingEffect = document.getElementById('typing-effect');

    // Ouvre la modal d'édition du titre
    editTitleButton.addEventListener('click', function () {
        editedTitleInput.value = typingEffect.innerText;
        editTitleModal.classList.add('is-active');
    });

    // Ferme la modal d'édition du titre
    document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot button[data-target="edit-title-modal"]').forEach(function (el) {
        el.addEventListener('click', function () {
            editTitleModal.classList.remove('is-active');
        });
    });

    // Met à jour le titre et ferme la modal lors de la sauvegarde
    saveTitleButton.addEventListener('click', function () {
        const newTitle = editedTitleInput.value;
        typingEffect.innerText = newTitle;
        editTitleModal.classList.remove('is-active');
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const editImageIcon = document.getElementById('main-picture');
    const editImageModal = document.getElementById('edit-mainPicture-modal');
    const fileInput = document.getElementById('new-image');

    // Ouvre la modal de modification de l'image
    editImageIcon.addEventListener('click', function () {
        editImageModal.classList.add('is-active');
    });

    // Mettre à jour le libellé du champ de fichier lorsqu'un fichier est sélectionné
    fileInput.addEventListener('change', function () {
        const fileName = this.files[0].name;
        const fileLabel = document.querySelector('.file-label .file-name');
        if (fileName) {
            fileLabel.textContent = fileName;
        } else {
            fileLabel.textContent = 'No file selected';
        }
    });

    // Ferme la modal de modification de l'image
    document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete').forEach(function (el) {
        el.addEventListener('click', function () {
            editImageModal.classList.remove('is-active');
        });
    });

    // Vous pouvez ajouter ici la gestion de la soumission du formulaire d'édition de l'image si nécessaire
    // Assurez-vous d'ajouter le comportement approprié pour télécharger et mettre à jour l'image du projet.
    // Par exemple, vous pouvez utiliser AJAX pour télécharger l'image sans recharger la page.
});

document.addEventListener('DOMContentLoaded', () => {
    // Récupérez les éléments HTML pertinents
    const openMainDescriptionModalButton = document.getElementById('open-mainDescription-modal');
    const editMainDescriptionModal = document.getElementById('edit-mainDescription-modal');
    const closeModalButton = editMainDescriptionModal.querySelector('.delete');

    // Fonction pour ouvrir la modal
    function openMainDescriptionModal() {
        editMainDescriptionModal.classList.add('is-active');
    }

    // Fonction pour fermer la modal
    function closeMainDescriptionModal() {
        editMainDescriptionModal.classList.remove('is-active');
    }

    // Ajoutez un gestionnaire d'événements pour ouvrir la modal lorsque vous cliquez sur le bouton ou le lien
    openMainDescriptionModalButton.addEventListener('click', openMainDescriptionModal);

    // Ajoutez un gestionnaire d'événements pour fermer la modal lorsque vous cliquez sur le bouton de fermeture
    closeModalButton.addEventListener('click', closeMainDescriptionModal);
});


document.addEventListener('DOMContentLoaded', () => {
    // Récupérer les éléments de la modal
    const openGithubModalButton = document.getElementById('open-github-modal');
    const githubModal = document.getElementById('github-modal');
    const closeGithubModalButton = document.getElementById('close-github-modal');
    const githubLinkInput = document.getElementById('github-link');
    const saveGithubLinkButton = document.getElementById('save-github-link');
    const cancelGithubLinkButton = document.getElementById('cancel-github-link');

    // Fonction pour ouvrir la modal
    function openGithubModal() {
        githubModal.classList.add('is-active');
    }

    // Fonction pour fermer la modal
    function closeGithubModal() {
        githubModal.classList.remove('is-active');
    }

    // Ajouter un gestionnaire d'événements pour le bouton d'ouverture de la modal
    openGithubModalButton.addEventListener('click', openGithubModal);

    // Ajouter un gestionnaire d'événements pour le bouton de fermeture de la modal
    closeGithubModalButton.addEventListener('click', closeGithubModal);

    // Ajouter un gestionnaire d'événements pour le bouton "Ajouter" dans la modal
    saveGithubLinkButton.addEventListener('click', function () {
        const githubLink = githubLinkInput.value;
        // Ajoutez ici le code pour traiter le lien GitHub, par exemple, enregistrez-le dans votre base de données.
        console.log('Lien GitHub ajouté :', githubLink);
        closeGithubModal(); // Fermez la modal après avoir traité le lien.
    });


});

