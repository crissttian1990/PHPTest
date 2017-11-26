<?php
if ($_SERVER['PHP_SELF'] != "/MePregunto/inc/login.php") {
    require_once 'clases/claseusuarios.php';
} else {
    require_once '../clases/claseusuarios.php';
}
$cadena = "";
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (isset($_SESSION['usuario_nombre'])) {
    $datos = new usuarios;
    $datos = $datos->buscarUsuarioPorNick($_SESSION['usuario_nombre']);
    echo "
			<div class='profile'>
				<center><img src='" . $datos->avatar . "' alt='...' width='180' height='180' class='img-circle'>
				<p><h3>" . $datos->nick . "</h3></p>
				<p>" . $datos->mail . "</p></center>
			</div>
			<ul class='list-group'>
				<li class='list-group-item'>" . $datos->getPreguntasTotalUser($datos->iduser) . " Preguntas</li>
				<li class='list-group-item'>" . $datos->getRespuestasTotalUser($datos->iduser) . " Respuestas</li>";
    
    if ($_SESSION['usuario_permiso'] == 2) {
        echo "<li class='list-group-item'><a href='admin.php'>Administración</a></li>";
    }
    echo "<li class='list-group-item'><a href='cambiar_avatar.php'>Cambiar Avatar</a></li>
				<li class='list-group-item'><a href='cambiar_contrasena.php'>Cambiar Contraseña</a></li>
				<li class='list-group-item'><a href='perfil.php?id=" . $datos->iduser . "'>Perfil</a></li>
				<li class='list-group-item'><a href='inc/logout.php'>Logout</a></li>
			</ul>
		";
} else if (isset($_SESSION['usuario_permiso'])) {
    if ($_SESSION['usuario_permiso'] == 0) {
        $cadena = "<div class='form-group'><h4 class='text-danger'>USUARIO BANEADO</h4></div>
		<div class='panel panel-info'>
  <div class='panel-heading'><h3 class='panel-title'><strong>Indentifícate (<a href='registro.php'>Regístrate</a>)</strong></h3></div>
  <div class='panel-body' >
<div class='form-group'><label for='usuario'>Usuario</label><input type='text' class='form-control' id='usuario' name='usuario' placeholder='Usuario'></div><div class='form-group'><label for='clave'>Contraseña </label><input type='password' class='form-control' id='clave' name='clave' placeholder='Contraseña'></div><button type='button' id='btnLogin' class='btn btn-sm btn-default'>Entrar</button>

  </div>
</div>";
    }
} else {
    $cadena = "<div class='panel panel-info'>
  <div class='panel-heading'><h3 class='panel-title'><strong>Indentifícate (<a href='registro.php'>Regístrate</a>)</strong></h3></div>
  <div class='panel-body' >
<div class='form-group'><label for='usuario'>Usuario</label><input type='text' class='form-control' id='usuario' name='usuario' placeholder='Usuario'></div><div class='form-group'><label for='clave'>Contraseña </label><input type='password' class='form-control' id='clave' name='clave' placeholder='Contraseña'></div><button type='button' id='btnLogin' class='btn btn-sm btn-default'>Entrar</button>
  </div>
</div>";
}


echo $cadena;

?>