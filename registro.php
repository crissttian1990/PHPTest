<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="MePregunto - Página de registro">
		<meta name="author" content="Cristian Fernández">
		<!-- Código  para mostrar el favicon -->
		<LINK REL="SHORTCUT ICON" HREF="favicon.ico" />
		<title>MePregunto - ¡Regístrate!</title>
		<?php
//Incluimos la cabecera de la página que contiene elementos dinámicos
include_once 'inc/cabecera.php';
//Llamamos a la clase preguntas que nos mostrará todo el listado de preguntas del index y declaramos un objeto preguntas para acceder a ella.
require_once 'clases/clasepreguntas.php';
$listado = new preguntas;
session_start();
// comprobamos que se haya iniciado la sesión
if (!isset($_SESSION['usuario_nombre'])) {
    $_SESSION['count'] = time();
    $image;
    function create_image()
    {
        global $image;
        $image = imagecreatetruecolor(200, 50) or die("Cannot Initialize new GD image stream");
        
        $background_color = imagecolorallocate($image, 255, 255, 255);
        $text_color       = imagecolorallocate($image, 0, 255, 255);
        $line_color       = imagecolorallocate($image, 64, 64, 64);
        $pixel_color      = imagecolorallocate($image, 0, 0, 255);
        
        imagefilledrectangle($image, 0, 0, 200, 50, $background_color);
        
        for ($i = 0; $i < 3; $i++) {
            imageline($image, 0, rand() % 50, 200, rand() % 50, $line_color);
        }
        
        for ($i = 0; $i < 1000; $i++) {
            imagesetpixel($image, rand() % 200, rand() % 50, $pixel_color);
        }
        
        
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $len     = strlen($letters);
        $letter  = $letters[rand(0, $len - 1)];
        
        $text_color = imagecolorallocate($image, 0, 0, 0);
        $word       = "";
        for ($i = 0; $i < 6; $i++) {
            $letter = $letters[rand(0, $len - 1)];
            imagestring($image, 7, 5 + ($i * 30), 20, $letter, $text_color);
            $word .= $letter;
        }
        $_SESSION['captcha_string'] = $word;
        
        $images = glob("img/captcha/*.png");
        foreach ($images as $image_to_delete) {
            @unlink($image_to_delete);
        }
        imagepng($image, "img/captcha/image" . $_SESSION['count'] . ".png");
        
    }
    create_image();
?>
		<div class="row">
		<div class="col-lg-12">
			<ol class="breadcrumb">
				<li><a href="index.php">Inicio</a></li>
				 <li class="active">Registro</li>
			</ol>
		</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
			<div class="row">
<div class="col-lg-12 col-md-12">
 <div class="alert-message alert-message-info">
 		<div class="row">
			<div class="col-lg-12">
			<h1>REGISTRO</h1>
			</div>
		</div>
                
                <p>Registráte en MePregunto rellenando el siguiente formulario</p>
						
            </div>
</div>
</div>
<div id="alertaweb"></div>
					<div class="row">
			<div class="col-lg-12">
			
		<form class="form-horizontal" id="formularioRegistro" enctype="multipart/form-data" method="post" role="form" action="registrado.php">
        <fieldset>

          <!-- Form Name -->
          <legend>Formulario de Registro</legend>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-4 control-label" for="textinput">Nickname</label>
            <div class="col-sm-5">
              <input type="text" id="nickname" name="nickname" placeholder="Nickname" class="form-control">
            </div>
          </div>

			<!-- Text input-->
          <div class="form-group">
            <label class="col-sm-4 control-label" for="textinput">Contraseña</label>
            <div class="col-sm-4">
              <input type="password" id="pass" name="pass" placeholder="Contraseña" class="form-control">
            </div>
			</div>
			<div class="form-group">
            <label class="col-sm-4 control-label" for="textinput">Repite Contraseña</label>
            <div class="col-sm-4">
              <input type="password" id="passrep" name="passrep" placeholder="Repite Contraseña" class="form-control">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-4 control-label" for="textinput">E-Mail</label>
            <div class="col-sm-6">
              <input type="text" id="email" name="email" placeholder="E-Mail" class="form-control">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-4 control-label" for="textinput">Fecha nacimiento</label>
            <div class="col-sm-4">
              <input type="date" id="fechanac" name="fechanac"  class="form-control">
            </div>
		 </div>
			<div class="form-group">
            <label class="col-sm-4 control-label" for="textinput">País</label>
            <div class="col-sm-4">
			<select class="form-control" id="pais" name="pais" >
			  <option value="España">España</option>
			  <option value="Otro">Otro</option>
			</select>
            </div>
          </div>

<div class="form-group">
				<div class="col-lg-4">
		   <label class="control-label" for="input" >Teclea lo que aparece en la imagen</label>
</div>
        <div class="col-lg-3">
            <img src="img/captcha/image<?php
    echo $_SESSION['count'];
?>.png">
        </div>
		<div class="col-lg-3">
        <input type="text" id="input" name="input" class="form-control"/><input type="hidden" name="flag" value="1"/>
		</div>
 
    
	
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="pull-right">
                <button type="submit" id="btnRegistroEnviar" class="btn btn-primary">¡Regístrate!</button>
              </div>
            </div>
          </div>

        </fieldset>
      </form>
			</div>
		</div>
			</div>		
<?php
    
} else {
    
    echo "<div class='alert alert-danger'><div class='col-lg-8 col-md-8'>	<p>Estás accediendo a una página restringida.</p>
        <a href='index.php'><b>Volver a la página principal</b></a></div>";
}
//Se incluye el resto de la página, es decir, la sidebar y el footer.
include 'inc/pie.php';
?>
