
document.addEventListener('DOMContentLoaded', () => {
    // Main picture input
    const mainPictureInput = document.getElementById('main-picture-input');
    const mainPictureNameLabel = document.getElementById('main-picture-name');

    mainPictureInput.addEventListener('change', (e) => {
        mainPictureNameLabel.textContent = e.target.files[0].name;
    });

    // Additional images input
    const additionalImagesInput = document.getElementById('additional-images-input');
    const additionalImagesNameLabel = document.getElementById('additional-images-name');

    additionalImagesInput.addEventListener('change', (e) => {
        const fileNames = Array.from(e.target.files).map(file => file.name).join(', ');
        additionalImagesNameLabel.textContent = fileNames;
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const addProjectButton = document.getElementById('add-project-button');
    const addProjectModal = document.getElementById('add-project-modal');
    const closeModal = document.getElementById('close-modal');

    // Open modal
    addProjectButton.addEventListener('click', () => {
        addProjectModal.classList.add('is-active');
    });

    // Close modal
    closeModal.addEventListener('click', () => {
        addProjectModal.classList.remove('is-active');
    });

    // Close modal if background is clicked
    addProjectModal.querySelector('.modal-background').addEventListener('click', () => {
        addProjectModal.classList.remove('is-active');
    });
});



