<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Cambio de avatar">
		<meta name="author" content="Cristian Fernández">
		<!-- Código  para mostrar el favicon -->
		<LINK REL="SHORTCUT ICON" HREF="favicon.ico" />
		<title>MePregunto - Cambiar Avatar</title>
		<?php
//Incluimos la cabecera de la página que contiene elementos dinámicos
include_once 'inc/cabecera.php';
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once('clases/claseusuarios.php');
?>
	

<div class="row">
		<div class="col-lg-12">
			<ol class="breadcrumb">
				<li><a href="index.php">Inicio</a></li>
				 <li class="active">Cambiar Avatar</li>
			</ol>
		</div>
		</div>

		<div class="row">
			<div class="col-lg-8 col-md-8">
			<div class="row">
<div class="col-lg-12 col-md-12">
 <div class="alert-message alert-message-info">
 		<div class="row">
			<div class="col-lg-12">
			<h1>Cambia tu avatar</h1>
			</div>
		</div>
                
                <p>Cambia tu avatar, selecciona la imagen que prefieras como avatar en el campo de debajo, pulsa el botón cambiar avatar y listo. </p>
						
            </div>
</div>
</div>

<?php
// Sube la imagén y la redimensiona
if (!empty($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    require_once 'clases/ModifiedImage.php';
    
    $image = new ModifiedImage($_FILES['image']['tmp_name']);
    
    if ($image->getHeight() > 200) {
        $image->resizeToHeight(200);
        $h200 = 'img/avatar/h200_' . $_FILES['image']['name'];
        $image->save($h200);
        $avatar = new usuarios;
        $avatar->editAvatar($_SESSION['usuario_id'], $h200);
    }
?>
La imagen fue grabada:
<a href="<?php
    echo $h200;
?>" target="_blank">Ver imagen</a>
<?php
}
?>
 


			 <?php
if (isset($_SESSION['usuario_nombre'])) { // comprobamos que la sesión esté iniciada
    
?>
			<div class="row">
			<div class="col-lg-8">
<form action="<?php
    echo $_SERVER['PHP_SELF'];
?>" method="post" enctype="multipart/form-data">
    <input type="file" name="image" />
    <button type="submit" name="submit" class="btn btn-primary btn-md" /><i class="glyphicon glyphicon-pencil"></i> Cambiar Avatar</button>
</form>
			</div>
			</div>
    <?php
} else {
    //Si no tiene permisos, devuelve el mensaje de error
    echo "<div class='alert alert-info'>No tienes permiso para acceder a esta página. <a href='registro.php' class='alert-link'>Registráte</a> o <a href='index.php' class='alert-link'>Identifícarte</a></div>";
}
?> 
			
			
			</div>		
<?php //Se incluye el resto de la página, es decir, la sidebar y el footer.
include 'inc/sidebar.php';
include 'inc/pie.php';
?>