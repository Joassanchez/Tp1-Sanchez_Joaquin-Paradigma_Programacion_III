<?php
include '../utils/conexion.php';
conectar();

// Verificar si el usuario es administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../../index.php");
    exit();
}

// Obtener el ID del usuario a editar
if (!isset($_GET['id'])) {
    echo "<p class='error'>No se especificó un usuario para editar.</p>";
    exit();
}

$id = (int)$_GET['id'];

// Obtener los datos actuales del usuario
$query = "SELECT * FROM usuarios WHERE id = $id";
$result = mysqli_query($con, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<p class='error'>Usuario no encontrado.</p>";
    exit();
}

$usuario = mysqli_fetch_assoc($result);

// Procesar el formulario cuando se envíe
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = !empty($_POST['password']) ? password_hash(mysqli_real_escape_string($con, $_POST['password']), PASSWORD_BCRYPT) : $usuario['password'];
    $rol = (int)$_POST['rol'];

    // Actualizar los datos del usuario
    $sql = "UPDATE usuarios SET username = '$username', email = '$email', password = '$password', id_rol = $rol WHERE id = $id";

    if (mysqli_query($con, $sql)) {
        header("Location: admin_dashboard.php?modulo=usuarios&success=usuario_editado");
        exit();
    } else {
        echo "<p class='error'>Error al actualizar el usuario: " . mysqli_error($con) . "</p>";
    }
}
?>

<div class="contenedor-centrado">
    <h2>Editar Usuario</h2>
    <form method="POST" action="" class="formulario">
        <div class="campo">
            <label for="username">Nombre de Usuario</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($usuario['username']) ?>" required>
        </div>

        <div class="campo">
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
        </div>

        <div class="campo">
            <label for="password">Contraseña (Dejar en blanco para no cambiar)</label>
            <input type="password" id="password" name="password">
        </div>

        <div class="campo">
            <label for="rol">Rol</label>
            <select id="rol" name="rol" required>
                <option value="1" <?= $usuario['id_rol'] == 1 ? 'selected' : '' ?>>Administrador</option>
                <option value="2" <?= $usuario['id_rol'] == 2 ? 'selected' : '' ?>>Usuario</option>
            </select>
        </div>

        <button type="submit" class="boton-enviar">Guardar Cambios</button>
    </form>
</div>
