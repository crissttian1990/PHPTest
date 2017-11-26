<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Resultados de búsqueda para: <?php
echo ($_GET["texto"]);
?>">
<meta name="author" content="Cristian Fernández">
<!-- Código  para mostrar el favicon -->
<LINK REL="SHORTCUT ICON" HREF="favicon.ico" />
<title>MePregunto - Resultados para: <?php
echo ($_GET["texto"]);
?></title>
<?php
include_once 'inc/cabecera.php';
require_once 'clases/clasepreguntas.php';
$listado = new preguntas;

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
$total = $listado->getPreguntasTotalByTexto($_GET["texto"]);

//ahora dividimos el conteo por el numero de registros que queremos por pagina.
$max_num_paginas = intval($total / 10) + 1; //en esto caso 10
?>
		<div class="row">
		<div class="col-lg-12">
			<ol class="breadcrumb">
				<li><a href="index.php">Inicio</a></li>
				 <li class="active">Buscar</li>
			</ol>
		</div>
		</div>
		<div class="row">
		<div class="col-lg-8 col-md-8">
		<div class="row">
<div class="col-lg-12 col-md-12">
<div class="page-header">
  <h3 class="text-info"><small><i class="glyphicon glyphicon-search"></i> Ver resultados para: </small><?php
echo ($_GET["texto"]);
?></h3>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12 col-md-12">
<div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            Ordenar por: <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="buscar.php?texto=<?php
echo ($_GET["texto"]);
?>&orden=0">&Uacute;ltimas preguntas</a></li>
            <li><a href="buscar.php?texto=<?php
echo ($_GET["texto"]);
?>&orden=1">Preguntas m&aacute;s vistas</a></li>
          </ul>
        </div>
			</div></div>


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
// Listamos las preguntas según el orden seleccionado
switch ($orden) {
    case 0:
        foreach ($listado->getPreguntasByTexto((($page) * 10) . ", 10", $_GET["texto"], "datetime Desc") as $valor) {
            echo "<tr><td><a href='pregunta.php?id=" . $valor->idquestion . "'>" . substr($valor->question, 0, 100) . "...</a></td><td>" . $valor->category . "</td>				<td>" . $valor->views . "</td><td>" . date('d/m/Y', strtotime($valor->datetime)) . "</td></tr>";
        }
        break;
    case 1:
        foreach ($listado->getPreguntasByTexto((($page) * 10) . ", 10", $_GET["texto"], "views Desc") as $valor) {
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
    echo '<ul class="pagination"><li><a href="buscar.php?texto=' . $_GET["texto"] . '&pg=' . ($page - 1) . '&orden=' . $orden . '">&laquo;</a></li>';
}

for ($i = 0; $i < $max_num_paginas; $i++) {
    if ($i != $page) {
        echo '<li><a href="buscar.php?texto=' . $_GET["texto"] . '&pg=' . ($i) . '&orden=' . $orden . '">' . ($i + 1) . '</a></li>';
    } else {
        echo '<li class="active"><a href="buscar.php?texto=' . $_GET["texto"] . '&pg=' . ($i) . '&orden=' . $orden . '">' . ($i + 1) . '</a></li>';
    }
}
if ($page + 1 != $max_num_paginas) {
    echo '<li><a href="buscar.php?texto=' . $_GET["texto"] . '&pg=' . ($page + 1) . '&orden=' . $orden . '">&raquo;</a></li></ul>';
} else {
    echo '<li class="disabled"><a href="#">&raquo;</a></li></ul>';
}

?>
</div></div></div>	
<?php
include 'inc/sidebar.php';
include 'inc/pie.php';
?>
