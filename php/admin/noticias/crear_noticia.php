<?php
include '../utils/conexion.php';
conectar();

// Comprobamos si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = mysqli_real_escape_string($con, $_POST['titulo']);
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
    $estatus = isset($_POST['estatus']) ? 1 : 0;
    
    // Subida de la imagen
    $img = '';
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $target_dir = "uploads/";  // Carpeta donde se guardarán las imágenes
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
        $img = $target_file; // Asignamos la ruta de la imagen
    }

    // Insertar la noticia en la base de datos
    $query = "INSERT INTO noticias (titulo, img, descripcion, estatus) 
              VALUES ('$titulo', '$img', '$descripcion', '$estatus')";
    if (mysqli_query($con, $query)) {
        header("Location: admin_dashboard.php?modulo=noticias&accion=listar&success=noticia_creada");
        exit();
    } else {
        echo "<p class='error'>Error al crear la noticia: " . mysqli_error($con) . "</p>";
    }
}
?>

<div class="contenedor-centrado">
    <h2>Crear Nueva Noticia</h2>
    <form method="POST" enctype="multipart/form-data" class="formulario">
        <div class="campo">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>
        </div>

        <div class="campo">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>
        </div>

        <div class="campo">
            <label for="img">Imagen:</label>
            <input type="file" id="img" name="img">
        </div>

        <div class="campo">
            <label for="estatus">Activo:</label>
            <input type="checkbox" id="estatus" name="estatus" checked> 
        </div>

        <button type="submit" class="boton-enviar">Crear Noticia</button>
    </form>
</div>
