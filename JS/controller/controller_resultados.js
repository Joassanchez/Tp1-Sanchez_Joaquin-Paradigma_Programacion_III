import { model_resultados } from "../model/model_resultados.js";

/* FUNCION PARA CREAR COMPONENTES*/
export async function componentePosiciones() {
  try {
    // Cargar el JSON con fetch
    const res = await fetch("../JS/json/resultados.json");
    const data = await res.json();

    // Asignamos una variable con la posición del contenedor de posiciones
    const contenedorPosiciones = document.getElementById("contenedor-posiciones");

    // Vaciar cualquier contenido previo
    contenedorPosiciones.innerHTML = '';

    // Iterar sobre los equipos y agregarlos a la tabla
    data.equipos.forEach((equipo) => {
      // Crear el tr
      const tr = document.createElement("tr");
      tr.classList.add("posicion");

      // Usar el modelo para renderizar los equipos (incluye una clase 'equipo' en el HTML generado)
      tr.innerHTML = model_resultados(equipo);

      // Agregar el equipo a la tabla
      contenedorPosiciones.appendChild(tr);
    });

    // Verificar si DataTable ya está inicializado
    if ($.fn.DataTable.isDataTable('.table')) {
      // Si la tabla ya está inicializada, destruirla
      $('.table').DataTable().destroy();
    }

    // Inicializar DataTables después de agregar los datos
    $('.table').DataTable({
      language: {
          search: "Buscar equipo:",
          lengthMenu: "Mostrar _MENU_ equipos por página",
          zeroRecords: "No se encontraron resultados",
          info: "Mostrando página _PAGE_ de _PAGES_",
          infoEmpty: "No hay datos disponibles",
          infoFiltered: "( Filtrado de _MAX_ registros en total )",
          paginate: {
              first: "Primero",
              last: "Último",
              next: "Siguiente",
              previous: "Anterior"
          }
      },
      lengthMenu: [ [10, 25], [10, 25] ]  // Solo mostrar 10 y 25 como opciones
  });
  
  } catch (error) {
    console.error("Error al cargar el JSON:", error);
  }
}

// Llamar a la función para cargar las posiciones al cargar la página
document.addEventListener('DOMContentLoaded', componentePosiciones);


