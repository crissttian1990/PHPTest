<?php
include_once 'inc/cabecera.php';
require_once 'clases/clasepreguntas.php';
require_once 'clases/clasecategorias.php';
$listado         = new preguntas;
$nombrecategoria = new categorias;
$nombrecategoria = $nombrecategoria->getCategoria($_GET["id"]);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Listado de todas las preguntas dentro de la categoría <?php
echo ($nombrecategoria->name);
?>">
<meta name="author" content="Cristian Fernández">
<!-- Código  para mostrar el favicon -->
		<LINK REL="SHORTCUT ICON" HREF="favicon.ico" />
<title>MePregunto - Categorias: <?php
echo ($nombrecategoria->name);
?></title>
<?php
//primero obtenemos el parametro que nos dice en que pagina estamos

if (array_key_exists('orden', $_GET)) {
    $orden = $_GET['orden']; //si el valor $orden existe en nuestra url, significa que estamos en una pagina en especifico.
} else {
    $orden = 0; //inicializamos la variable $orden a 0 por default
}

if (array_key_exists('pg', $_GET)) {
    $page = $_GET['pg']; //si el valor pg existe en nuestra url, significa que estamos en una pagina en especifico.
} else {
    $page = 0; //inicializamos la variable $page a 0 por default
}
//ahora que tenemos en que pagina estamos obtengamos los resultados:
// a) el numero de registros en la tabla
$total = $listado->getPreguntasTotal($_GET["id"]);

//ahora dividimos el conteo por el numero de registros que queremos por pagina.
$max_num_paginas = intval($total / 30) + 1; //en esto caso 10
?>
		<div class="row">
		<div class="col-lg-12">
			<ol class="breadcrumb">
				<li><a href="index.php">Inicio</a></li>
				 <li class="active"><?php
echo ($nombrecategoria->name);
?></li>
			</ol>
		</div>
		</div>
		<div class="row">
		<div class="col-lg-8 col-md-8">
		<div class="row">
<div class="col-lg-12 col-md-12">
 <div class="alert-message alert-message-info">
 		<div class="row">
			<div class="col-lg-9">
			<h1><?php
echo ($nombrecategoria->name);
?></h1>
			</div>
				<div class="col-lg-3">
						<div class="btn-group pull-right">
					  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						<i class="glyphicon glyphicon-th"></i> Ordenar por: <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu" role="menu">
						<li><a href="categoria.php?id=<?php
echo ($_GET["id"]);
?>&pg=<?php
echo ($page);
?>&orden=0">&Uacute;ltimas preguntas</a></li>
						<li><a href="categoria.php?id=<?php
echo ($_GET["id"]);
?>&pg=<?php
echo ($page);
?>&orden=1">&Uacute;ltimas respuestas</a></li>
						<li><a href="categoria.php?id=<?php
echo ($_GET["id"]);
?>&pg=<?php
echo ($page);
?>&orden=2">Preguntas m&aacute;s vistas</a></li>
						<li><a href="categoria.php?id=<?php
echo ($_GET["id"]);
?>&pg=<?php
echo ($page);
?>&orden=3">Preguntas m&aacute;s respondidas</a></li>
					  </ul>
					</div>
				</div>
		</div>
                
                <p><?php
echo ($nombrecategoria->description);
?></p>
						
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
switch ($orden) {
    case 0:
        foreach ($listado->getPreguntasByDate((($page) * 10) . ", 30", $_GET["id"]) as $valor) {
            echo "<tr><td><a href='pregunta.php?id=" . $valor->idquestion . "'>" . substr($valor->question, 0, 100) . "...</a></td><td>" . $valor->category . "</td>				<td>" . $valor->views . "</td><td>" . date('d/m/Y', strtotime($valor->datetime)) . "</td></tr>";
        }
        break;
    case 1:
        foreach ($listado->getPreguntasbyUltimasRespuestas((($page) * 10) . ", 30", $_GET["id"]) as $valor) {
            echo "<tr><td><a href='pregunta.php?id=" . $valor->idquestion . "'>" . substr($valor->question, 0, 100) . "...</a></td><td>" . $valor->category . "</td><td>" . $valor->views . "</td><td>" . date('d/m/Y', strtotime($valor->datetime)) . "</td></tr>";
        }
        break;
    case 2:
        foreach ($listado->getPreguntasByViews((($page) * 10) . ", 30", $_GET["id"]) as $valor) {
            echo "<tr><td><a href='pregunta.php?id=" . $valor->idquestion . "'>" . substr($valor->question, 0, 100) . "...</a></td><td>" . $valor->category . "</td><td>" . $valor->views . "</td><td>" . date('d/m/Y', strtotime($valor->datetime)) . "</td></tr>";
        }
        break;
    case 3:
        foreach ($listado->getPreguntasbyMasRespondidas((($page) * 10) . ", 30", $_GET["id"]) as $valor) {
            echo "<tr><td><a href='pregunta.php?id=" . $valor->idquestion . "'>" . substr($valor->question, 0, 100) . "...</a></td><td>" . $valor->category . "</td><td>" . $valor->views . "</td><td>" . date('d/m/Y', strtotime($valor->datetime)) . "</td></tr>";
        }
        break;
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
    echo '<ul class="pagination"><li><a href="categoria.php?id=' . $_GET["id"] . '&pg=' . ($page - 1) . '&orden=' . $orden . '">&laquo;</a></li>';
}

for ($i = 0; $i < $max_num_paginas; $i++) {
    if ($i != $page) {
        echo '<li><a href="categoria.php?id=' . $_GET["id"] . '&pg=' . ($i) . '&orden=' . $orden . '">' . ($i + 1) . '</a></li>';
    } else {
        echo '<li class="active"><a href="categoria.php?id=' . $_GET["id"] . '&pg=' . ($i) . '&orden=' . $orden . '">' . ($i + 1) . '</a></li>';
    }
}
if ($page + 1 != $max_num_paginas) {
    echo '<li><a href="categoria.php?id=' . $_GET["id"] . '&pg=' . ($page + 1) . '&orden=' . $orden . '">&raquo;</a></li></ul>';
} else {
    echo '<li class="disabled"><a href="#">&raquo;</a></li></ul>';
}

?>
</div></div>
</div>		
<?php
include 'inc/sidebar.php';
include 'inc/pie.php';
?>
