<?php
include '../utils/conexion.php';
conectar();

if (isset($_GET['id'])) {
    $id_equipo = (int)$_GET['id'];

    // Obtener los datos del equipo desde la base de datos
    $sql = "SELECT * FROM equipos WHERE id = $id_equipo";
    $result = mysqli_query($con, $sql);
    $equipo = mysqli_fetch_assoc($result);

    if (!$equipo) {
        echo "<p class='error'>Equipo no encontrado.</p>";
        exit();
    }

    // Variables de los datos actuales del equipo
    $nombre = $equipo['nombre'];
    $ciudad = $equipo['ciudad'];
    $img_actual = $equipo['img'];  // Ruta de la imagen actual

    // Procesar el formulario de edición
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
        $ciudad = mysqli_real_escape_string($con, $_POST['ciudad']);

        // Si se selecciona una nueva imagen
        if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
            $img_tmp = $_FILES['img']['tmp_name'];
            $img_name = $_FILES['img']['name'];
            $img_type = $_FILES['img']['type'];
            $img_size = $_FILES['img']['size'];

            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($img_type, $allowed_types)) {
                // Eliminar la imagen anterior del servidor si es necesario
                if (file_exists($img_actual)) {
                    unlink($img_actual);
                }

                // Definir el directorio donde se almacenará la nueva imagen
                $upload_dir = '../uploads/equipos/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                // Crear un nombre único para la nueva imagen
                $img_new_name = uniqid() . '-' . basename($img_name);
                $img_path = $upload_dir . $img_new_name;

                if (move_uploaded_file($img_tmp, $img_path)) {
                    // Actualizar los datos del equipo en la base de datos con la nueva imagen
                    $sql_update = "UPDATE equipos SET nombre = '$nombre', ciudad = '$ciudad', img = '$img_path' WHERE id = $id_equipo";
                    if (mysqli_query($con, $sql_update)) {
                        header("Location: admin_dashboard.php?modulo=equipos&accion=listar&success=equipo_editado");
                        exit();
                    } else {
                        echo "<p class='error'>Error al actualizar el equipo: " . mysqli_error($con) . "</p>";
                    }
                } else {
                    echo "<p class='error'>Error al subir la nueva imagen.</p>";
                }
            } else {
                echo "<p class='error'>Solo se permiten imágenes (JPG, PNG, GIF).</p>";
            }
        } else {
            // Si no se selecciona una nueva imagen, solo actualizar el nombre y ciudad
            $sql_update = "UPDATE equipos SET nombre = '$nombre', ciudad = '$ciudad' WHERE id = $id_equipo";
            if (mysqli_query($con, $sql_update)) {
                header("Location: admin_dashboard.php?modulo=equipos&accion=listar&success=equipo_editado");
                exit();
            } else {
                echo "<p class='error'>Error al actualizar el equipo: " . mysqli_error($con) . "</p>";
            }
        }
    }
} else {
    echo "<p class='error'>No se especificó el equipo a editar.</p>";
}
?>

<h2>Editar Equipo</h2>
<form method="POST" enctype="multipart/form-data" action="">
    <label for="nombre">Nombre del Equipo:</label>
    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>

    <label for="ciudad">Ciudad:</label>
    <input type="text" id="ciudad" name="ciudad" value="<?php echo htmlspecialchars($ciudad); ?>" required>

    <label for="img">Imagen (Logo):</label>
    <input type="file" id="img" name="img" accept="image/jpeg, image/png, image/gif">

    <?php if ($img_actual): ?>
        <p><strong>Imagen actual:</strong> <img src="<?php echo htmlspecialchars($img_actual); ?>" style="width: 50px;" alt="Logo"></p>
    <?php endif; ?>

    <button type="submit">Guardar Cambios</button>
</form>
