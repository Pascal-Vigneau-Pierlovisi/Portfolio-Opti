document.addEventListener('DOMContentLoaded', () => {
    // Obtenez tous les onglets de filtre et les cartes
    const filterTabs = document.querySelectorAll('.tabs ul li');
    const allCards = document.querySelectorAll('#projects-grid .column');

    // Fonction pour filtrer les projets
    function filterProjects(filter) {
        allCards.forEach(card => {
            if (filter === 'all' || card.getAttribute('data-category') === filter) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Ajout de l'écouteur d'événements pour chaque onglet
    filterTabs.forEach(tab => {
        tab.addEventListener('click', (e) => {
            // Empêche le comportement par défaut des liens
            e.preventDefault();
            // Récupère la catégorie de l'onglet cliqué
            const filter = tab.getAttribute('data-filter');
            // Filtre les projets en fonction de la catégorie sélectionnée
            filterProjects(filter);
            // Mise à jour de la classe 'is-active'
            filterTabs.forEach(t => t.classList.remove('is-active'));
            tab.classList.add('is-active');
        });
    });

    // Filtrer par défaut sur tous les projets
    filterProjects('all');
});
