<?php
include '../utils/conexion.php';

conectar();

// Verificar si el usuario es administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../../index.php");
    exit();
}

// Verificar si se proporciona un ID para eliminar
if (isset($_GET['eliminar'])) {
    $id = (int)$_GET['eliminar'];

    // Verificar si el usuario actual está definido en la sesión
    if (isset($_SESSION['id']) && $_SESSION['id'] == $id) {
        echo "<p class='error'>No puedes eliminar tu propia cuenta.</p>";
    } else {
        $deleteQuery = "DELETE FROM usuarios WHERE id = $id";
        if (mysqli_query($con, $deleteQuery)) {
            echo "<p class='success'>Usuario eliminado correctamente.</p>";
        } else {
            echo "<p class='error'>Error al eliminar el usuario: " . mysqli_error($con) . "</p>";
        }
    }
}


// Obtener lista de usuarios
$query = "SELECT * FROM usuarios";
$result = mysqli_query($con, $query);
?>

<h2>Lista de Usuarios</h2>

<table class="tabla">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo $row['id_rol'] == 1 ? 'Admin' : 'Usuario'; ?></td>
                <td>
                    <a href="admin_dashboard.php?modulo=usuarios&accion=editar&id=<?php echo $row['id']; ?>">Editar</a>
                    <a href="admin_dashboard.php?modulo=usuarios&eliminar=<?php echo $row['id']; ?>" 
                       onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<a href="admin_dashboard.php?modulo=usuarios&accion=crear" class="boton">Crear Usuario</a>
