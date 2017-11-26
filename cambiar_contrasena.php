<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Cambio de contraseña">
		<meta name="author" content="Cristian Fernández">
		<!-- Código  para mostrar el favicon -->
		<LINK REL="SHORTCUT ICON" HREF="favicon.ico" />
		<title>MePregunto - Cambiar contraseña</title>
		<?php
//Incluimos la cabecera de la página que contiene elementos dinámicos e iniciamos la sesión
include_once 'inc/cabecera.php';
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once('clases/claseusuarios.php');
?>

<div class="row">
		<div class="col-lg-12">
			<ol class="breadcrumb">
				<li><a href="index.php">Inicio</a></li>
				 <li class="active">Cambiar Contraseña</li>
			</ol>
		</div>
		</div>

		<div class="row">
			<div class="col-lg-8 col-md-8">
			<div class="row">
<div class="col-lg-12 col-md-12">
 <div class="alert-message alert-message-info">
 		<div class="row">
			<div class="col-lg-12">
			<h1>Cambia tu contraseña</h1>
			</div>
		</div>
                
                <p>Desde esta página puedes cambiar tu contraseña en MePregunto</p>
						
            </div>
</div>
</div>

			 <?php
if (isset($_SESSION['usuario_nombre'])) { // comprobamos que la sesión esté iniciada
    if (isset($_POST['enviar'])) {
        if ($_POST['usuario_clave'] != $_POST['usuario_clave_conf']) {
            echo "<div class='alert alert-danger'>Las contraseñas ingresadas no coinciden. <a href='javascript:history.back();'>Reintentar</a></div>";
        } else {
            $usuario_nombre = $_SESSION['usuario_nombre'];
            $usuario_clave  = mysql_real_escape_string($_POST["usuario_clave"]);
            $usuario_clave  = md5($usuario_clave); // encriptamos la nueva contraseña con md5
            $sql            = new usuarios;
            $sql            = $sql->buscarUsuarioPorNick($usuario_nombre);
            $usuario_id     = $sql->iduser;
            $sql            = $sql->editPass($usuario_id, $usuario_clave);
            if ($sql == 1) {
                echo "<div class='alert alert-success'>Contraseña cambiada correctamente</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: No se pudo cambiar la contraseña. <a href='javascript:history.back();'>Reintentar</a></div>";
            }
        }
    } else {
?>
			<div id="alertaweb"></div>
			<div class="row">
			<div class="col-lg-4 col-lg-offset-4">
            <form id="formcambiarpass" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <label>Nueva contraseña:</label><br />
                <input type="password" id="usuario_clave" name="usuario_clave" placeholder="Escribe tu nueva contraseña" class="form-control" maxlength="15" /><br />
                <label>Confirmar:</label><br />
                <input type="password" id="usuario_clave_conf" name="usuario_clave_conf" placeholder="Repite tu nueva contraseña" class="form-control" maxlength="15" /><br />
                <button class="btn btn-primary" type="submit" name="enviar" /><i class="glyphicon glyphicon-cog"></i> Cambiar contraseña</button>
            </form>
			</div>
			</div>
    <?php
    }
} else {
    //Si no tiene permisos, devuelve el mensaje de error
    echo "<div class='alert alert-info'>No tienes permiso para acceder a esta página. <a href='registro.php' class='alert-link'>Registráte</a> o <a href='index.php' class='alert-link'>Identifícarte</a></div>";
}
?> 
			
			
			</div>		
<?php //Se incluye el resto de la página, es decir, la sidebar y el footer.
include 'inc/sidebar.php';
include 'inc/pie.php';
?>
