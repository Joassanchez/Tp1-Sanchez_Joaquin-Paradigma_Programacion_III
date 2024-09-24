document.addEventListener('DOMContentLoaded', function() {
    // Filtrado de equipos
    const filtroInput = document.getElementById('filtroEquipo');

    filtroInput.addEventListener('input', function() {
        const filtro = this.value.toLowerCase();
        const filas = document.querySelectorAll('.table tbody tr');

        filas.forEach(fila => {
            const nombreEquipo = fila.querySelector('.equipo span').textContent.toLowerCase();
            if (nombreEquipo.includes(filtro)) {
                fila.style.display = ''; // Mostrar la fila
            } else {
                fila.style.display = 'none'; // Ocultar la fila
            }
        });
    });

});
