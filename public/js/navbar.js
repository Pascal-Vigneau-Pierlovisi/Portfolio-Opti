document.addEventListener('DOMContentLoaded', () => {

    // Récupérer tous les éléments "navbar-burger"
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

    // Vérifier s'il y a des éléments navbar-burger
    if ($navbarBurgers.length > 0) {

        // Ajouter un événement click sur chacun d'eux
        $navbarBurgers.forEach(el => {
            el.addEventListener('click', () => {

                // Récupérer la cible à partir de l'attribut "data-target"
                const target = el.dataset.target;
                const $target = document.getElementById(target);

                // Basculer la classe "is-active" sur le "navbar-burger" et la "navbar-menu"
                el.classList.toggle('is-active');
                $target.classList.toggle('is-active');

            });
        });
    }

});
