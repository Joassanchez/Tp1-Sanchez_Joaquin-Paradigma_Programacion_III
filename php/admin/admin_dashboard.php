<?php 
include '../utils/conexion.php';
conectar();
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../index.php"); // Redirigir a la página principal si no es admin
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Archivos de estilo -->
    <link rel="stylesheet" href="../../styles/styles.css">
    <style>
        /* Estilos básicos */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f5f5f5;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
            flex-direction: row;
        }

        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
        }

        .sidebar h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #ecf0f1;
        }

        .sidebar a {
            color: #ecf0f1;
            display: block;
            margin-bottom: 15px;
            text-decoration: none;
            font-size: 18px;
            padding: 8px;
            border-radius: 5px;
            transition: background-color 0.3s, padding-left 0.3s;
        }

        .sidebar a:hover {
            background-color: #34495e;
            padding-left: 15px;
        }

        .content {
            flex: 1;
            padding: 20px;
            margin-left: 270px;
            background-color: #ecf0f1;
        }

        .module {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .message {
            margin: 20px 0;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        .error {
            background-color: #e74c3c;
            color: white;
        }

        .success {
            background-color: #2ecc71;
            color: white;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                margin-bottom: 20px;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <h2>Panel de Administración</h2>
            <a href="admin_dashboard.php?modulo=crear_usuario">Crear Usuario</a>
            <a href="admin_dashboard.php?modulo=ver_usuarios">Ver Usuarios</a>
            <a href="admin_dashboard.php?modulo=editar_noticia">Editar Noticia</a>
            <a href="admin_dashboard.php?modulo=ver_noticias">Ver Noticias</a>
            <a href="admin_dashboard.php?modulo=crear_equipo">Crear Equipo</a>
            <a href="admin_dashboard.php?modulo=ver_equipos">Ver Equipos</a>

            <a href="../logout.php">Cerrar sesión</a>
        </div>

        <section class="content">
            <!-- Mostrar mensajes de error o éxito si existen -->
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 'usuario_existe') {
                    echo "<div class='message error'>El nombre de usuario o correo electrónico ya existe. Por favor, elige otro.</div>";
                }
            }

            if (isset($_GET['success'])) {
                if ($_GET['success'] == 'usuario_creado') {
                    echo "<div class='message success'>El usuario ha sido creado exitosamente.</div>";
                }
            }

            // Cargar el módulo solicitado
            if (!empty($_GET['modulo'])) {
                $modulo = $_GET['modulo'];

                // Separamos el valor del 'modulo' antes del '?' (si existe)
                $modulo_base = strtok($modulo, '&');
                $params = strstr($modulo, '&'); // Capturamos los parámetros adicionales

                // Verificamos si el módulo es un archivo existente
                if (file_exists("../admin/$modulo_base.php")) {
                    include "../admin/$modulo_base.php";
                } else {
                    echo "<p>Módulo no encontrado.</p>";
                }

                // Redirigir al mismo módulo con parámetros adicionales, si los hay
                if ($params) {
                    header("Location: admin_dashboard.php?$params");
                    exit();
                }
            } else {
                echo "<p>Bienvenido al panel de administración. Selecciona una opción desde el menú.</p>";
            }
            ?>
        </section>
    </div>
</body>
</html>
