<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Panel de administración - Editar usuarios">
		<meta name="author" content="Cristian Fernández">
		<!-- Código  para mostrar el favicon -->
		<LINK REL="SHORTCUT ICON" HREF="favicon.ico" />
		<title>MePregunto - Administración/Editar usuario</title>
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
				 <li class="active">Editar usuario</li>
			</ol>
		</div>
		</div>

		<div class="row">
			<div class="col-lg-8 col-md-8">
			<div id="alertaweb"></div>
			<?php
// Se comprueba si el usuario está logueado y si tiene permiso para acceder
if ((isset($_SESSION['usuario_nombre']) == true) && $_SESSION['usuario_permiso'] == 2 && (isset($_GET['id']) == true)) {
    // Se obtiene el registro a editar
    require_once 'clases/claseusuarios.php';
    $listado = new usuarios;
    $listado = $listado->getUsuarioById($_GET['id']);
?>
			<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
 				 <h1>Panel de Administración <small>Editar Usuarios</small></h1>
				</div>
			</div>
			</div>
			<div class="row">
			<div class="col-lg-12">
			<form id="formedituser" class="form-horizontal" action="admin_user.php" method="GET"> 
				<!-- Text input-->
          <div class="form-group">
            <label class="col-sm-4 control-label" for="nickname">Nickname</label>
            <div class="col-sm-5">
              <input type="text" id="nickname" name="nickname" readonly placeholder="Nickname" class="form-control" value="<?php
    echo $listado->nick;
?>">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-4 control-label" for="email">E-Mail</label>
            <div class="col-sm-6">
              <input type="email" id="email" name="email" placeholder="E-Mail" class="form-control" value="<?php
    echo $listado->mail;
?>">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-4 control-label" for="fechanac">Fecha nacimiento</label>
            <div class="col-sm-4">
              <input type="date" id="fechanac" name="fechanac"  class="form-control" value="<?php
    echo $listado->birthday;
?>">
            </div>
		 </div>
			<div class="form-group">
            <label class="col-sm-4 control-label" for="permiso">Permisos</label>
            <div class="col-sm-4">
			<select class="form-control" id="permiso" name="permiso" >
			  <option value="0">Baneado</option>
			  <option selected value="1">Usuario</option>
			  <option value="2">Administrador</option>
			</select>
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-4 control-label" for="pais">País</label>
            <div class="col-sm-4">
			<select class="form-control" id="pais" name="pais" >
			  <option value="España">España</option>
			  <option value="Otro">Otro</option>
			</select>
            </div>
          </div>
		  
				<input type="hidden" id="iduser" name="iduser" value="<?php
    echo $listado->iduser;
?>">
				<input type="hidden" id="accion" name="accion" value="1">
				 <button type="submit" class="btn btn-primary btn-md"><i class='glyphicon glyphicon-pencil'></i> Editar Usuario</button>  </form>
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
