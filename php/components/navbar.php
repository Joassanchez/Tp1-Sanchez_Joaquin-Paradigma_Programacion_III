<?php?>
<header>
    <div class="header-content">
        <div class="menu-icon" id="menu-icon">&#9776;</div>
        <h1>Fútbol Argentino</h1>
    </div>
    <nav class="Nav">
        <ul class="barra_navegacion" id="barra_navegacion">
            <li>
                <a href="index.php?modulo=noticias">Inicio</a>
            </li>
            <li>
                <a href="index.php?modulo=equipos">Equipos</a>
            </li>
            <li>
                <a href="index.php?modulo=resultados">Resultados</a>
            </li>
            <li>
                <a href="index.php?modulo=historia">Historia</a>
            </li>

            <!-- Verificar si el usuario está logueado -->
            <?php if (!empty($_SESSION['nombre_usuario'])): ?>
                <li>
                    <a href="./php/components/logout.php">Cerrar sesión</a>
                </li>
            <?php else: ?>
                <!-- Si no está logueado, mostrar el enlace para iniciar sesión -->
                <li>
                    <a href="index.php?modulo=login">Iniciar sesión</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
