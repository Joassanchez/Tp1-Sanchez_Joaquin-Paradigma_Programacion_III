<?php
include '../utils/conexion.php';
conectar();
session_start();

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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../styles/styles.css">
   
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Panel de Administración</h2>
            <a href="admin_dashboard.php?modulo=usuarios">Usuarios</a>
            <a href="admin_dashboard.php?modulo=noticias">Noticias</a>
            <a href="admin_dashboard.php?modulo=equipos">Equipos</a>
            <a href="../components/logout.php">Cerrar sesión</a>
        </div>

        <!-- Contenido dinámico -->
        <section class="content">
            <?php
            if (isset($_GET['modulo'])) {
                $modulo = $_GET['modulo'];
                $modulo_path = "../admin/$modulo.php";

                // Verificar si el archivo del módulo existe
                if (file_exists($modulo_path)) {
                    include $modulo_path;
                } else {
                    echo "<p>Módulo no encontrado.</p>";
                }
            } else {
                echo "<p>Bienvenido al panel de administración. Selecciona una opción desde el menú.</p>";
            }
            ?>
        </section>
    </div>
</body>
</html>
