<?php
if (!isset($_GET['accion'])) {
    $accion = 'listar'; // Acción predeterminada
} else {
    $accion = $_GET['accion'];
}

switch ($accion) {
    case 'crear':
        include 'usuarios/crear_usuario.php';
        break;

    case 'editar':
        include 'usuarios/editar_usuario.php';
        break;

    case 'listar':
    default:
        include 'usuarios/listar_usuarios.php';
        break;
}
?>
