export function model_equipos(equipos) {
    
    return `
        <img src= ${equipos.escudo} alt="Logo ${equipos.equipo} ">
        <h3>${equipos.equipo}</h3>
     `;
}