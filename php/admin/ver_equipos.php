<?php
include '../utils/conexion.php';
conectar();

$sql = "SELECT * FROM equipos WHERE estatus = 1";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($equipo = mysqli_fetch_assoc($result)) {
        echo "<div>";
        echo "<img src='" . htmlspecialchars($equipo['img']) . "' alt='Logo " . htmlspecialchars($equipo['nombre']) . "'>";
        echo "<h3>" . htmlspecialchars($equipo['nombre']) . "</h3>";
        echo "<p>Ciudad: " . htmlspecialchars($equipo['ciudad']) . "</p>";
        echo "<a href='admin_dashboard.php?modulo=editar_equipo&id=" . $equipo['id'] . "'>Editar</a> ";
        echo "<a href='admin_dashboard.php?modulo=ver_equipos&delete=" . $equipo['id'] . "' onclick='return confirm(\"¿Seguro que quieres eliminar este equipo?\")'>Eliminar</a>";
        echo "</div>";
    }
} else {
    echo "<p>No hay equipos disponibles.</p>";
}

// Eliminar equipo si se recibe el parámetro delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM equipos WHERE id = $id";
    if (mysqli_query($con, $sql)) {
        header("Location: admin_dashboard.php?modulo=ver_equipos&success=equipo_eliminado");
    } else {
        echo "Error al eliminar equipo: " . mysqli_error($con);
    }
}
?>
