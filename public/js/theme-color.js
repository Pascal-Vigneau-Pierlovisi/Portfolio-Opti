// Fonction pour changer le thème
document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('theme-toggle');
    const currentTheme = localStorage.getItem('theme') || 'dark'; // 'dark' est le thème par défaut si rien n'est enregistré

    // Appliquer le thème lors du chargement de la page
    if (currentTheme === 'dark') {
        document.documentElement.classList.add('is-dark-mode');
        btn.innerHTML = '<span class="icon"><i class="fas fa-sun"></i></span><span>Light Theme</span>';
        btn.style.backgroundColor = 'white';
        btn.style.color = 'black';
    } else {
        document.documentElement.classList.remove('is-dark-mode');
        btn.innerHTML = '<span class="icon"><i class="fas fa-moon"></i></span><span>Dark Theme</span>';
        btn.style.backgroundColor = '#363636';
        btn.style.color = 'white';
    }

    // Gestionnaire de clic pour le bouton de changement de thème
    btn.addEventListener('click', () => {
        // Basculer le thème sombre et clair
        document.documentElement.classList.toggle('is-dark-mode');
        let theme = 'light';
        if (document.documentElement.classList.contains('is-dark-mode')) {
            btn.innerHTML = '<span class="icon"><i class="fas fa-sun"></i></span><span>Light Theme</span>';
            btn.style.backgroundColor = 'white';
            btn.style.color = 'black';
            theme = 'dark'; // Le thème est sombre
        } else {
            btn.innerHTML = '<span class="icon"><i class="fas fa-moon"></i></span><span>Dark Theme</span>';
            btn.style.backgroundColor = '#363636';
            btn.style.color = 'white';
        }
        localStorage.setItem('theme', theme); // Sauvegarder le thème dans le localStorage
    });
});
