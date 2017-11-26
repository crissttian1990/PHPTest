</div>
<footer>	
<div class="row">
<div class="col-lg-12">
<?php
require_once 'clases/clasecategorias.php';
$listadofooter = new categorias;
$acumulador    = "";
?>
</div>
</div>
			<div class="row">
				<div class="col-lg-12">
				<hr>
				</div>
			</div>
			<div class="row">
				
				<div class="col-md-6"> 
					<ul class="list-unstyled"> 
						<li>Categor&iacute;as<li> 
					</ul> 
					<?php
//Listamos las categorias en el footer
foreach ($listadofooter->getCategorias() as $clave => $valor) {
    $acumulador .= "<a href='categoria.php?id=" . $valor->idcategory . "'><button type='button' class='btn btn-primary btn-xs'>" . $valor->name . " (" . $valor->total . ")</button></a>&nbsp;";
    if ($clave % 5 == 0 && $clave != 0) {
        echo "<p>" . $acumulador . "</p>";
        $acumulador = "";
    }
}
if ($acumulador != "") {
    echo "<p>" . $acumulador . "</p>";
}
?>
				</div>  
				<div class="col-md-3"> 
					<ul class="list-unstyled"> 
						<li>¡S&iacute;guenos!<li> 
						<li><a href="#">Facebook</a></li> 
						<li><a href="#">Twitter</a></li> 
					</ul> 


				</div>
				<div class="col-md-3"> 
					<ul class="list-unstyled"> 
						<li>MePregunto<li> 
						<li><a href="como-funciona.php">¿C&oacute;mo funciona?</a></li> 
						<li><a href="index.php">Preguntas</a></li> 
						<li><a href="nueva-pregunta.php">Haz una pregunta</a></li> 
					</ul> 
				</div> 
			</div>  
			<hr> 
			<div class="row"> 
			<div class="col-lg-12"> 
			<p class="muted pull-right">© 2014 MePregunto</p>
				</div></div>
				
		</footer>
		</div>
	
	
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script src="js/jquery-1.11.0.min.js"></script>
	<script src="js/funciones.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>