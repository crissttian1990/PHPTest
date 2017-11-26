<div class="col-lg-4">
	<!-- Fila 1 -->
	<div class="row">
		<div class="col-lg-12">
			<div class="input-group custom-search-form">
              <input type="text" id="txtBuscar" placeholder="Busca una pregunta..." class="form-control">
              <span class="input-group-btn">
              <button id="btnBuscar" class="btn btn-info" type="button">
              <span class="glyphicon glyphicon-search"></span>
             </button>
             </span>
             </div><!-- /input-group -->
		</div>
	</div>
	<!-- Fila Separadora -->
	<div class="row">
		<div class="col-lg-12">
			<br>
		</div>
	</div>
	<!-- Fila 2 Caja Login -->
	<div class="row">
		<div class="col-lg-12" id="login">
			<?php
include_once("inc/login.php");
?>
		</div>
	</div>
	<!-- Fila 3 -->
	<div class="row">
		<div class="col-lg-12">
			 <div class="list-group">
                	<a href="#" class="list-group-item facebook-like">
                    <h3 class="pull-right">
                        <i class="fa fa-facebook"></i>
                    </h3>
                    <h4 class="list-group-item-heading count">
                        354</h4>
                    <p class="list-group-item-text">
                        Usuarios en facebook</p>
                </a><a href="#" class="list-group-item twitter">
                    <h3 class="pull-right">
                        <i class="fa fa-twitter"></i>
                    </h3>
                    <h4 class="list-group-item-heading count">
                        451</h4>
                    <p class="list-group-item-text">
                        Seguidores en twitter</p>
                </a>
				<a href="#" class="list-group-item google-plus">
                    <h3 class="pull-right">
                        <i class="fa fa-users"></i>
                    </h3>
                    <h4 class="list-group-item-heading count">
                        <?php 
						require_once 'clases/claseusuarios.php';
						$usuarios=new usuarios;
						echo $usuarios->getUsersTotal();
						?></h4>
                    <p class="list-group-item-text">
                        Usuarios en MePregunto</p>
                </a>
            </div>
		</div>
	</div>
	<!-- Fila 4 -->
	<div class="row">
		<div class="col-lg-12">
		</div>
	</div>
</div>



	
			