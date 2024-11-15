<?php
include '../utils/conexion.php';

conectar();

// Verificar si el usuario es administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../../index.php");
    exit();
}

// Procesar el formulario cuando se envíe
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $rol = (int)$_POST['rol'];

    // Verificar si el nombre de usuario o el correo electrónico ya existen
    $query = "SELECT * FROM usuarios WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Error en la consulta de verificación: " . mysqli_error($con));
    }

    if (mysqli_num_rows($result) > 0) {
        echo "<p class='error'>El nombre de usuario o el correo electrónico ya existen.</p>";
    } else {
        // Encriptar la contraseña antes de guardarla
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insertar el nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (username, email, password, id_rol) VALUES ('$username', '$email', '$hashed_password', $rol)";
        
        if (mysqli_query($con, $sql)) {
            header("Location: admin_dashboard.php?modulo=usuarios&success=usuario_creado");
            exit();

        } else {
            echo "<p class='error'>Error al crear el usuario: " . mysqli_error($con) . "</p>";
        }
    }
}
?>

<div class="contenedor-centrado">   
    <h2>Crear Nuevo Usuario</h2>
    <form method="POST" action="" class="formulario">
        <div class="campo">
            <label for="username">Nombre de Usuario</label>
            <input type="text" id="username" name="username" required>
        </div>

        <div class="campo">
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="campo">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="campo">
            <label for="rol">Rol</label>
            <select id="rol" name="rol" required>
                <option value="1">Administrador</option>
                <option value="2">Usuario</option>
            </select>
        </div>

        <button type="submit" class="boton-enviar">Crear Usuario</button>
    </form>
</div>


