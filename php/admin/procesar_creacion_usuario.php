<?php
include '../utils/conexion.php';
session_start();
conectar();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../../index.php");
    exit();
}

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
        // Redirigir con un parámetro de error
        header("Location: ../admin/admin_dashboard.php?error=usuario_existe");
        exit();  // Importante para evitar que el código posterior se ejecute
    } else {
        // Encriptar la contraseña antes de guardarla
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insertar el nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (username, email, password, id_rol) VALUES ('$username', '$email', '$hashed_password', $rol)";
        
        if (mysqli_query($con, $sql)) {
            // Redirigir al dashboard después de la creación exitosa
            header("Location: ../admin/admin_dashboard.php?success=usuario_creado");
            exit();  // Importante para que no se ejecute código adicional después de la redirección
        } else {
            echo "<p>Error al crear el usuario: " . mysqli_error($con) . "</p>";
        }
    }
} else {
    echo "<p>Acceso denegado.</p>";
}
?>
