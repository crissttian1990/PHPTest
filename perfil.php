<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="MePregunto - Perfil de usuario">
		<meta name="author" content="Cristian Fernández">
		<!-- Código  para mostrar el favicon -->
		<LINK REL="SHORTCUT ICON" HREF="favicon.ico" />
		<title>MePregunto - Perfil de usuario</title>
		<?php
//Incluimos la cabecera de la página que contiene elementos dinámicos
include_once 'inc/cabecera.php';
session_start();
require_once('clases/claseusuarios.php');
require_once('clases/clasepreguntas.php');

$row     = new usuarios();
$row     = $row->getUsuarioById($_GET['id']);
$listado = new preguntas;
//primero obtenemos el parametro que nos dice en que pagina estamos

if (array_key_exists('pg', $_GET)) {
    $page = $_GET['pg']; //si el valor pg existe en nuestra url, significa que estamos en una pagina en especifico.
} else {
    $page = 0; //inicializamos la variable $page a 0 por default
}
//ahora que tenemos en que pagina estamos obtengamos los resultados:
// a) el numero de registros en la tabla
$total = $listado->getPreguntasTotalUser($_GET["id"]);

//ahora dividimos el conteo por el numero de registros que queremos por pagina.
$max_num_paginas = intval($total / 30) + 1; //en esto caso 10
?>

<div class="row">
		<div class="col-lg-12">
			<ol class="breadcrumb">
				<li><a href="index.php">Inicio</a></li>
				 <li class="active">Perfil</li>
			</ol>
		</div>
		</div>

		<div class="row">
			<div class="col-lg-8">
			<?php
if ($row) { // Comprobamos que exista el registro con la ID ingresada
    $id       = $row->iduser;
    $nick     = $row->nick;
    $email    = $row->mail;
    $pais     = $row->country;
    $fechanac = date('d/m/Y', strtotime($row->birthday));
    $avatar   = $row->avatar;
?>
			
				<div class="row">
        <div class="col-lg-2" >
		    <img src="<?= $avatar ?>" width=180 height=180 class="img-circle">
        </div>
        
        <div class="col-lg-9 col-lg-offset-1">
            <h1><?= $nick ?></h3>
            <h3>Email: <?= $email ?></h3>
            <h3>País: <?= $pais ?></h3>
            <h3>Fecha Nacimiento: <?= $fechanac ?></h3>
        </div>
</div>
<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
 				 <h1>Preguntas <small>realizadas por <?= $nick ?></small></h1>
				</div>
			</div>
			</div>
<div class="row">
<div class="col-lg-12">

    <table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>Pregunta</th>
      <th>Categoria</th>
      <th>Visitas</th>
	  <th>Fecha</th>
    </tr>
  </thead>
  <tbody>
    <tr>
	<?php
    foreach ($listado->getPreguntasByDateUser((($page) * 10) . ", 30", $_GET["id"]) as $valor) {
        echo "<tr><td><a href='pregunta.php?id=" . $valor->idquestion . "'>" . substr($valor->question, 0, 100) . "...</a></td><td>" . $valor->category . "</td>				<td>" . $valor->views . "</td><td>" . date('d/m/Y', strtotime($valor->datetime)) . "</td></tr>";
    }
?>
  </tbody>
</table> 

</div>
</div>
<div class="row">
			<div class="col-lg-12"><?php
    //ahora viene la parte importante, que es el paginado
    //recordemos que $max_num_paginas fue previamente calculado.
    if ($page == 0) {
        echo '<ul class="pagination"><li class="disabled"><a href="#">&laquo;</a></li>';
    } else {
        echo '<ul class="pagination"><li><a href="perfil.php?id=' . $_GET["id"] . '&pg=' . ($page - 1) . '">&laquo;</a></li>';
    }
    
    for ($i = 0; $i < $max_num_paginas; $i++) {
        if ($i != $page) {
            echo '<li><a href="perfil.php?id=' . $_GET["id"] . '&pg=' . ($i) . '">' . ($i + 1) . '</a></li>';
        } else {
            echo '<li class="active"><a href="perfil.php?id=' . $_GET["id"] . '&pg=' . ($i) . '">' . ($i + 1) . '</a></li>';
        }
    }
    if ($page + 1 != $max_num_paginas) {
        echo '<li><a href="perfil.php?id=' . $_GET["id"] . '&pg=' . ($page + 1) . '">&raquo;</a></li></ul>';
    } else {
        echo '<li class="disabled"><a href="#">&raquo;</a></li></ul>';
    }
    
?>
</div></div>
	<?php
} else {
?>
			<div class='alert alert-danger'><p>El perfil seleccionado no existe o ha sido eliminado.</p>
         <a href='index.php'><b>Volver a la página principal</b></a></div>
			
	<?php
}
?> 
			</div>		
<?php //Se incluye el resto de la página, es decir, la sidebar y el footer.
include 'inc/sidebar.php';
include 'inc/pie.php';
?>
