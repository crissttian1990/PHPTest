 <?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once('../clases/claseusuarios.php');
if (isset($_POST['usuario'])) { // comprobamos que se hayan enviado los datos del formulario
    // comprobamos que los campos usuarios_nombre y usuario_clave no estén vacíos
    if (empty($_POST['clave'])) {
        echo "La contraseña no ha sido ingresada. <a href='javascript:history.back();'>Reintentar</a>";
    } else {
        // "limpiamos" los campos del formulario de posibles códigos maliciosos
        $usuario_nombre = mysql_real_escape_string($_POST['usuario']);
        $usuario_clave  = mysql_real_escape_string($_POST['clave']);
        $usuario_clave  = md5($usuario_clave);
        // comprobamos que los datos ingresados en el formulario coincidan con los de la BD
        $login          = new usuarios;
        $row            = $login->getLogin($usuario_nombre, $usuario_clave);
        if ($row->nick != "") {
            $_SESSION['usuario_id']      = $row->iduser; // creamos la sesion "usuario_id" y le asignamos como valor el campo usuario_id
            $_SESSION['usuario_nombre']  = $row->nick; // creamos la sesion "usuario_nombre" y le asignamos como valor el campo usuario_nombre
            $_SESSION['usuario_permiso'] = $row->idpermission;
            echo 1;
        } else {
            echo 0;
        }
    }
} else {
    echo 0;
}
?> 