export function model_noticias(noticia) {
    return `
      <img src="${noticia.imagen}" alt="${noticia.alt}">
      <div class="noticia-content">
        <h3>${noticia.titulo}</h3>
        <p>${noticia.descripcion}</p>
      </div>
    `;
  }
  