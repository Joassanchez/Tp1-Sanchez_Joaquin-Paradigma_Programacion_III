document.addEventListener('DOMContentLoaded', function () {
    
    const filtroInput = document.getElementById('filtroEquipo');

    filtroInput.addEventListener('input', function() {
        const filtro = this.value.toLowerCase();
        const filas = document.querySelectorAll('.table tbody tr');

        filas.forEach(fila => {
            const nombreEquipo = fila.querySelector('.equipo span').textContent.toLowerCase();
            if (nombreEquipo.includes(filtro)) {
                fila.style.display = ''; 
            } else {
                fila.style.display = 'none'; 
            }
        });
    });

});
