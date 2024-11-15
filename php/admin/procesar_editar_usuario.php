<?php
include '../utils/conexion.php';
session_start();
conectar();

// Verificar si el usuario es administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../../index.php"); // Redirigir si no es admin
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = (int)$_POST['id'];
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $rol = (int)$_POST['rol'];

    // Verificar si el nombre de usuario o el correo electrónico ya existen
    $query = "SELECT * FROM usuarios WHERE (username = '$username' OR email = '$email') AND id != $id_usuario";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Error en la consulta de verificación: " . mysqli_error($con));
    }

    if (mysqli_num_rows($result) > 0) {
        echo "<p>El nombre de usuario o correo electrónico ya existe. Por favor, elige otro.</p>";
    } else {
        // Actualizar los datos del usuario en la base de datos
        $sql = "UPDATE usuarios SET username = '$username', email = '$email', id_rol = $rol WHERE id = $id_usuario";
        
        if (mysqli_query($con, $sql)) {
            // Redirigir al dashboard después de la edición exitosa
            header("Location: ../admin/admin_dashboard.php");
            exit();  // Importante para que no se ejecute código adicional después de la redirección
        } else {
            echo "<p>Error al actualizar el usuario: " . mysqli_error($con) . "</p>";
        }
    }
} else {
    echo "<p>Acceso denegado.</p>";
}
?>
