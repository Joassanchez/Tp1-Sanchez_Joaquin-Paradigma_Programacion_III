<?php
if (!isset($_GET['accion'])) {
    $accion = 'listar'; // Acción predeterminada
} else {
    $accion = $_GET['accion'];
}

switch ($accion) {
    case 'crear':
        include 'equipos/crear_equipo.php';
        break;

    case 'editar':
        include 'equipos/editar_equipo.php';
        break;

    case 'listar':
    default:
        include 'equipos/listar_equipos.php';
        break;
}
?>
