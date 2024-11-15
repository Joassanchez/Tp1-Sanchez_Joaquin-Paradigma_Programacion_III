<?php
include '../utils/conexion.php';
conectar();

if (!isset($_GET['id'])) {
    header("Location: admin_dashboard.php?modulo=noticias&accion=listar");
    exit();
}

$id = (int)$_GET['id'];
$query = "SELECT * FROM noticias WHERE id = $id";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) == 0) {
    echo "Noticia no encontrada.";
    exit();
}

$noticia = mysqli_fetch_assoc($result);

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
        echo "Error al editar la noticia: " . mysqli_error($con);
    }
}
?>

<h2>Editar Noticia</h2>
<form method="POST" enctype="multipart/form-data">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($noticia['titulo']); ?>" required>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($noticia['descripcion']); ?></textarea>

    <label for="img">Imagen:</label>
    <input type="file" id="img" name="img">
    <img src="<?php echo htmlspecialchars($noticia['img']); ?>" style="width: 50px;" alt="Imagen actual">

    <label for="estatus">Activo:</label>
    <input type="checkbox" id="estatus" name="estatus" <?php echo ($noticia['estatus'] == 1) ? 'checked' : ''; ?>>

    <button type="submit">Actualizar Noticia</button>
</form>
