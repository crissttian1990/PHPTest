<?php
include_once 'inc/cabecera.php';
// Incluye la cabecera y llama a las clases necesarias para mostrar la página
require_once 'clases/clasepreguntas.php';
require_once 'clases/claserespuestas.php';
require_once 'clases/claselikes.php';
$pregunta = new preguntas;
$pregunta = $pregunta->getPreguntasById($_GET['id']);
$pregunta->addVistaPregunta($pregunta->idquestion, $pregunta->views);
$respuestas  = new respuestas;
$respuestas1 = new respuestas;
$likes       = new likes;
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
// Instancia los objetos necesarios para mostrar el contenido e inicia sesión
// Comprueba si se está introduciendo una respuesta nueva
if (isset($_POST['message'])) {
    $respuestas1->addRespuesta($_POST['message'], $_SESSION['usuario_id'], $_GET['id']);
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php
echo $pregunta->question;
?>">
<meta name="author" content="Cristian Fernández">
<!-- Código  para mostrar el favicon -->
		<LINK REL="SHORTCUT ICON" HREF="favicon.ico" />
<title>MePregunto - <?php
echo $pregunta->question;
?></title>
<?php
//primero obtenemos el parametro que nos dice en que pagina estamos
if (array_key_exists('pg', $_GET)) {
    $page = $_GET['pg']; //si el valor pg existe en nuestra url, significa que estamos en una pagina en especifico.
} else {
    $page = 0; //inicializamos la variable $page a 0 por default
}
//ahora que tenemos en que pagina estamos obtengamos los resultados:
// a) el numero de registros en la tabla
$total = $respuestas->getTotalRespuestas($_GET["id"]);

//ahora dividimos el conteo por el numero de registros que queremos por pagina.
$max_num_paginas = intval($total / 10) + 1; //en esto caso 10
// comprobamos que se haya iniciado la sesión
if (isset($_SESSION['usuario_nombre'])) {
?>
		<div class="row">
		<div class="col-lg-12">
			<ol class="breadcrumb">
				<li><a href="index.php">Inicio</a></li>
				<li><a href="categoria.php?id=<?php
    echo $pregunta->idcategory;
?>"><?php
    echo $pregunta->category;
?></a></li>
				 <li class="active"><?php
    echo $pregunta->question;
?></li>
			</ol>
		</div>
		</div>
			<div class="row">
			<div class="col-lg-8">	
			<div id="alertaweb"></div>
<div class="row"> 
<div class="col-md-12"> 
		<div class="row"> 
		<div class="col-md-12"> 
		<h3> <strong><?php
    echo $pregunta->question;
?></strong></h3> 
		</div> 
		</div> 
		<div class="row"> 
		<div class="col-md-12"> 
			<div class="well well-sm">
			<span class="glyphicon glyphicon-user"></span> by <a href="perfil.php?id=<?php
    echo $pregunta->idautor;
?>"><?php
    echo $pregunta->autor;
?></a> | 
			<span class="glyphicon glyphicon-calendar"> </span> <?php
    echo date_format(date_create($pregunta->datetime), "d/m/Y H:i:s");
?> | 
			<span class="glyphicon glyphicon-eye-open"></span> <?php
    echo $pregunta->views;
?> Visitas | 
			<span class="glyphicon glyphicon-comment"></span> <?php
    echo $total;
?> Respuestas | 
			<span class="glyphicon glyphicon-tags"></span> Categor&iacute;a: <a href="categoria.php?id=<?php
    echo $pregunta->idcategory;
?>"><span class="label label-info">  <?php
    echo $pregunta->category;
?></span></a> 
			</div>
		</div> 
		</div> 
		<div class="row"> 
		<div class="col-md-12"> 
			<p> <?php
    echo $pregunta->questiontext;
?> </p>  
		</div> 
		</div> 
		
		<div class="row"> 
		<div class="col-md-12"> 
			<p class="pull-right"> <h3>Compártelo con tus amigos: </h3><a href="javascript:var dir=window.document.URL;var tit=window.document.title;var tit2=encodeURIComponent(tit);var dir2= encodeURIComponent(dir);javascript:window.open('http://www.facebook.com/share.php?u='+dir2+'&amp;t='+tit2+'','popup','width=500,height=350');" target="_blank"><img src="img/social/fb.png"></a>&nbsp;<a href="javascript:var dir=window.document.URL;var tit=window.document.title;var tit2=encodeURIComponent(tit);window.open('http://twitter.com/?status='+tit2+'%20'+dir+'','popup','width=500,height=250');" target="_blank"><img src="img/social/tw.png"></a></p>  
			<br>
		</div> 
		</div> 
		
		
		
		<div class="row">
		<div class="col-md-12"> <div class="panel panel-primary"> <div class="panel-heading"> <h3 class="panel-title"> Responder</h3> <span class="pull-right clickable"><i class="glyphicon glyphicon-minus"></i></span> </div>  <div class="panel-body"> <form accept-charset="UTF-8" action="pregunta.php?id=<?php
    echo $_GET["id"];
?>" id="formrespuesta" method="POST"> <textarea class="form-control counted" id="message" name="message" placeholder="Escribe tu respuesta" rows="5" style="margin-bottom:10px;"></textarea> <h6 class="pull-right" id="counter">1500 carácteres restantes</h6> <button class="btn btn-info" type="submit"><i class="glyphicon glyphicon-comment"></i> Responder</button> </form> </div> </div> </div> </div>
		
		
		
		<div class="row">
		<div class="col-lg-12">
		<h3>Respuestas</h3>
		<hr>
		</div>
		</div>
		
		<?php
		$orden=$page * 10 . ",10";
		if($page==0){
			$orden=10;
		}
    
    $respuestas = $respuestas->getRespuestasByLikes($orden, $_GET['id']);
    // Lista las respuestas de la pregunta listada anteriormente
    foreach ($respuestas as $valor) {
        echo "<div class='row'>
		<div class='col-lg-12'>
			<div class='panel panel-default'>
			  <div class='panel-body'>
				" . $valor->answer . "
			  </div>
			  <div class='panel-footer'>
					  <span class='glyphicon glyphicon-user'></span> by <a href='perfil.php?id=" . $valor->idautor . "'> " . $valor->autor . "</a> | 
					<span class='glyphicon glyphicon-calendar'> </span> ";
        echo date_format(date_create($valor->datetime), "d/m/Y H:i:s") . " | 
					<span class='glyphicon glyphicon-comment'></span> " . $valor->likes . " Likes | ";
        // Comprueba si el usuario ya votó por la respuesta
        if ($likes->getLikesCoincidencia($valor->idanswer, $_SESSION['usuario_id']) == 0) {
            echo "<button id='btnLike" . $valor->idanswer . "' type='button' alt='" . $valor->idanswer . "' class='btn btn-success btnLike'><i class='glyphicon glyphicon-ok'></i> Me gusta</button> 
			  </div>
			</div>
			</div>
		</div>";
        } else {
            echo "<button id='btnLike" . $valor->idanswer . "' type='button' alt='" . $valor->idanswer . "' class='btn btn-success btnLike disabled'><i class='glyphicon glyphicon-ok'></i> Me gusta</button> 
			  </div>
			</div>
			</div>
		</div>";
        }
        
    }
    
?>
		
		
</div> 
</div> 
	<div class="row">
			<div class="col-lg-12"><?php
    //ahora viene la parte importante, que es el paginado
    //recordemos que $max_num_paginas fue previamente calculado.
    if ($page == 0) {
        echo '<ul class="pagination"><li class="disabled"><a href="#">&laquo;</a></li>';
    } else {
        echo '<ul class="pagination"><li><a href="pregunta.php?id=' . $_GET["id"] . '&pg=' . ($page - 1) . '">&laquo;</a></li>';
    }
    
    for ($i = 0; $i < $max_num_paginas; $i++) {
        if ($i != $page) {
            echo '<li><a href="pregunta.php?id=' . $_GET["id"] . '&pg=' . ($i) . '">' . ($i + 1) . '</a></li>';
        } else {
            echo '<li class="active"><a href="pregunta.php?id=' . $_GET["id"] . '&pg=' . ($i) . '">' . ($i + 1) . '</a></li>';
        }
    }
    if ($page + 1 != $max_num_paginas) {
        echo '<li><a href="pregunta.php?id=' . $_GET["id"] . '&pg=' . ($page + 1) . '">&raquo;</a></li></ul>';
    } else {
        echo '<li class="disabled"><a href="#">&raquo;</a></li></ul>';
    }
    
?>
</div></div>	</div>		
			
			
			
			
			

<?php
} else {
    //Si no tiene permisos, devuelve el mensaje de error
    echo "<div class='row'><div class='col-lg-8'><div class='alert alert-info'><p>Estás accediendo a una página restringida, para ver su contenido debes estar registrado.</p><a href='registro.php'><b>Registrarme</b></a> o <a href='index.php'><b>Identifícate</b></a></div></div>";
}
include 'inc/sidebar.php';
include 'inc/pie.php';
?> 