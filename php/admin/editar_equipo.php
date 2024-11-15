<?php
include '../utils/conexion.php';
conectar();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM equipos WHERE id = $id";
    $result = mysqli_query($con, $sql);
    $equipo = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $ciudad = $_POST['ciudad'];
        $img = $_POST['img'];

        $sql_update = "UPDATE equipos SET nombre = '$nombre', ciudad = '$ciudad', img = '$img' WHERE id = $id";
        if (mysqli_query($con, $sql_update)) {
            header("Location: admin_dashboard.php?modulo=ver_equipos&success=equipo_actualizado");
        } else {
            echo "Error al actualizar equipo: " . mysqli_error($con);
        }
    }
} else {
    echo "<p>ID de equipo no especificado.</p>";
    exit();
}
?>

<h2>Editar Equipo</h2>
<form method="POST" action="">
    <label>Nombre del Equipo</label>
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($equipo['nombre']); ?>" required>

    <label>Ciudad</label>
    <input type="text" name="ciudad" value="<?php echo htmlspecialchars($equipo['ciudad']); ?>" required>

    <label>Imagen (URL)</label>
    <input type="text" name="img" value="<?php echo htmlspecialchars($equipo['img']); ?>" required>

    <button type="submit">Actualizar Equipo</button>
</form>
