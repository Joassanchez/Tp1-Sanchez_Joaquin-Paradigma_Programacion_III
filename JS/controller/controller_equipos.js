import { model_equipos } from "../model/model_equipos.js"; 

/* FUNCION PARA CREAR COMPONENTES*/

export async function componenteEquipos() {
    try {
        // Cargar el JSON con fetch
        const res = await fetch("../JS/json/resultados.json");
        const data = await res.json();

        // Asignamos una variable con la posición del contenedor de posiciones
        const contenedorEquipos = document.getElementById("equipos-grid");
        data.equipos.forEach((equipo) => {
        // Crear el div
        const article = document.createElement("article");
        article.classList.add("equipo");

        // Usar el modelo para renderizar los equipos
        article.innerHTML = model_equipos(equipo);

        // Agregar el div al contenedor
        contenedorEquipos.appendChild(article);
      });
    } catch (error) {
        console.error("Error al cargar el JSON:", error);
    }
}