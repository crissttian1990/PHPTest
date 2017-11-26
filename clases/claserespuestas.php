<?php
// Clases requeridas
require_once 'claseconexion.php';

// Definición de la clase
class respuestas
{
    // Atributos
    var $idanswer;
    var $answer;
    var $idautor;
    var $autor;
    var $idquestion;
    var $datetime;
    var $likes;
    
    // Muestra las respuestas según el número de likes
    function getRespuestasByLikes($limite, $idpregunta)
    {
        $query = "SELECT *,answers.idanswer as idanswera ,answers.datetime as datetimea, count(idlike) as likes FROM answers LEFT JOIN likes ON (answers.idanswer=likes.idanswer) LEFT JOIN users ON answers.idautor=users.iduser WHERE answers.idquestion=" . $idpregunta . " GROUP BY answers.idanswer ORDER BY count(idlike) DESC, answers.datetime ASC";
        if ($limite != 0) {
            $query .= " LIMIT " . $limite;
        }
        $respuestas = array();
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($fila = $resultado->fetch_assoc()) {
                $respuesta             = new respuestas;
                $respuesta->idanswer   = $fila['idanswera'];
                $respuesta->answer     = $fila['answer'];
                $respuesta->idautor    = $fila['idautor'];
                $respuesta->autor      = $fila['nick'];
                $respuesta->idquestion = $fila['idquestion'];
                $respuesta->datetime   = $fila['datetimea'];
                $respuesta->likes      = $fila['likes'];
                $respuestas[]          = $respuesta;
            }
            
            $miConexion->desconectar();
            return $respuestas;
        }
    }
    
    // Muestra el número total de las respuestas de una pregunta
    function getTotalRespuestas($idpregunta)
    {
        $query      = "SELECT count(idanswer) as total FROM answers WHERE idquestion=" . $idpregunta;
        $miConexion = new conexion;
        $total;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($fila = $resultado->fetch_assoc()) {
                $total = $fila['total'];
            }
            $miConexion->desconectar();
            return $total;
        }
    }
    
    
    // Método insertar respuesta
    function addRespuesta($answerI, $idautorI, $idquestionI)
    {
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $SQLstr    = "INSERT INTO answers VALUES (NULL,?,?,?,NOW());";
            $resultado = $miConexion->conexiondb->prepare($SQLstr);
            $resultado->bind_param('sii', $answerI, $idautorI, $idquestionI);
            $resultado->execute();
            if ($miConexion->conexiondb->affected_rows > 0) {
                return 1;
            } else {
                return 0;
            }
            $miConexion->desconectar();
        }
    }
    
    // Método obtener respuestas de una pregunta
    function getRespuestasById($idrespuesta)
    {
        $query      = "SELECT * FROM answers WHERE idanswer=" . $idrespuesta;
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            $respuesta = new respuestas;
            while ($fila = $resultado->fetch_assoc()) {
                $respuesta->idanswer   = $fila['idanswer'];
                $respuesta->answer     = $fila['answer'];
                $respuesta->idautor    = $fila['idautor'];
                $respuesta->idquestion = $fila['idquestion'];
            }
            
            $miConexion->desconectar();
            return $respuesta;
        }
    }
    
    // Método editar respuesta
    function editRespuesta($idanswerE, $answerE)
    {
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $SQLstr    = "UPDATE answers SET answer=? WHERE idanswer=?;";
            $resultado = $miConexion->conexiondb->prepare($SQLstr);
            $resultado->bind_param('ss', $answerE, $idanswerE);
            $resultado->execute();
            if ($miConexion->conexiondb->affected_rows > 0) {
                return 1;
            } else {
                return 0;
            }
            $miConexion->desconectar();
        }
    }
    
    // Método borrar respuesta
    function removeRespuesta($idanswerD)
    {
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $SQLstr    = "DELETE FROM answers WHERE idanswer=?;";
            $resultado = $miConexion->conexiondb->prepare($SQLstr);
            $resultado->bind_param('s', $idanswerD);
            $resultado->execute();
            if ($miConexion->conexiondb->affected_rows > 0) {
                return 1;
            } else {
                return 0;
            }
            $miConexion->desconectar();
        }
    }
    
}

?>