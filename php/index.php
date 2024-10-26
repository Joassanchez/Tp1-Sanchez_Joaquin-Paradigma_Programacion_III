<?php
include '../php/conexion.php'; 

function obtenerGaleria()
{
    global $con;
    $consulta = "SELECT img, titulo, descripcion FROM noticias WHERE estatus = 'Activo'";
    $result = mysqli_query($con, $consulta); 

    $imagenes = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $imagenes[] = $row;
    }
    return $imagenes;
}

// Conectar a la base de datos
conectar();
$imagenes = obtenerGaleria(); // Obtener las imágenes
desconectar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fútbol Argentino - Inicio</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <header>
        <div class="header-content">
            <div class="menu-icon" id="menu-icon">&#9776;</div>
            <h1>Fútbol Argentino</h1>
        </div>
        <nav class="Nav">
            <ul class="barra_navegacion" id="barra_navegacion">
                <li><a href="./index.php">Inicio</a></li>
                <li><a href="./pages/equipos.php">Equipos</a></li>
                <li><a href="./pages/resultados.php">Resultados</a></li>
                <li><a href="./pages/historia.php">Historia</a></li>
                <li><a href="./pages/tienda.php">Tienda</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="container">
          <h2>Noticias Recientes</h2>
          <div id="contenedor-noticias" class="noticias-grid">
            <?php
            // Renderizar noticias desde el array $imagenes
            foreach ($imagenes as $noticia) {
                echo model_noticias($noticia);
            }
            ?>  
          </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Fútbol Argentino - Creado por Sanchez Joaquin</p>
    </footer>
    <script type="module" src="../JS/main.js"></script>

</body>
</html>