<?php


// Verifica si se ha proporcionado un ID de noticia válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_noticia = intval($_GET['id']);
    
    // Consulta para obtener los detalles de la noticia seleccionada
    $sql = "SELECT * FROM noticias WHERE id = $id_noticia AND estatus = 1";
    $result = mysqli_query($con, $sql);
    
    // Verifica si se encontró la noticia
    if (mysqli_num_rows($result) > 0) {
        $noticia = mysqli_fetch_assoc($result);
    } else {
        echo "<p>Noticia no encontrada o no disponible.</p>";
        exit;
    }
} else {
    echo "<p>ID de noticia no válido.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($noticia['titulo']); ?></title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
    <section class="container">
        <h2>Noticias Recientes</h2>
        <article class="noticia">
            <img src="images/<?php echo htmlspecialchars($noticia['img']); ?>" alt="<?php echo htmlspecialchars($noticia['alt'] ?? 'Imagen de la noticia'); ?>" />
            <div class="noticia-content">
                <h3><?php echo htmlspecialchars($noticia['titulo']); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($noticia['descripcion'])); ?></p>
                <p class="noticia-fecha"><strong>Fecha de publicación:</strong> <?php echo htmlspecialchars($noticia['fecha_publicacion']); ?></p>
                <a href="index.php" class="boton-volver">Volver a Noticias</a>
            </div>
        </article>
    </section>
</html>
