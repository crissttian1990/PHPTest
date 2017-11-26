<?php
// Clases requeridas
require_once 'claseconexion.php';

// Definición de la clase
class likes
{
    // Atributos
    var $idlike;
    var $idanswer;
    var $iduser;
    var $datetime;
    
    // Método insertar like
    function insertarLike($idanswer, $usuario)
    {
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $SQLstr    = "INSERT INTO likes VALUES (NULL,?,?,NOW());";
            $resultado = $miConexion->conexiondb->prepare($SQLstr);
            $resultado->bind_param('ii', $idanswer, $usuario);
            $resultado->execute();
            if ($miConexion->conexiondb->affected_rows > 0) {
                return 1;
            } else {
                return 0;
            }
            $miConexion->desconectar();
        }
    }
	
	// Método borrar likes
    function borrarLikes($idanswer)
    {
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $SQLstr    = "DELETE FROM likes WHERE idanswer=?";
            $resultado = $miConexion->conexiondb->prepare($SQLstr);
            $resultado->bind_param('s', $idanswer);
            $resultado->execute();
            if ($miConexion->conexiondb->affected_rows > 0) {
                return 1;
            } else {
                return 0;
            }
            $miConexion->desconectar();
        }
    }
    
    
    // Método buscar likes de usuario
    function getLikesCoincidencia($idpregunta, $iduser)
    {
        $query      = "SELECT * FROM likes WHERE idanswer=" . $idpregunta . " AND iduser=" . $iduser . "";
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            if ($miConexion->conexiondb->affected_rows > 0) {
                return 1;
            } else {
                return 0;
            }
            
            
        }
        
    }
    
    
    
}

?>