<?php
include '../utils/conexion.php';

conectar();

// Verificar si el usuario es administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../../index.php"); // Redirigir si no es admin
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Usuario</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>

<div class="contenedor-centrado">
    <h2>Crear Nuevo Usuario</h2>
    <form action="procesar_creacion_usuario.php" method="POST" class="formulario">
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

</body>
</html>
