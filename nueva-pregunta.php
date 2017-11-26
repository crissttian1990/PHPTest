<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="¡Haz una pregunta!">
		<meta name="author" content="Cristian Fernández">
		<!-- Código  para mostrar el favicon -->
		<LINK REL="SHORTCUT ICON" HREF="favicon.ico" />
		<title>MePregunto - ¡Haz una pregunta!</title>
		<?php
//Incluimos la cabecera de la página que contiene elementos dinámicos e iniciamos sesión
include_once 'inc/cabecera.php';
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// comprobamos que se haya iniciado la sesión
if (isset($_SESSION['usuario_nombre'])) {
    //Llamamos a la clase preguntas que nos mostrará todo el listado de preguntas del index y declaramos un objeto preguntas para acceder a ella.
    require_once 'clases/clasepreguntas.php';
    require_once 'clases/clasecategorias.php';
    $listado    = new preguntas;
    $categorias = new categorias;
    $flag       = 5;
    $cadena     = "";
    if (isset($_POST["flag"])) {
        $input = $_POST["input"];
        $flag  = $_POST["flag"];
    }
    if (isset($_POST['questionname']) && $input == $_SESSION['captcha_string'] && $flag == 1) {
        $resultado = $listado->addPregunta($_POST['questionname'], $_POST['message'], $_POST['category'], $_SESSION['usuario_id'], 0);
        
        
        if ($resultado != null) {
            header('Location: pregunta.php?id=' . $resultado);
        } else {
            $cadena = "<div class='alert alert-danger'><i class='glyphicon glyphicon-remove-sign'></i> ERROR. No se insertó el registro </div>";
        }
    } else if (isset($_POST["input"])) {
        $cadena = "<div class='alert alert-danger'><i class='glyphicon glyphicon-remove-sign'></i> ERROR. Captcha incorrecto</div>";
    }
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
				 <li class="active">Nueva Pregunta</li>
			</ol>
		</div>
		</div>
		<?php
    echo $cadena;
?>
		<div id="alertaweb"></div>
		<div class="row">
			<div class="col-lg-12">
			<div class="row">
<div class="col-lg-12 col-md-12">
 <div class="alert-message alert-message-info">
 		<div class="row">
			<div class="col-lg-12">
			<h1>Envia tu pregunta</h1>
			</div>
		</div>
                
                <p>Rellenando este formulario puedes preguntar lo que quieras, siempre que rellenes todos los campos y coloques la pregunta en su categoria correspondiente.</p>
						
            </div>
</div>
</div>
				<div class="row">
				<div class="col-lg-12">
				 <form id="formpregunta" class="form-horizontal" action="nueva-pregunta.php" method="post"> 
				<fieldset> <legend class="text-center">Escribe tu pregunta</legend> 
				<!-- Name input--> <div class="form-group"> <label class="col-md-3 control-label" for="questionname">Pregunta</label> <div class="col-md-9"> <input id="questionname" name="questionname" type="text" placeholder="Pregunta" class="form-control"> </div> </div> 
				
				<!-- Email input--> <div class="form-group"> <label class="col-md-3 control-label" for="category">Selecciona una categoria</label> <div class="col-md-9"> 
				<select id="category" name="category" class="form-control">
				<?php
    foreach ($categorias->getCategoriasSn() as $valor) {
        echo "<option value='" . $valor->idcategory . "'>" . $valor->name . "</option>";
    }
?>
				</select>
				</div> </div> 
				
				<!-- Message body --> <div class="form-group"> <label class="col-md-3 control-label" for="message">Tu Pregunta</label> <div class="col-md-9"> <textarea class="form-control" id="message" name="message" placeholder="Escribe tu pregunta aquí..." rows="5"></textarea> </div> </div> 
				
				<div class="form-group">
				<div class="col-lg-3">
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
        


          </div>
				
				<!-- Form actions --> <div class="form-group"> <div class="col-md-12 text-right"> <button type="submit" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-plus-sign"></i> Enviar Pregunta</button> </div> </div> </fieldset> </form> </div>
				
				</div>	
			</div>		
<?php
} else {
    //Si no tiene permisos, devuelve el mensaje de error
    echo "<div class='row'><div class='col-lg-12'><div class='alert alert-info'><p>Estás accediendo a una página restringida, para ver su contenido debes estar registrado.</p>
        <a href='registro.php'><b>Registrarme</b></a> o <a href='index.php'><b>Identifícate</b></a></div></div>";
    
} //Se incluye el resto de la página, es decir, la sidebar y el footer.
include 'inc/pie.php';
?>
