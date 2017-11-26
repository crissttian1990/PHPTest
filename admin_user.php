<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Panel de administración - Usuarios">
		<meta name="author" content="Cristian Fernández">
		<!-- Código  para mostrar el favicon -->
		<LINK REL="SHORTCUT ICON" HREF="favicon.ico" />
		<title>MePregunto - Administración/Usuarios</title>
		<?php
//Incluimos la cabecera de la página que contiene elementos dinámicos e iniciamos la sesión
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
				 <li class="active">Usuarios</li>
			</ol>
		</div>
		</div>

		<div class="row">
			<div class="col-lg-8 col-md-8">
			<?php
// Se comprueba que el usuario esté logueado y tenga permisos de administrador
if ((isset($_SESSION['usuario_nombre']) == true) && $_SESSION['usuario_permiso'] == 2) {
    require_once 'clases/claseusuarios.php';
    $listado = new usuarios;
    //primero obtenemos el parametro que nos dice en que pagina estamos
    
    if (array_key_exists('pg', $_GET)) {
        $page = $_GET['pg']; //si el valor pg existe en nuestra url, significa que estamos en una pagina en especifico.
    } else {
        $page = 0; //inicializamos la variable $page a 0 por default
    }
    //ahora que tenemos en que pagina estamos obtengamos los resultados:
    // a) el numero de registros en la tabla
    $total = $listado->getUsersTotal();
    
    //ahora dividimos el conteo por el numero de registros que queremos por pagina.
    $max_num_paginas = intval($total / 30) + 1; //en esto caso 10
    if (isset($_GET['accion'])) {
        switch ($_GET['accion']) {
            case 1:
                $listado->editUser($_GET['iduser'], $_GET['email'], $_GET['fechanac'], $_GET['pais'], $_GET['permiso']);
                echo "<div class='row'><div class='col-lg-12'><div class='alert alert-success'>Se editó el usuario seleccionado</div></div></div>";
                break;
            case 2:
                $listado->removeUser($_GET['id']);
                echo "<div class='row'><div class='col-lg-12'><div class='alert alert-success'>Se eliminó el usuario seleccionado</div></div></div>";
                break;
                
        }
    }
?>
			<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
 				 <h1>Panel de Administración <small>Usuarios</small></h1>
				</div>
			</div>
			</div>
			<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
				  <table class="table">
					<tr><th>Nombre Usuario</th><th>Tipo usuario</th><th>Editar</th><th>Borrar</th></tr>
					<?php // Listamos los usuarios en la tabla
    foreach ($listado->getUsuarios((($page) * 30) . ", 30") as $valor) {
        
        switch ($valor->idpermission) {
            case 0:
                $permiso = "Baneado";
                break;
            case 1:
                $permiso = "Usuario";
                break;
            case 2:
                $permiso = "Administrador";
                break;
        }
        
        echo "<tr><td><a href='perfil.php?id=" . $valor->iduser . "'>" . $valor->nick . "</a></td><td>$permiso</td><td><a href='admin_useredit.php?id=" . $valor->iduser . "'><i class='glyphicon glyphicon-pencil'></i> Editar</a></td><td><a href='admin_user.php?accion=2&id=" . $valor->iduser . "'><i class='glyphicon glyphicon-remove'></i> Borrar</a></td><tr>";
    }
?>
				  </table>
				</div>
			</div>
			</div>
			<div class="row">
			<div class="col-lg-12"><?php
    //ahora viene la parte importante, que es el paginado
    //recordemos que $max_num_paginas fue previamente calculado.
    if ($page == 0) {
        echo '<ul class="pagination"><li class="disabled"><a href="#">&laquo;</a></li>';
    } else {
        echo '<ul class="pagination"><li><a href="admin_user.php?pg=' . ($page - 1) . '">&laquo;</a></li>';
    }
    
    for ($i = 0; $i < $max_num_paginas; $i++) {
        if ($i != $page) {
            echo '<li><a href="admin_user.php?pg=' . ($i) . '">' . ($i + 1) . '</a></li>';
        } else {
            echo '<li class="active"><a href="admin_user.php?pg=' . ($i) . '">' . ($i + 1) . '</a></li>';
        }
    }
    if ($page + 1 != $max_num_paginas) {
        echo '<li><a href="admin_user.php?pg=' . ($page + 1) . '">&raquo;</a></li></ul>';
    } else {
        echo '<li class="disabled"><a href="#">&raquo;</a></li></ul>';
    }
    
?>
</div></div>

			
			
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
