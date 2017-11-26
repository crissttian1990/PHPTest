<?php
// Desloguea al usuario de la página destruyendo la sesión
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['usuario_nombre'])) {
    session_destroy();
    header("Location: ../index.php");
} else {
    echo "Operación incorrecta.";
}
?> 