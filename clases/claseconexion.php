<?php
require_once 'configconex.php';
class conexion
{
    var $conexiondb; // propiedad objeto MYSQLi 
    var $baseDatos;
    var $servidor;
    var $usuario;
    var $clave;
    function conexion()
    {
        $this->baseDatos = $GLOBALS['basedatos'];
        $this->servidor  = $GLOBALS['servidor'];
        $this->usuario   = $GLOBALS['usuario'];
        $this->clave     = $GLOBALS['clave'];
    }
    // conectar con la base de datos
    function conectar()
    {
        $db = new MySQLi($this->servidor, $this->usuario, $this->clave, $this->baseDatos);
        $db->set_charset("utf8");
        if ($db->connect_errno) {
            return 0;
            $this->conexiondb = NULL;
        } else {
            $this->conexiondb = $db;
            return 1;
        }
    }
    // desconectar de la Base de datos
    function desconectar()
    {
        $this->conexiondb->close();
    }
    
}

?>