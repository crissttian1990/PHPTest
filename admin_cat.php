<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Panel de administración - Categorias">
		<meta name="author" content="Cristian Fernández">
		<!-- Código  para mostrar el favicon -->
		<LINK REL="SHORTCUT ICON" HREF="favicon.ico" />
		<title>MePregunto - Administración/Categorías</title>
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
				<li><a href="admin.php">Panel de Administración</a></li>
				 <li class="active">Categorías</li>
			</ol>
		</div>
		</div>

		<div class="row">
			<div class="col-lg-8 col-md-8">
			<?php
// Se comprueba si el usuario está logueado y posee permisos de administrador
if ((isset($_SESSION['usuario_nombre']) == true) && $_SESSION['usuario_permiso'] == 2) {
    require_once 'clases/clasecategorias.php';
    $listado = new categorias;
    if (isset($_GET['accion'])) {
        switch ($_GET['accion']) {
            case 1:
                $listado->addCategoria($_GET['catname'], $_GET['catdesc']);
                echo "<div class='row'><div class='col-lg-12'><div class='alert alert-success'>Se añadió la categoría " . $_GET['catname'] . "</div></div></div>";
                break;
            case 2:
                $listado->removeCategoria($_GET['catid']);
                echo "<div class='row'><div class='col-lg-12'><div class='alert alert-success'>Se eliminó la categoria seleccionada</div></div></div>";
                break;
            case 3:
                $listado->editCategoria($_GET['catid'], $_GET['catname'], $_GET['catdesc']);
                echo "<div class='row'><div class='col-lg-12'><div class='alert alert-success'>Se editó la categoría " . $_GET['catname'] . "</div></div></div>";
                break;
        }
    }
?>
			<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
 				 <h1>Panel de Administración <small>Categorias</small></h1>
				</div>
			</div>
			</div>
			<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
				  <table class="table">
					<tr><th>Nombre Categoría</th><th>Editar</th><th>Borrar</th></tr>
					<?php // Listamos las categorias en la tabla
    foreach ($listado->getCategoriasSn() as $valor) {
        echo "<tr><td><a href='categoria.php?id=" . $valor->idcategory . "'>" . $valor->name . "</a></td><td><a href='admin_catedit.php?catid=" . $valor->idcategory . "'><i class='glyphicon glyphicon-pencil'></i> Editar</a></td><td><a href='admin_cat.php?accion=2&catid=" . $valor->idcategory . "'><i class='glyphicon glyphicon-remove'></i> Borrar</a></td><tr>";
    }
?>
				  </table>
				</div>
			</div>
			</div>
			<div class="row">
			<div class="col-lg-6 col-lg-offset-3">
			<h3>Añadir una nueva categoría</h3>
			<hr>
			<!-- Formulario nueva categoria-->
			<form id="formaddcat" class="form-horizontal" action="admin_cat.php" method="GET"> 
			<div class="form-group">
				<!-- Nombre Categoria--><label for="catname">Nombre: </label><input id="catname" name="catname" type="text" placeholder="Nueva Categoría" class="form-control"> 
				</div>
				<div class="form-group">
				<!-- Descripción categoria--><label for="catdesc">Descripción: </label><textarea rows="7" id="catdesc" name="catdesc" type="text" placeholder="Nueva Descripción" class="form-control"> </textarea>
				</div>
				<div class="form-group">
				<input type="hidden" id="accion" name="accion" value="1">
				 <button type="submit" class="btn btn-primary btn-md"><i class='glyphicon glyphicon-plus-sign'></i> Añadir</button>  </form></div>
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
