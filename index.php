<?php
include './php/utils/conexion.php';
conectar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fútbol Argentino</title>
    
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- Archivos de estilos y scripts de la página -->
    <link rel="stylesheet" href="./styles/styles.css">
    <script type="module" src="./js/main.js"></script>
</head>
<body>
    <main>
        <!-- Componente de navegación -->
        <?php include "./php/components/navbar.php"; ?>

        <!-- Contenedor Centrado de Contenidos -->
        <section class="contenedor-centrado">
            <!-- Cargamos los contenidos -->
            <?php
            if (!empty($_GET['modulo'])) {
                $modulo = $_GET['modulo'];

                // Separamos el valor del 'modulo' antes del '?' (si existe)
                $modulo_base = strtok($modulo, '&');

                // Capturamos la parte después del '?' para obtener los parámetros adicionales
                $params = strstr($modulo, '&');

                // Verificamos que el módulo sea un archivo válido
                if (file_exists("./php/pages/$modulo_base.php")) {
                    include "./php/pages/$modulo_base.php";
                } else {
                    echo "<p>Página no encontrada.</p>";
                }

                // Redirigir al mismo módulo con los parámetros adicionales, si los hay
                if ($params) {
                    header("Location: index.php?$params");
                    exit();
                }
            } else {
                include "./php/pages/noticias.php";  // Página de inicio si no se ha especificado un módulo
            }
            ?>
        </section>
        
    </main>

    <?php include "./php/components/footer.php"; ?>
</body>
</html>
