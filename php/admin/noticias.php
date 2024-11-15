<?php
if (!isset($_GET['accion'])) {
    $accion = 'listar'; // Acción predeterminada
} else {
    $accion = $_GET['accion'];
}

switch ($accion) {
    case 'crear':
        include 'noticias/crear_noticia.php';
        break;

    case 'editar':
        include 'noticias/editar_noticia.php';
        break;

    case 'listar':
    default:
        include 'noticias/listar_noticias.php';
        break;
}
?>
