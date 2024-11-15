<?php
include './php/utils/conexion.php'; // Asegúrate de que la ruta de conexión sea correcta
conectar();

// Verificar si el usuario es administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: index.php");
    exit();
}

// Verificar si el formulario fue enviado para crear la noticia
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = mysqli_real_escape_string($con, $_POST['titulo']);
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
    $img = $_FILES['img']['name'];

    // Subir la nueva imagen si se ha proporcionado
    if ($img) {
        $target_dir = "../images/";
        $target_file = $target_dir . basename($img);
        move_uploaded_file($_FILES['img']['tmp_name'], $target_file);
    }

    // Insertar la nueva noticia en la base de datos
    $sql_insert = "INSERT INTO noticias (titulo, descripcion, img) VALUES ('$titulo', '$descripcion', '$img')";

    if (mysqli_query($con, $sql_insert)) {
        header("Location: ./index.php");
        exit();
    } else {
        echo "Error al crear la noticia: " . mysqli_error($con);
    }
}
?>

<form action="index.php?modulo=crear_noticia" method="POST" enctype="multipart/form-data" class="formulario">
    <h2>Crear Noticia</h2>

    <div class="campo">
        <label for="titulo">Título</label>
        <input type="text" id="titulo" name="titulo" required>
    </div>

    <div class="campo">
        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" required></textarea>
    </div>

    <div class="campo">
        <label for="img">Imagen</label>
        <input type="file" id="img" name="img" accept="image/*">
    </div>

    <button type="submit" class="boton-enviar">Crear Noticia</button>
</form>
