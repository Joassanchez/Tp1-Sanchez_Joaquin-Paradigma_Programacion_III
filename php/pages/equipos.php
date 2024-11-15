<section class="container">
    <h2>Equipos de primera division</h2>
    <div class="equipos-grid" id="equipos-grid">
        
        <?php 
            // Realizar la consulta para obtener los equipos activos
            $sql = "SELECT * FROM equipos WHERE estatus = 1";
            $result = mysqli_query($con, $sql);

            // Verificar si la consulta fue exitosa
            if (!$result) {
                die('Error en la consulta: ' . mysqli_error($con)); // Depuración de errores
            }

            // Verificar si hay resultados
            if (mysqli_num_rows($result) > 0) {
                // Usamos un array para almacenar los nombres de los equipos y evitar duplicados
                $equipos_mostrados = array();

                // Recorremos los equipos
                while ($equipo = mysqli_fetch_assoc($result)) {
                    // Verificamos si el equipo ya fue mostrado
                    if (in_array($equipo['nombre'], $equipos_mostrados)) {
                        continue; // Si el equipo ya fue mostrado, lo saltamos
                    }

                    // Marcamos el equipo como mostrado
                    $equipos_mostrados[] = $equipo['nombre']; // Usamos el nombre del equipo para evitar duplicados

                    // Asignamos la imagen y nombre directamente sin control de nulos
                    $img = $equipo['img'];  // Imagen
                    $nombre = $equipo['nombre'];  // Nombre
                    $ciudad = $equipo['ciudad'];  // Ciudad
        ?>
        
        <!-- Renderizamos el artículo con la información del equipo -->
        <article class="equipo">
            <img src="<?php echo htmlspecialchars($img); ?>" alt="Logo <?php echo htmlspecialchars($nombre); ?>" />
            <h3><?php echo htmlspecialchars($nombre); ?></h3>
            <p> Ciudad: <?php echo htmlspecialchars($ciudad); ?></p>
        </article>

        <?php
                }
            } else {
                echo "<p>No hay equipos disponibles.</p>";
            }
        ?>
    </div>
</section>
