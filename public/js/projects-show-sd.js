document.addEventListener('DOMContentLoaded', () => {
    // Récupérez les éléments HTML pertinents
    const openSecondDescriptionModalButton = document.getElementById('open-secondDescription-modal');
    const editSecondDescriptionModal = document.getElementById('edit-secondDescription-modal');
    const closeModalButton = editSecondDescriptionModal.querySelector('.delete');

    // Fonction pour ouvrir la modal
    function openSecondDescriptionModal() {
        editSecondDescriptionModal.classList.add('is-active');
    }

    // Fonction pour fermer la modal
    function closeSecondDescriptionModal() {
        editSecondDescriptionModal.classList.remove('is-active');
    }

    // Ajoutez un gestionnaire d'événements pour ouvrir la modal lorsque vous cliquez sur le bouton ou le lien
    openSecondDescriptionModalButton.addEventListener('click', openSecondDescriptionModal);

    // Ajoutez un gestionnaire d'événements pour fermer la modal lorsque vous cliquez sur le bouton de fermeture
    closeModalButton.addEventListener('click', closeSecondDescriptionModal);
});
