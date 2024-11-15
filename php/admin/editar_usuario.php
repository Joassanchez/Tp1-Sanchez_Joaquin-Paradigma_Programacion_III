<?php
include '../utils/conexion.php';
conectar();

// Verificar si el usuario es administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../../index.php"); // Redirigir si no es admin
    exit();
}

// Verificar si el ID del usuario está presente en la URL
if (isset($_GET['id'])) {
    $id_usuario = (int)$_GET['id'];

    // Obtener los detalles del usuario para prellenar el formulario
    $query = "SELECT * FROM usuarios WHERE id = $id_usuario";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 0) {
        echo "<p>Usuario no encontrado.</p>";
        exit();
    }

    $usuario = mysqli_fetch_assoc($result);
} else {
    echo "<p>ID de usuario no especificado.</p>";
    exit();
}
?>

<div class="contenedor-centrado">
    <h2>Editar Usuario</h2>
    <form action="procesar_editar_usuario.php" method="POST" class="formulario">
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">

        <div class="campo">
            <label for="username">Nombre de Usuario</label>
            <input type="text" id="username" name="username" value="<?php echo $usuario['username']; ?>" required>
        </div>

        <div class="campo">
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" value="<?php echo $usuario['email']; ?>" required>
        </div>

        <div class="campo">
            <label for="rol">Rol</label>
            <select id="rol" name="rol" required>
                <option value="1" <?php if ($usuario['id_rol'] == 1) echo 'selected'; ?>>Administrador</option>
                <option value="2" <?php if ($usuario['id_rol'] == 2) echo 'selected'; ?>>Usuario</option>
            </select>
        </div>

        <button type="submit" class="boton-enviar">Guardar Cambios</button>
    </form>
</div>
