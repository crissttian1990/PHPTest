<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Panel de administración - Categorías">
		<meta name="author" content="Cristian Fernández">
		<!-- Código  para mostrar el favicon -->
		<LINK REL="SHORTCUT ICON" HREF="favicon.ico" />
		<title>MePregunto - Administración/Editar categoria</title>
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
			<div id="alertaweb"></div>
			<?php
// Se comprueba si el usuario está logueado y si tiene permiso de administrador
if ((isset($_SESSION['usuario_nombre']) == true) && $_SESSION['usuario_permiso'] == 2 && (isset($_GET['catid']) == true)) {
    // Se obtiene la categoria que va a editar
    require_once 'clases/clasecategorias.php';
    $listado = new categorias;
    $listado = $listado->getCategoria($_GET['catid']);
?>
			<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
 				 <h1>Panel de Administración <small>Editar Categorias</small></h1>
				</div>
			</div>
			</div>
			<div class="row">
			<div class="col-lg-12">
			<!-- Formulario Editar Categoria-->
			<form id="formeditcat" class="form-horizontal" action="admin_cat.php" method="GET"> 
			
				<div class="form-group">
				<!-- Nombre Categoria--><label for="catname">Nombre: </label><input id="catname" name="catname" type="text" placeholder="Nueva Categoría" class="form-control" value="<?php
    echo $listado->name;
?>"> 
				</div>
				<div class="form-group">
				<!-- Descripción Categoria--><label for="catdesc">Descripción: </label><textarea rows="7" id="catdesc" name="catdesc"  placeholder="Nueva Descripción" class="form-control"> <?php
    echo $listado->description;
?></textarea>
				</div>
				<div class="form-group">
				<input type="hidden" id="catid" name="catid" value="<?php
    echo $listado->idcategory;
?>">
				<input type="hidden" id="accion" name="accion" value="3">
				 <button type="submit" class="btn btn-primary btn-md"><i class='glyphicon glyphicon-pencil'></i> Editar Categoría</button>  </form>
			</div></div>
			</div>
			
			
			<?php
} else {
    echo "<div class='alert alert-danger'>ACCESO DENEGADO<br><a href='index.php' class='alert-link'>Volver al inicio</a></div>";
}
?>
			</div>		
<?php //Se incluye el resto de la página, es decir, la sidebar y el footer.
include 'inc/sidebar.php';
include 'inc/pie.php';
?>
