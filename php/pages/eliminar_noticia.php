<?php
include './php/utils/conexion.php'; // Asegúrate de que la ruta de conexión sea correcta
conectar();

// Verificar si el usuario es administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: ./index.php");
    exit();
}

// Verificar si se ha recibido el ID de la noticia
if (isset($_GET['id'])) {
    $id_noticia = $_GET['id'];

    // Eliminar la noticia de la base de datos
    $sql = "DELETE FROM noticias WHERE id = $id_noticia";

    if (mysqli_query($con, $sql)) {
        header("Location: ./index.php");
        exit();
    } else {
        echo "Error al eliminar la noticia: " . mysqli_error($con);
    }
} else {
    echo "ID de noticia no especificado.";
    exit();
}
?>
