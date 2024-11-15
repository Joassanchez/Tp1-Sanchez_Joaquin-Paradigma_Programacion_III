// searchTeams.js
export function filterTeams() {
    // Al escribir en la barra de búsqueda
    const searchInput = document.getElementById('search-input');

    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.toLowerCase(); // Obtiene el valor de la barra de búsqueda

        // Filtra los equipos
        const equipos = document.querySelectorAll('#equipos-grid .equipo');
        
        equipos.forEach((equipo) => {
            const equipoNombre = equipo.getAttribute('data-nombre').toLowerCase(); // Obtiene el nombre del equipo (en minúsculas)

            if (equipoNombre.indexOf(searchTerm) !== -1) {
                equipo.style.display = ''; // Si el nombre coincide, lo muestra
            } else {
                equipo.style.display = 'none'; // Si no coincide, lo oculta
            }
        });
    });
}
