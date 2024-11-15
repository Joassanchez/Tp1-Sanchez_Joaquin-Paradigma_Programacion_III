<?php
include '../utils/conexion.php';
conectar();

$sql = "SELECT * FROM noticias WHERE estatus = 1";
$result = mysqli_query($con, $sql);

if (isset($_GET['success'])) {
    if ($_GET['success'] == 'noticia_creada') {
        echo "<p class='message success'>¡Noticia creada exitosamente!</p>";
    } elseif ($_GET['success'] == 'noticia_editada') {
        echo "<p class='message success'>¡Noticia editada exitosamente!</p>";
    } elseif ($_GET['success'] == 'noticia_eliminada') {
        echo "<p class='message success'>¡Noticia eliminada exitosamente!</p>";
    }
}

// Eliminar noticia
if (isset($_GET['delete'])) {
    $id_noticia = (int)$_GET['delete'];
    $sql_delete = "DELETE FROM noticias WHERE id = $id_noticia";
    if (mysqli_query($con, $sql_delete)) {
        header("Location: admin_dashboard.php?modulo=noticias&accion=listar&success=noticia_eliminada");
        exit();
    } else {
        echo "Error al eliminar la noticia: " . mysqli_error($con);
    }
}
?>

<h2>Lista de Noticias</h2>
<a href="admin_dashboard.php?modulo=noticias&accion=crear">Crear Nueva Noticia</a>

<?php if (mysqli_num_rows($result) > 0): ?>
    <table border="1">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($noticia = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><img src="<?php echo htmlspecialchars($noticia['img']); ?>" style="width: 50px;" alt="Imagen de la noticia"></td>
                    <td><?php echo htmlspecialchars($noticia['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($noticia['descripcion']); ?></td>
                    <td>
                        <a href="admin_dashboard.php?modulo=noticias&accion=editar&id=<?php echo $noticia['id']; ?>">Editar</a>
                        <a href="admin_dashboard.php?modulo=noticias&accion=listar&delete=<?php echo $noticia['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar esta noticia?')">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No hay noticias disponibles.</p>
<?php endif; ?>
