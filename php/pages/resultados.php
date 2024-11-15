<?php
// Consulta para obtener las posiciones de los equipos y la imagen del escudo
$sql = "
    SELECT 
        p.*, 
        e.nombre AS equipo, 
        e.img AS img  
    FROM tabla_posiciones p
    JOIN equipos e ON p.id_equipo = e.id
    WHERE p.estatus = 1 AND e.estatus = 1
    ORDER BY p.puntos DESC, p.goles_diferencia DESC, p.goles_favor DESC
";

$result = mysqli_query($con, $sql);

// Verificar si la consulta se ejecutó correctamente
if ($result) {
    // Iniciar la estructura de la tabla
    echo '<section class="container">';
    echo '<h2>Posiciones de la Liga Profesional de Argentina 2024</h2>';
    echo '<article>';
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>#</th>';
    echo '<th class="Espaciado">Equipo</th>';
    echo '<th>J</th>';
    echo '<th>G</th>';
    echo '<th>E</th>';
    echo '<th>P</th>';
    echo '<th>GF</th>';
    echo '<th>GC</th>';
    echo '<th>DIF</th>';
    echo '<th>PTS</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody id="contenedor-posiciones">';
    
    // Recorrer los resultados y mostrar las filas en la tabla
    while ($row = mysqli_fetch_assoc($result)) {
        // Verificar si la imagen existe, y si no, usar una imagen predeterminada
        $img = $row['img'] ? $row['img'] : 'default.jpg'; // Usa una imagen por defecto si no existe
        $imgPath = '' . $img; // Asegúrate de que la carpeta 'images/' exista

        // Validamos si la imagen existe en el directorio
        if (!file_exists($imgPath)) {
            $imgPath = 'images/default.jpg'; // Si la imagen no existe, mostrar una imagen por defecto
        }

        // Generar las filas de la tabla
        echo "<tr class='posicion'>";
        echo "<td>" . $row['id'] . "</td>"; // Posición
        echo "<td>
                <div class='equipo'>
                    <img src='" . $imgPath . "' alt='Logo " . htmlspecialchars($row['equipo']) . "' class='escudo'>
                    <span>" . htmlspecialchars($row['equipo']) . "</span>
                </div>
              </td>"; // Nombre del equipo con su logo
        echo "<td>" . $row['partidos_jugados'] . "</td>"; // Partidos jugados
        echo "<td>" . $row['partidos_ganados'] . "</td>"; // Partidos ganados
        echo "<td>" . $row['partidos_empatados'] . "</td>"; // Partidos empatados
        echo "<td>" . $row['partidos_perdidos'] . "</td>"; // Partidos perdidos
        echo "<td>" . $row['goles_favor'] . "</td>"; // Goles a favor
        echo "<td>" . $row['goles_contra'] . "</td>"; // Goles en contra
        echo "<td>" . $row['goles_diferencia'] . "</td>"; // Diferencia de goles
        echo "<td>" . $row['puntos'] . "</td>"; // Puntos
        echo "</tr>";
    }
    
    // Cerrar la tabla y la estructura del HTML
    echo '</tbody>';
    echo '</table>';
    echo '</article>';
    echo '</section>';
} else {
    // Si no hay resultados o si hubo un error en la consulta
    echo "<p>No hay datos disponibles.</p>";
}

// Cerrar la conexión a la base de datos
mysqli_close($con);
?>

