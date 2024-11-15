<?php
session_start();
include '../utils/conexion.php'; // Asegúrate de que la ruta de conexión sea correcta

// Llamada a la función conectar para inicializar $con
conectar(); // No es necesario capturar el valor de retorno, ya que se está utilizando global $con

// Validar si se recibieron los datos del formulario
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];

    // Consulta para obtener el usuario y su rol
    $sql = "SELECT u.id, u.username, u.password, r.nombre AS rol
            FROM usuarios u
            JOIN roles r ON u.id_rol = r.id
            WHERE u.email = '$email' AND u.estatus = 1";
    
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        
        // Verificar la contraseña
        if (password_verify($password, $user['password'])) {
            // Autenticación exitosa, guardar datos en sesión
            $_SESSION['nombre_usuario'] = $user['username'];  // Asegúrate de que 'username' es el campo correcto
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['rol'] = $user['rol'];

            // Redirigir al usuario según su rol
            if ($user['rol'] === 'admin') {
                header("Location: ../admin/admin_dashboard.php");
            } else {
                header("Location: ../../index.php");
            }
            exit();
        } else {
            // Contraseña incorrecta, redirigir a login con mensaje de error
            header("Location: ../../index.php?modulo=login&error=password_incorrect");
            exit();
        }
    } else {
        // Usuario no encontrado o cuenta desactivada, redirigir a login con mensaje de error
        header("Location: ../../index.php?modulo=login&error=user_not_found");
        exit();
    }
} else {
    // Datos del formulario no recibidos, redirigir a login con mensaje de error
    header("Location: ../../index.php?modulo=login&error=fields_missing");
    exit();
}

// Cerrar la conexión a la base de datos
desconectar(); // Cierra la conexión globalmente
?>
