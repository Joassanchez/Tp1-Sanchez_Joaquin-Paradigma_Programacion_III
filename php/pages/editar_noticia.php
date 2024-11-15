<?php
include './php/utils/conexion.php'; // Asegúrate de que la ruta de conexión sea correcta
conectar();

// Verificar si el usuario es administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: index.php");
    exit();
}

// Verificar si se ha recibido el ID de la noticia
if (isset($_GET['id'])) {
    $id_noticia = $_GET['id'];

    // Obtener la noticia actual
    $sql = "SELECT * FROM noticias WHERE id = $id_noticia";
    $result = mysqli_query($con, $sql);
    $noticia = mysqli_fetch_assoc($result);
    
    if (!$noticia) {
        echo "Noticia no encontrada.";
        exit();
    }

    // Verificar si el formulario fue enviado para actualizar la noticia
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titulo = mysqli_real_escape_string($con, $_POST['titulo']);
        $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
        $img = $_FILES['img']['name'];

        // Subir la nueva imagen si se ha proporcionado
        if ($img) {
            $target_dir = "../images/";
            $target_file = $target_dir . basename($img);
            move_uploaded_file($_FILES['img']['tmp_name'], $target_file);
            $img = ", img = '$img'";
        }

        // Actualizar la noticia
        $sql_update = "UPDATE noticias SET titulo = '$titulo', descripcion = '$descripcion' $img WHERE id = $id_noticia";

        if (mysqli_query($con, $sql_update)) {
            header("Location: noticias.php");
            exit();
        } else {
            echo "Error al actualizar la noticia: " . mysqli_error($con);
        }
    }
} else {
    echo "ID de noticia no especificado.";
    exit();
}
?>


<form action="index.php?modulo=editar_noticia&id=<?php echo $noticia['id']; ?>" method="POST" enctype="multipart/form-data" class="formulario">
    <h2>Editar Noticia</h2>

    <div class="campo">
        <label for="titulo">Título</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($noticia['titulo']); ?>" required>
    </div>

    <div class="campo">
        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($noticia['descripcion']); ?></textarea>
    </div>

    <div class="campo">
        <label for="img">Imagen</label>
        <input type="file" id="img" name="img" accept="image/*">
        <img src="../images/<?php echo htmlspecialchars($noticia['img']); ?>" alt="Imagen actual" width="100">
    </div>

    <button type="submit" class="boton-enviar">Actualizar Noticia</button>
</form>

</form>
