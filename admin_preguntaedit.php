<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Panel de administración - Preguntas">
		<meta name="author" content="Cristian Fernández">
		<!-- Código  para mostrar el favicon -->
		<LINK REL="SHORTCUT ICON" HREF="favicon.ico" />
		<title>MePregunto - Administración/Editar pregunta</title>
		<?php
//Incluimos la cabecera de la página que contiene elementos dinámicos e iniciamos sesión
include_once 'inc/cabecera.php';
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

?>

<div class="row">
		<div class="col-lg-12">
			<ol class="breadcrumb">
				<li><a href="index.php">Inicio</a></li>
				<li><a href="admin.php">Panel de Administración</a></li>
				 <li class="active">Editar Pregunta</li>
			</ol>
		</div>
		</div>

		<div class="row">
			<div class="col-lg-8 col-md-8">
			<div id="alertaweb"></div>
			<?php
// Se comprueba si el usuario está logueado y tiene permiso para acceder
if ((isset($_SESSION['usuario_nombre']) == true) && $_SESSION['usuario_permiso'] == 2 && (isset($_GET['id']) == true)) {
    // Se rescata de la base de datos la pregunta a editar
    require_once 'clases/clasepreguntas.php';
    $listado = new preguntas;
    $listado = $listado->getPreguntasById($_GET['id']);
?>
			<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
 				 <h1>Panel de Administración <small>Editar Pregunta</small></h1>
				</div>
			</div>
			</div>
			<div class="row">
			<div class="col-lg-12">
			<form id="formeditpregunta" class="form-horizontal" action="admin_pregunta.php" method="GET"> 
				<div class="form-group">
				<!-- Titulo Pregunta--><label for="Question">Pregunta: </label><input id="question" name="question" type="text" class="form-control" value="<?php
    echo $listado->question;
?>"> 
				</div>
				<div class="form-group">
				<!-- Pregunta--><label for="questiontext">Texto: </label><textarea rows="10" id="questiontext" name="questiontext" type="text" class="form-control"> <?php
    echo $listado->questiontext;
?></textarea>
				</div>
				<div class="form-group">
				<input type="hidden" id="id" name="id" value="<?php
    echo $listado->idquestion;
?>">
				<input type="hidden" id="accion" name="accion" value="1">
				 <button type="submit" class="btn btn-primary btn-md"><i class='glyphicon glyphicon-pencil'></i> Editar Pregunta</button>  </form>
			</div></div>
			</div>
			
			
			<?php
} else {
    // Si no se tienen los permisos para acceder se muestra el siguiente mensaje
    echo "<div class='alert alert-danger'>ACCESO DENEGADO<br><a href='index.php' class='alert-link'>Volver al inicio</a></div>";
}
?>
			</div>		
<?php //Se incluye el resto de la página, es decir, la sidebar y el footer.
include 'inc/sidebar.php';
include 'inc/pie.php';
?>
