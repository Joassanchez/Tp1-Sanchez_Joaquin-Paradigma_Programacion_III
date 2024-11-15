<?php
include '../utils/conexion.php';
conectar();

// Verificar si se ha especificado el ID de la noticia
if (!isset($_GET['id'])) {
    header("Location: admin_dashboard.php?modulo=noticias&accion=listar");
    exit();
}

$id = (int)$_GET['id'];
$query = "SELECT * FROM noticias WHERE id = $id";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<p class='error'>Noticia no encontrada.</p>";
    exit();
}

$noticia = mysqli_fetch_assoc($result);

// Procesar el formulario cuando se envíe
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = mysqli_real_escape_string($con, $_POST['titulo']);
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
    $estatus = isset($_POST['estatus']) ? 1 : 0;

    // Subida de la imagen
    $img = $noticia['img'];  // Conservamos la imagen original
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $target_dir = "uploads/";  // Carpeta donde se guardarán las imágenes
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
        $img = $target_file; // Asignamos la nueva ruta de la imagen
    }

    // Actualizar la noticia en la base de datos
    $query_update = "UPDATE noticias SET 
                        titulo = '$titulo', 
                        img = '$img', 
                        descripcion = '$descripcion', 
                        estatus = '$estatus' 
                     WHERE id = $id";

    if (mysqli_query($con, $query_update)) {
        header("Location: admin_dashboard.php?modulo=noticias&accion=listar&success=noticia_editada");
        exit();
    } else {
        echo "<p class='error'>Error al editar la noticia: " . mysqli_error($con) . "</p>";
    }
}
?>

<div class="contenedor-centrado">
    <h2>Editar Noticia</h2>
    <form method="POST" enctype="multipart/form-data" class="formulario">
        <div class="campo">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($noticia['titulo']); ?>" required>
        </div>

        <div class="campo">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($noticia['descripcion']); ?></textarea>
        </div>

        <div class="campo">
            <label for="img">Imagen:</label>
            <input type="file" id="img" name="img">
            <img src="../<?php echo htmlspecialchars($noticia['img']); ?>" style="width: 50px; margin-top: 10px;" alt="Imagen actual">
        </div>

        <div class="campo">
            <label for="estatus">Activo:</label>
            <input type="checkbox" id="estatus" name="estatus" <?php echo ($noticia['estatus'] == 1) ? 'checked' : ''; ?>>
        </div>

        <button type="submit" class="boton-enviar">Actualizar Noticia</button>
    </form>
</div>
