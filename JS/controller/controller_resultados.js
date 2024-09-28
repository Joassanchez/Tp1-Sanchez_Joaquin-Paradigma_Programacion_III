import { model_resultados } from "../model/model_resultados.js";

/* FUNCION PARA CREAR COMPONENTES*/

export async function componentePosiciones() {
  try {
    // Cargar el JSON con fetch
    const res = await fetch("../JS/json/resultados.json");
    const data = await res.json();

    // Asignamos una variable con la posición del contenedor de posiciones
    const contenedorPosiciones = document.getElementById("contenedor-posiciones");

   data.equipos.forEach((equipo) => {
      // Crear el tr
      const tr = document.createElement("tr");
      tr.classList.add("posicion");

      // Usar el modelo para renderizar los equipos
      tr.innerHTML = model_resultados(equipo);

      // Agregar el artículo al contenedor
      contenedorPosiciones.appendChild(tr);
    });
  } catch (error) {
    console.error("Error al cargar el JSON:", error);
  }
}




//FUNCION DE FILTAR EQUIPOS
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






