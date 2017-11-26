<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Usuario registrado">
<meta name="author" content="Cristian Fernández">
<!-- Código  para mostrar el favicon -->
		<LINK REL="SHORTCUT ICON" HREF="favicon.ico" />
<title>MePregunto - Registro completo</title>
<?php
session_start();
include_once 'inc/cabecera.php';
require_once 'clases/claseusuarios.php';
$listado = new usuarios;
$flag    = 5;
if (isset($_POST["flag"])) {
    $input = $_POST["input"];
    $flag  = $_POST["flag"];
}

// Comprueba si el registro se realizó correctamente
if (!empty($_POST['nickname']) && $input == $_SESSION['captcha_string'] && $flag == 1) {
    $resultado = $listado->addUsuario($_POST['nickname'], md5($_POST['pass']), $_POST['email'], $_POST['fechanac'], $_POST['pais'], 1, "img/avatar/avatar.jpg");
} else {
    $resultado = 0;
}
?>
<div class="row">
		<div class="col-lg-12">
			<ol class="breadcrumb">
				<li><a href="index.php">Inicio</a></li>
				 <li class="active">Registro</li>
			</ol>
		</div>
</div>
<div class="row">
	<div class="col-lg-8">
		<div class="row">
			<div class="col-lg-12 col-md-12">

						<?php
if ($resultado == 1) {
    echo "<div class='alert alert-success'><h1>Registro correcto</h1> <p>El registro se realizó correctamente. <a href='index.php'><b>Volver al inicio</b></a> </p></div>";
} else {
    echo "<div class='alert alert-danger'><h1>ERROR</h1> <p>El registro no se pudo realizar. <a href='registro.php'><b>Volver a intentarlo</b></a> </p></div>";
}
?>
					
					
					
					

			</div>
		</div>
</div>			
<?php
include 'inc/sidebar.php';
include 'inc/pie.php';
?>
