<?php
// Verifica si la función ya está definida antes de declararla
if (!function_exists('conectar')) {
    function conectar()
    {
        global $con;
        $username = "root";
        $password = "root";
        $db = "web_futbol";
        $host = "localhost";

        $con = mysqli_connect($host, $username, $password, $db);
        /* comprobar la conexión */
        if (mysqli_connect_errno()) {
            printf("Falló la conexión: %s\n", mysqli_connect_error());
            exit();
        } else {
            $con->set_charset("utf8");
            $ret = true;
        }

        return $ret;
    }
}

// Protege la desconexión también de una redefinición
if (!function_exists('desconectar')) {
    function desconectar()
    {
        global $con;
        mysqli_close($con);
    }
}
?>
