
document.addEventListener('DOMContentLoaded', function () {
    const images = document.querySelectorAll('#projectImages img');
    images.forEach(img => {
        img.addEventListener('click', function () {
            const modal = document.createElement('div');
            modal.classList.add('modal', 'is-active');
            modal.innerHTML = `
                    <div class="modal-background"></div>
                    <div class="modal-content">
                        <p class="image is-4by3">
                            <img src="${this.src}" alt="Full size image">
                        </p>
                    </div>
                    <button class="modal-close is-large" aria-label="close"></button>
                `;
            document.body.appendChild(modal);

            modal.querySelector('.modal-close').addEventListener('click', function () {
                modal.classList.remove('is-active');
                setTimeout(() => modal.remove(), 250);
            });
        });
    });
});



document.addEventListener('DOMContentLoaded', (event) => {
    const titleElement = document.getElementById('typing-effect');
    const originalText = titleElement.getAttribute('data-title');
    const typingSpeed = 150;
    let i = 0;
    titleElement.innerText = '';

    function typeWriter() {
        if (i < originalText.length) {
            titleElement.innerText += originalText.charAt(i);
            i++;
            setTimeout(typeWriter, typingSpeed);
        } else {
            document.getElementById('cursor').style.opacity = 0; // Cacher le curseur à la fin
        }
    }

    typeWriter();
});




// ADMIN UPDATE DATAS



