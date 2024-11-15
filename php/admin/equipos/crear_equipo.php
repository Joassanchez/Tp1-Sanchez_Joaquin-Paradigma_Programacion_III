<?php
include '../utils/conexion.php';
conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $ciudad = mysqli_real_escape_string($con, $_POST['ciudad']);

    // Subir la imagen
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $img_tmp = $_FILES['img']['tmp_name'];  // El archivo temporal
        $img_name = $_FILES['img']['name'];  // El nombre original del archivo
        $img_type = $_FILES['img']['type'];  // Tipo de archivo
        $img_size = $_FILES['img']['size'];  // Tamaño del archivo

        // Verificar si el archivo es una imagen (esto es básico, puede ser mejorado)
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($img_type, $allowed_types)) {
            echo "<p class='error'>Solo se permiten imágenes (JPG, PNG, GIF).</p>";
        } else {
            // Definir el directorio donde se almacenará la imagen
            $upload_dir = '../uploads/equipos/';
            // Crear el directorio si no existe
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            // Crear un nombre único para la imagen para evitar conflictos
            $img_new_name = uniqid() . '-' . basename($img_name);
            $img_path = $upload_dir . $img_new_name;

            // Mover el archivo al directorio
            if (move_uploaded_file($img_tmp, $img_path)) {
                // Insertar el equipo en la base de datos con la ruta de la imagen
                $sql_insert = "INSERT INTO equipos (nombre, ciudad, img, estatus) VALUES ('$nombre', '$ciudad', '$img_path', 1)";
                if (mysqli_query($con, $sql_insert)) {
                    header("Location: admin_dashboard.php?modulo=equipos&accion=listar&success=equipo_creado");
                    exit();
                } else {
                    echo "<p class='error'>Error al crear el equipo: " . mysqli_error($con) . "</p>";
                }
            } else {
                echo "<p class='error'>Error al subir la imagen.</p>";
            }
        }
    } else {
        echo "<p class='error'>Por favor, selecciona una imagen para el equipo.</p>";
    }
}
?>

<h2>Crear Nuevo Equipo</h2>
<form method="POST" enctype="multipart/form-data" action="">
    <label for="nombre">Nombre del Equipo:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="ciudad">Ciudad:</label>
    <input type="text" id="ciudad" name="ciudad" required>

    <label for="img">Imagen (Logo):</label>
    <input type="file" id="img" name="img" accept="image/jpeg, image/png, image/gif" required>

    <button type="submit">Crear Equipo</button>
</form>
