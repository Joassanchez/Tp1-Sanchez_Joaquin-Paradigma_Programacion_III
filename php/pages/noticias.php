<section class="container">
    <h2>Noticias Recientes</h2>
    <div id="contenedor-noticias" class="noticias-grid">
        <?php 
        // Verificar si el usuario es administrador
        $es_admin = isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'; // Suponiendo que el rol de usuario se guarda en la sesión

        // Consulta para obtener las noticias más recientes
        $sql = "SELECT * FROM noticias WHERE estatus = 1 ORDER BY fecha_publicacion DESC";
        $result = mysqli_query($con, $sql);
        
        // Verificar si hay resultados
        if (mysqli_num_rows($result) > 0) {
            // Recorremos las noticias
            while ($noticia = mysqli_fetch_array($result)) {
                // Asegúrate de que las variables 'img' y 'alt' existan en la base de datos y no sean nulas
                $img = isset($noticia['img']) ? $noticia['img'] : 'default.jpg'; // Imagen por defecto si no existe
                $alt = isset($noticia['alt']) ? $noticia['alt'] : 'Imagen de la noticia'; // Texto alternativo por defecto
                ?>
                
                <!-- Renderiza la noticia con la estructura similar a model_noticias -->
                <article class="noticia">
                    <img src="images/<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($alt); ?>" />
                    <div class="noticia-content">
                        <h3><?php echo htmlspecialchars($noticia['titulo']); ?></h3>
                        <p><?php echo htmlspecialchars($noticia['descripcion']); ?></p>
                        <a class="boton-mas-info" href="index.php?modulo=noticia_detalle&id=<?php echo $noticia['id']; ?>">Ver Más...</a>

                        <?php if ($es_admin) { ?>
                        <!-- Botones de Edición y Eliminación solo visibles para administradores -->
                        <a href="index.php?modulo=editar_noticia&id=<?php echo $noticia['id']; ?>" class="boton-editar">Editar</a>
                        <a href="index.php?modulo=eliminar_noticia&id=<?php echo $noticia['id']; ?>" class="boton-eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta noticia?')">Eliminar</a>
                        <?php } ?>


                    </div>
                </article>

                <?php
            }
        } else {
            echo "<p>No hay noticias disponibles.</p>";
        }
        ?>
    </div>

    <?php if ($es_admin) { ?>
    <!-- Botón para crear una nueva noticia (solo visible para administradores) -->
    <div class="boton-crear">
        <a href="index.php?modulo=crear_noticia" class="boton-crear-nueva">Crear Nueva Noticia</a>
    </div>
    <?php } ?>

</section>
