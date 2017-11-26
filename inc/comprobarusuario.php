<?php
require '../clases/claseusuarios.php';
$comprobarusuario = new usuarios;
echo $comprobarusuario->getCoincidenciaUser($_POST['nickname']);
?>