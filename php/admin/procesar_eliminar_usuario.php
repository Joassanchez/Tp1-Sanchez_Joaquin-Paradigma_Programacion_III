<?php
include '../utils/conexion.php';
session_start();
conectar();

// Verificar si el usuario es administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../../index.php"); // Redirigir si no es admin
    exit();
}

// Verificar si el ID del usuario está presente en la URL
if (isset($_GET['id'])) {
    $id_usuario = (int)$_GET['id'];

    // Eliminar el usuario de la base de datos
    $sql = "DELETE FROM usuarios WHERE id = $id_usuario";
    
    if (mysqli_query($con, $sql)) {
        // Redirigir al dashboard después de la eliminación exitosa
        header("Location: ../admin/admin_dashboard.php");
        exit();  // Importante para que no se ejecute código adicional después de la redirección
    } else {
        echo "<p>Error al eliminar el usuario: " . mysqli_error($con) . "</p>";
    }
} else {
    echo "<p>ID de usuario no especificado.</p>";
}
?>
