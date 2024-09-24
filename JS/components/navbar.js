document.addEventListener('DOMContentLoaded', function() {
    const menuIcon = document.getElementById('menu-icon');
    const barraNavegacion = document.getElementById('barra_navegacion');

    menuIcon.addEventListener('click', function() {
        barraNavegacion.classList.toggle('show');
    });
});
