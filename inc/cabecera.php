<?php
//Incluimos la clase que incluye las categorías e instanciamos el objeto para utilizarlo más adelante
require_once 'clases/clasecategorias.php';
$listado = new categorias;
?>
	<!-- Importamos los estilos de bootstrap -->
	<!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
	
	<link href="css/estilo.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
	
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
	<body>
	<!-- Barra de navegación fija -->
    <div class="navbar navbar-inverse navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">MePregunto</a>
        </div>
        <div class="navbar-collapse collapse">
			<!-- Menú izquierdo -->
          <ul class="nav navbar-nav">
            <li><a href="index.php">Inicio</a></li>
			<li><a href="como-funciona.php">¿C&oacute;mo funciona?</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categor&Iacute;as <b class="caret"></b></a>
              <ul class="dropdown-menu">
				<?php // Listamos las categorias en el menú
foreach ($listado->getCategorias() as $valor) {
    echo "<li><a href='categoria.php?id=" . $valor->idcategory . "'>" . $valor->name . " (" . $valor->total . ")</a></li>";
}
?>
              </ul>
            </li>
          </ul>
			<!-- Menú derecho -->
		  <ul class="nav navbar-nav navbar-right">
			<li><a href="nueva-pregunta.php">Haz una pregunta</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

	<!-- Creamos el contenedor de la página que más adelante cerraremos en el footer -->
	<div class="container">
	