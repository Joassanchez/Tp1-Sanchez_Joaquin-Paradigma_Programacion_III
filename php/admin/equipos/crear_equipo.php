<?php
include '../utils/conexion.php';
conectar();

// Comprobamos si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $ciudad = mysqli_real_escape_string($con, $_POST['ciudad']);
    $estatus = isset($_POST['estatus']) ? 1 : 0;

    // Subida de la imagen (logo del equipo)
    $img = '';
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $target_dir = "uploads/equipos/";  // Carpeta donde se guardarán las imágenes
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
        $img = $target_file; // Asignamos la ruta de la imagen
    }

    // Insertar el equipo en la base de datos
    $query = "INSERT INTO equipos (nombre, img, ciudad, estatus) 
              VALUES ('$nombre', '$img', '$ciudad', '$estatus')";
    if (mysqli_query($con, $query)) {
        header("Location: admin_dashboard.php?modulo=equipos&accion=listar&success=equipo_creado");
        exit();
    } else {
        echo "<p class='error'>Error al crear el equipo: " . mysqli_error($con) . "</p>";
    }
}
?>

<div class="contenedor-centrado">
    <h2>Crear Nuevo Equipo</h2>
    <form method="POST" enctype="multipart/form-data" class="formulario">
        <div class="campo">
            <label for="nombre">Nombre del Equipo:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <div class="campo">
            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" required>
        </div>

        <div class="campo">
            <label for="img">Imagen (Logo):</label>
            <input type="file" id="img" name="img">
        </div>

        <div class="campo">
            <label for="estatus">Activo:</label>
            <input type="checkbox" id="estatus" name="estatus" checked> 
        </div>

        <button type="submit" class="boton-enviar">Crear Equipo</button>
    </form>
</div>
