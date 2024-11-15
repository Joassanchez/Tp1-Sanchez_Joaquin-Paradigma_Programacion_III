<?php
include '../utils/conexion.php';
conectar();

// Consulta para obtener todos los usuarios
$query = "SELECT * FROM usuarios";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    // Iniciar la estructura de la tabla
    echo '<section class="container">';
    echo '<h2>Usuarios Registrados</h2>';
    echo '<article>';
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Username</th>';
    echo '<th>Email</th>';
    echo '<th>Rol</th>';
    echo '<th>Acciones</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    
    // Recorrer los resultados y mostrar las filas en la tabla
    while ($usuario = mysqli_fetch_assoc($result)) {
        echo "<tr class='usuario'>";
        echo "<td>" . $usuario['username'] . "</td>"; // Nombre de usuario
        echo "<td>" . $usuario['email'] . "</td>"; // Correo electrónico
        echo "<td>" . ($usuario['id_rol'] == 1 ? 'Administrador' : 'Usuario') . "</td>"; // Rol del usuario
        echo "<td>";
        echo "<a href='admin_dashboard.php?modulo=editar_usuario&id=" . $usuario['id'] . "' class='boton-editar'>Editar</a> | ";
        echo "<a href='admin_dashboard.php?modulo=procesar_eliminar_usuario&id=" . $usuario['id'] . "' class='boton-eliminar' onclick='return confirm(\"¿Estás seguro de eliminar este usuario?\")'>Eliminar</a>";
        echo "</td>";
        echo "</tr>";
    }

    // Cerrar la tabla y la estructura del HTML
    echo '</tbody>';
    echo '</table>';
    echo '</article>';
    echo '</section>';
} else {
    // Si no hay usuarios registrados
    echo "<p>No hay usuarios registrados.</p>";
}
?>
