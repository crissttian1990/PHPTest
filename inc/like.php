<?php
// Añade un like a la tabla likes de la base de datos
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once '../clases/claselikes.php';
$listado   = new likes;
$resultado = $listado->insertarLike($_POST['idanswer'], $_SESSION['usuario_id']);
echo $resultado;
?>