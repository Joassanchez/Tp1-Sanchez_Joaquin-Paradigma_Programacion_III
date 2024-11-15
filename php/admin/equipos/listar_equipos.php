<?php
include '../utils/conexion.php';
conectar();

$sql = "SELECT * FROM equipos WHERE estatus = 1";
$result = mysqli_query($con, $sql);

if (isset($_GET['success'])) {
    if ($_GET['success'] == 'equipo_creado') {
        echo "<p class='message success'>¡Equipo creado exitosamente!</p>";
    } elseif ($_GET['success'] == 'equipo_editado') {
        echo "<p class='message success'>¡Equipo editado exitosamente!</p>";
    } elseif ($_GET['success'] == 'equipo_eliminado') {
        echo "<p class='message success'>¡Equipo eliminado exitosamente!</p>";
    }
}

// Eliminar equipo
if (isset($_GET['delete'])) {
    $id_equipo = (int)$_GET['delete'];
    $sql_delete = "DELETE FROM equipos WHERE id = $id_equipo";
    if (mysqli_query($con, $sql_delete)) {
        header("Location: admin_dashboard.php?modulo=equipos&accion=listar&success=equipo_eliminado");
        exit();
    } else {
        echo "Error al eliminar el equipo: " . mysqli_error($con);
    }
}
?>

<h2>Lista de Equipos</h2>
<a href="admin_dashboard.php?modulo=equipos&accion=crear">Crear Nuevo Equipo</a>

<?php if (mysqli_num_rows($result) > 0): ?>
    <table border="1">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Ciudad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($equipo = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><img src="<?php echo htmlspecialchars($equipo['img']); ?>" style="width: 50px;" alt="Logo"></td>
                    <td><?php echo htmlspecialchars($equipo['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($equipo['ciudad']); ?></td>
                    <td>
                        <a href="admin_dashboard.php?modulo=equipos&accion=editar&id=<?php echo $equipo['id']; ?>">Editar</a>
                        <a href="admin_dashboard.php?modulo=equipos&accion=listar&delete=<?php echo $equipo['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este equipo?')">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No hay equipos registrados.</p>
<?php endif; ?>
