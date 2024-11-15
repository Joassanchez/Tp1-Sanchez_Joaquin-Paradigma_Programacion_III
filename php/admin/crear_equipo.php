<?php
include '../utils/conexion.php';
conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $ciudad = $_POST['ciudad'];
    $img = $_POST['img'];  // Aquí puedes añadir lógica para subir la imagen

    $sql = "INSERT INTO equipos (nombre, ciudad, img, estatus) VALUES ('$nombre', '$ciudad', '$img', 1)";
    if (mysqli_query($con, $sql)) {
        header("Location: admin_dashboard.php?modulo=ver_equipos&success=equipo_creado");
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<h2>Crear Equipo</h2>
<form method="POST" action="">
    <label>Nombre del Equipo</label>
    <input type="text" name="nombre" required>

    <label>Ciudad</label>
    <input type="text" name="ciudad" required>

    <label>Imagen (URL)</label>
    <input type="text" name="img" required>

    <button type="submit">Crear Equipo</button>
</form>
