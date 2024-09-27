import { model_noticias} from "../model/model_noticias.js";

/* FUNCIÓN PARA CREAR COMPONENTES */
export async function componenteNoticia() {
  try {
    // Cargar el JSON con fetch
    const res = await fetch("../JS/json/noticias.json");
    const data = await res.json();

    // Asignamos una variable con la posición del contenedor de noticias
    const contenedorNoticias = document.getElementById("contenedor-noticias");

    data.noticiasRecientes.forEach((noticia) => {
      // Crear el artículo
      const article = document.createElement("article");
      article.classList.add("noticia");

      // Usar el modelo para renderizar la noticia
      article.innerHTML = model_noticias(noticia);

      // Agregar el artículo al contenedor
      contenedorNoticias.appendChild(article);
    });
  } catch (error) {
    console.error("Error:", error);
  }
}
