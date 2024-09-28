export function model_resultados(equipos) {
  return `
       <tr>
          <td>${equipos.posicion}</td>
          <td>
              <div class="equipo">
                <img src= ${equipos.escudo} alt="Logo ${equipos.equipo}">
                <span>${equipos.equipo}</span>
              </div>
          </td>
          <td> ${equipos.jugados}</td>
          <td> ${equipos.ganados}</td>
          <td> ${equipos.empatados}</td>
          <td> ${equipos.perdidos}</td>
          <td> ${equipos.golesFavor}</td>
          <td> ${equipos.golesContra}</td>
          <td> ${equipos.diferencia}</td>
          <td> ${equipos.puntos}</td>
        </tr>
  `;
        
    

}
