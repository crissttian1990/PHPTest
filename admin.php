<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="MePregunto - Panel de Administración">
		<meta name="author" content="Cristian Fernández">
		<!-- Código  para mostrar el favicon -->
		<LINK REL="SHORTCUT ICON" HREF="favicon.ico" />
		<title>MePregunto - Panel de Administración</title>
		<?php
//Incluimos la cabecera de la página que contiene elementos dinámicos
include_once 'inc/cabecera.php';
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

?>

<div class="row">
		<div class="col-lg-12">
			<ol class="breadcrumb">
				<li><a href="index.php">Inicio</a></li>
				 <li class="active">Panel de Administración</li>
			</ol>
		</div>
</div>

<div class="row">
	<div class="col-lg-8 col-md-8">
			<?php
// Comprobamos si el usuario está logueado y tiene permisos de administrador
if ((isset($_SESSION['usuario_nombre']) == true) && $_SESSION['usuario_permiso'] == 2) {
?>
			<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
 				 <h1>Panel de Administración <small>MePregunto</small></h1>
				</div>
			</div>
			</div>
			
			<div class="row">
			<div class="col-lg-3">
				<img src="img/admin/categorias.jpg">
			</div>
			<div class="col-lg-9">
				<h1><a href="admin_cat.php">Categorías</a></h1>
			</div>
			</div>
			
			<div class="row">
			<div class="col-lg-3">
				<img src="img/admin/preguntas.jpg">
			</div>
			<div class="col-lg-9">
				<h1><a href="admin_pregunta.php">Preguntas y Respuestas</a></h1>
			</div>
			</div>
			
			<div class="row">
			<div class="col-lg-3">
				<img src="img/admin/usuarios.png">
			</div>
			<div class="col-lg-9">
				<h1><a href="admin_user.php">Usuarios</a></h1>
			</div>
			</div>
			
			
			<?php
} else {
    //Si no tiene permisos, devuelve el mensaje de error
    echo "<div class='alert alert-danger'>ACCESO DENEGADO<br><a href='index.php' class='alert-link'>Volver al inicio</a></div>";
}
?>
			</div>		
<?php //Se incluye el resto de la página, es decir, la sidebar y el footer.
include 'inc/sidebar.php';
include 'inc/pie.php';
?>
