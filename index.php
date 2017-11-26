<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="MePregunto - Un sitio para resolver dudas">
		<meta name="author" content="Cristian Fernández">
		<!-- Código  para mostrar el favicon -->
		<LINK REL="SHORTCUT ICON" HREF="favicon.ico" />
		<title>MePregunto - Tu sitio para resolver dudas</title>
		<?php
//Incluimos la cabecera de la página que contiene elementos dinámicos
include_once 'inc/cabecera.php';
//Llamamos a la clase preguntas que nos mostrará todo el listado de preguntas del index y declaramos un objeto preguntas para acceder a ella.
require_once 'clases/clasepreguntas.php';
$listado = new preguntas;
?>
		<div class="row">
			<div class="col-lg-12">
					<div class="alert alert-dismissable alert-info">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<h4>¡Bienvenido!</h4>
					<p>Esto es MePregunto, un sitio para que entre todos podamos resolver nuestras dudas, si quieres saber como puedes empezar a hacer y responder preguntas <a href="como-funciona.php" class="alert-link">haz click aqu&iacute;</a>.</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8">
				<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					<li class="active"><a href="#ultimas" data-toggle="tab">&Uacute;ltimas preguntas</a></li>
					<li class=""><a href="#ultimasrespuestas" data-toggle="tab">&Uacute;ltimas respuestas</a></li>
					<li class=""><a href="#vistas" data-toggle="tab">Preguntas m&aacute;s vistas</a></li>
					<li class=""><a href="#respondidas" data-toggle="tab">Preguntas m&aacute;s respondidas</a></li>
				</ul>
				<div id="myTabContent" class="tab-content">
  					 <div class="tab-pane fade active in" id="ultimas">
    					
								<?php
foreach ($listado->getPreguntasByDate(30, 0) as $valor) {
    echo "<div class='row'><div class='col-lg-12'><div class='alert-message alert-message-info'><div class='row'><div class='col-lg-9'><a href='categoria.php?id=" . $valor->idcategory . "'><button type='button' class='btn btn-primary btn-xs'>" . $valor->category . "</button><b> <a href='pregunta.php?id=" . $valor->idquestion . "'>" . substr($valor->question, 0, 100) . "</b></a></div><div class='col-lg-3'><p><h5 class='pull-right'><small>" . $valor->views . " visitas | " . date('d/m/Y', strtotime($valor->datetime)) . " </small></h5></p></div></div></div></div></div>";
}
?>
							
					</div>
					<div class="tab-pane fade" id="ultimasrespuestas">
								<?php
foreach ($listado->getPreguntasByUltimasRespuestas(30, 0) as $valor) {
    echo "<div class='row'><div class='col-lg-12'><div class='alert-message alert-message-info'><div class='row'><div class='col-lg-9'><a href='categoria.php?id=" . $valor->idcategory . "'><button type='button' class='btn btn-primary btn-xs'>" . $valor->category . "</button><b> <a href='pregunta.php?id=" . $valor->idquestion . "'>" . substr($valor->question, 0, 100) . "</b></a></div><div class='col-lg-3'><p><h5 class='pull-right'><small>" . $valor->views . " visitas | " . date('d/m/Y', strtotime($valor->datetime)) . " </small></h5></p></div></div></div></div></div>";
}
?>
  					</div>
  					<div class="tab-pane fade" id="vistas">
								<?php
foreach ($listado->getPreguntasByViews(30, 0) as $valor) {
    echo "<div class='row'><div class='col-lg-12'><div class='alert-message alert-message-info'><div class='row'><div class='col-lg-9'><a href='categoria.php?id=" . $valor->idcategory . "'><button type='button' class='btn btn-primary btn-xs'>" . $valor->category . "</button><b> <a href='pregunta.php?id=" . $valor->idquestion . "'>" . substr($valor->question, 0, 100) . "</b></a></div><div class='col-lg-3'><p><h5 class='pull-right'><small>" . $valor->views . " visitas | " . date('d/m/Y', strtotime($valor->datetime)) . " </small></h5></p></div></div></div></div></div>";
}
?>
  					</div>
  					<div class="tab-pane fade" id="respondidas">
					
								<?php
foreach ($listado->getPreguntasbyMasRespondidas(30, 0) as $valor) {
    echo "<div class='row'><div class='col-lg-12'><div class='alert-message alert-message-info'><div class='row'><div class='col-lg-9'><a href='categoria.php?id=" . $valor->idcategory . "'><button type='button' class='btn btn-primary btn-xs'>" . $valor->category . "</button><b> <a href='pregunta.php?id=" . $valor->idquestion . "'>" . substr($valor->question, 0, 100) . "</b></a></div><div class='col-lg-3'><p><h5 class='pull-right'><small>" . $valor->views . " visitas | " . date('d/m/Y', strtotime($valor->datetime)) . " </small></h5></p></div></div></div></div></div>";
}
?>
							
  					</div>
				</div>		
			</div>		
<?php //Se incluye el resto de la página, es decir, la sidebar y el footer.
include 'inc/sidebar.php';
include 'inc/pie.php';
?>
