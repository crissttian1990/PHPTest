<?php
// Clases requeridas
require_once 'claseconexion.php';

// Definición de la clase
class preguntas
{
    // Atributos
    var $idquestion;
    var $question;
    var $questiontext;
    var $idcategory;
    var $idautor;
    var $datetime;
    var $views;
    var $category;
    var $autor;
    
    
    //Métodos para mostrar preguntas por fecha y usuario
    function getPreguntasByDateUser($limite, $iduser)
    {
        $query = "SELECT questions.idquestion,questions.question,questions.idautor,questions.idcategory,questions.datetime,questions.views,categories.name FROM questions INNER JOIN categories ON questions.idcategory=categories.idcategory";
        if ($iduser != 0) {
            $query .= " WHERE questions.idautor=" . $iduser;
        }
        $query .= " ORDER BY datetime Desc ";
        if ($limite != -1) {
            $query .= " LIMIT " . $limite;
        }
        $preguntas  = array();
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($fila = $resultado->fetch_assoc()) {
                $pregunta             = new preguntas;
                $pregunta->idquestion = $fila['idquestion'];
                $pregunta->question   = $fila['question'];
                $pregunta->idautor    = $fila['idautor'];
                $pregunta->idcategory = $fila['idcategory'];
                $pregunta->datetime   = $fila['datetime'];
                $pregunta->views      = $fila['views'];
                $pregunta->category   = $fila['name'];
                $preguntas[]          = $pregunta;
            }
            $miConexion->desconectar();
            return $preguntas;
        }
    }
    
    
    //Métodos para mostrar preguntas por fecha y por categorías
    function getPreguntasByDate($limite, $idcategoria)
    {
        $query = "SELECT questions.idquestion,questions.question,questions.idautor,questions.idcategory,questions.datetime,questions.views,categories.name FROM questions INNER JOIN categories ON questions.idcategory=categories.idcategory";
        if ($idcategoria != 0) {
            $query .= " WHERE questions.idcategory=" . $idcategoria;
        }
        $query .= " ORDER BY datetime Desc ";
        if ($limite != -1) {
            $query .= " LIMIT " . $limite;
        }
        $preguntas  = array();
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($fila = $resultado->fetch_assoc()) {
                $pregunta             = new preguntas;
                $pregunta->idquestion = $fila['idquestion'];
                $pregunta->question   = $fila['question'];
                $pregunta->idautor    = $fila['idautor'];
                $pregunta->idcategory = $fila['idcategory'];
                $pregunta->datetime   = $fila['datetime'];
                $pregunta->views      = $fila['views'];
                $pregunta->category   = $fila['name'];
                $preguntas[]          = $pregunta;
            }
            $miConexion->desconectar();
            return $preguntas;
        }
    }
    
    // Muestra preguntas por visitas y categoria
    function getPreguntasByViews($limite, $idcategoria)
    {
        $query = "SELECT questions.idquestion,questions.question,questions.idautor,questions.idcategory,questions.datetime,questions.views,categories.name FROM questions INNER JOIN categories ON questions.idcategory=categories.idcategory";
        if ($idcategoria != 0) {
            $query .= " WHERE questions.idcategory=" . $idcategoria;
        }
        $query .= " ORDER BY views Desc ";
        if ($limite != -1) {
            $query .= " LIMIT " . $limite;
        }
        $preguntas  = array();
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($fila = $resultado->fetch_assoc()) {
                $pregunta             = new preguntas;
                $pregunta->idquestion = $fila['idquestion'];
                $pregunta->question   = $fila['question'];
                $pregunta->idautor    = $fila['idautor'];
                $pregunta->idcategory = $fila['idcategory'];
                $pregunta->datetime   = $fila['datetime'];
                $pregunta->views      = $fila['views'];
                $pregunta->category   = $fila['name'];
                $preguntas[]          = $pregunta;
            }
            $miConexion->desconectar();
            return $preguntas;
        }
    }
    
    
    // Muestra ultimas preguntas respondidas por categorías
    function getPreguntasbyUltimasRespuestas($limite, $idcategoria)
    {
        $query = "SELECT questions.idquestion,questions.question,questions.idautor,questions.idcategory,questions.datetime,questions.views,categories.name
FROM questions
INNER JOIN categories ON questions.idcategory = categories.idcategory
INNER JOIN answers ON questions.idquestion = answers.idquestion";
        if ($idcategoria != 0) {
            $query .= " WHERE questions.idcategory=" . $idcategoria;
        }
        $query .= " GROUP BY questions.idquestion";
        $query .= " ORDER BY answers.datetime Desc ";
        if ($limite != -1) {
            $query .= " LIMIT " . $limite;
        }
        $preguntas  = array();
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($fila = $resultado->fetch_assoc()) {
                $pregunta             = new preguntas;
                $pregunta->idquestion = $fila['idquestion'];
                $pregunta->question   = $fila['question'];
                $pregunta->idautor    = $fila['idautor'];
                $pregunta->idcategory = $fila['idcategory'];
                $pregunta->datetime   = $fila['datetime'];
                $pregunta->views      = $fila['views'];
                $pregunta->category   = $fila['name'];
                $preguntas[]          = $pregunta;
            }
            $miConexion->desconectar();
            return $preguntas;
        }
    }
    
    // Muestra las preguntas más respondidas por categorías
    function getPreguntasbyMasRespondidas($limite, $idcategoria)
    {
        $query = "SELECT questions.idquestion,questions.question,questions.idautor,questions.idcategory,questions.datetime,questions.views,categories.name
FROM questions
INNER JOIN categories ON questions.idcategory = categories.idcategory
INNER JOIN answers ON questions.idquestion = answers.idquestion";
        if ($idcategoria != 0) {
            $query .= " WHERE questions.idcategory=" . $idcategoria;
        }
        $query .= " GROUP BY questions.idquestion";
        $query .= " ORDER BY COUNT(answers.idanswer) Desc ";
        if ($limite != -1) {
            $query .= " LIMIT " . $limite;
        }
        $preguntas  = array();
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($fila = $resultado->fetch_assoc()) {
                $pregunta             = new preguntas;
                $pregunta->idquestion = $fila['idquestion'];
                $pregunta->question   = $fila['question'];
                $pregunta->idautor    = $fila['idautor'];
                $pregunta->idcategory = $fila['idcategory'];
                $pregunta->datetime   = $fila['datetime'];
                $pregunta->views      = $fila['views'];
                $pregunta->category   = $fila['name'];
                $preguntas[]          = $pregunta;
            }
            $miConexion->desconectar();
            return $preguntas;
        }
    }
    
    // Método que lista todas las preguntas por categorias
    function getPreguntasTotal($idcategoria)
    {
        $query = "SELECT COUNT(*) AS total FROM questions";
        if ($idcategoria != 0) {
            $query .= " WHERE questions.idcategory=" . $idcategoria;
        }
        $total      = 0;
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($fila = $resultado->fetch_assoc()) {
                $total = $fila['total'];
            }
            $miConexion->desconectar();
            return $total;
        }
    }
    
    // Método que muestra el numero total de preguntas de un usuario
    function getPreguntasTotalUser($iduser)
    {
        $query = "SELECT COUNT(*) AS total FROM questions";
        if ($iduser != 0) {
            $query .= " WHERE questions.idautor=" . $iduser;
        }
        $total      = 0;
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($fila = $resultado->fetch_assoc()) {
                $total = $fila['total'];
            }
            $miConexion->desconectar();
            return $total;
        }
    }
    
    // Método que muestra las coincidencias de una pregunta con una cadena de texto
    function getPreguntasByTexto($limite, $texto, $orden)
    {
        $query = "SELECT * FROM questions INNER JOIN categories ON questions.idcategory=categories.idcategory WHERE question LIKE '%" . $texto . "%'";
        if ($orden != "") {
            $query .= " ORDER BY " . $orden;
        }
        if ($limite != 0) {
            $query .= " LIMIT " . $limite;
        }
        $preguntas  = array();
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($fila = $resultado->fetch_assoc()) {
                $pregunta             = new preguntas;
                $pregunta->idquestion = $fila['idquestion'];
                $pregunta->question   = $fila['question'];
                $pregunta->idautor    = $fila['idautor'];
                $pregunta->idcategory = $fila['idcategory'];
                $pregunta->datetime   = $fila['datetime'];
                $pregunta->views      = $fila['views'];
                $pregunta->category   = $fila['name'];
                $preguntas[]          = $pregunta;
            }
            return $preguntas;
            $miConexion->desconectar();
        }
    }
    
    // Método que muestra el numero total de coincidencias de las preguntas con una cadena
    function getPreguntasTotalByTexto($texto)
    {
        $query = "SELECT COUNT(*) AS total FROM questions WHERE question LIKE '%" . $texto . "%'";
        
        $total      = 0;
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($fila = $resultado->fetch_assoc()) {
                $total = $fila['total'];
            }
            return $total;
            $miConexion->desconectar();
        }
    }
    
    
    // Método que obtiene una pregunta por su id
    function getPreguntasById($idpregunta)
    {
        $query      = "SELECT * FROM questions INNER JOIN categories ON questions.idcategory=categories.idcategory INNER JOIN users ON questions.idautor=users.iduser WHERE questions.idquestion=" . $idpregunta;
        $pregunta   = new preguntas;
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($fila = $resultado->fetch_assoc()) {
                $pregunta               = new preguntas;
                $pregunta->idquestion   = $fila['idquestion'];
                $pregunta->question     = $fila['question'];
                $pregunta->questiontext = $fila['questiontext'];
                $pregunta->idautor      = $fila['idautor'];
                $pregunta->autor        = $fila['nick'];
                $pregunta->idcategory   = $fila['idcategory'];
                $pregunta->category     = $fila['name'];
                $pregunta->datetime     = $fila['datetime'];
                $pregunta->views        = $fila['views'];
            }
            $miConexion->desconectar();
            return $pregunta;
        }
    }
    
    // Método que añade una visita a una pregunta
    function addVistaPregunta($idquestion, $views)
    {
        $views      = $views + 1;
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $SQLstr    = "UPDATE questions SET views=? WHERE idquestion=?;";
            $resultado = $miConexion->conexiondb->prepare($SQLstr);
            $resultado->bind_param('ii', $views, $idquestion);
            $resultado->execute();
            if ($miConexion->conexiondb->affected_rows > 0) {
                return 1;
            } else {
                return 0;
            }
            $miConexion->desconectar();
        }
    }
    
    
    // Método insertar pregunta
    function addPregunta($questionI, $questiontextI, $idcategoryI, $idautorI, $viewsI)
    {
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $SQLstr    = "INSERT INTO questions VALUES (NULL,?,?,?,?,NOW(),?);";
            $resultado = $miConexion->conexiondb->prepare($SQLstr);
            $resultado->bind_param('ssiii', $questionI, $questiontextI, $idcategoryI, $idautorI, $viewsI);
            $resultado->execute();
            if ($miConexion->conexiondb->insert_id) {
                return $miConexion->conexiondb->insert_id;
            } else {
                return 0;
            }
            $miConexion->desconectar();
        }
    }
    
    // Método borrar pregunta
    function removePregunta($idquestionD)
    {
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $SQLstr    = "DELETE FROM questions WHERE idquestion=?";
            $resultado = $miConexion->conexiondb->prepare($SQLstr);
            $resultado->bind_param('s', $idquestionD);
            $resultado->execute();
            if ($miConexion->conexiondb->affected_rows > 0) {
                return 1;
            } else {
                return 0;
            }
            $miConexion->desconectar();
        }
    }
    // Método borrar las respuestas de una pregunta
    function removeRespuestasPregunta($idquestionD)
    {
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $SQLstr    = "DELETE FROM answers WHERE idquestion=?";
            $resultado = $miConexion->conexiondb->prepare($SQLstr);
            $resultado->bind_param('s', $idquestionD);
            $resultado->execute();
            if ($miConexion->conexiondb->affected_rows > 0) {
                return 1;
            } else {
                return 0;
            }
            $miConexion->desconectar();
        }
    }
    
    // Método borrar todas las preguntas de una categoria
    function removePreguntaCat($idcat)
    {
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $SQLstr    = "DELETE FROM questions WHERE idcategory=?;";
            $resultado = $miConexion->conexiondb->prepare($SQLstr);
            $resultado->bind_param('s', $idcat);
            $resultado->execute();
            if ($miConexion->conexiondb->affected_rows > 0) {
                return 1;
            } else {
                return 0;
            }
            $miConexion->desconectar();
        }
    }
    
    
    // Método editar pregunta
    function editPregunta($idquestionE, $questionE, $questiontextE)
    {
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $SQLstr    = "UPDATE questions SET question=?,questiontext=? WHERE idquestion=?;";
            $resultado = $miConexion->conexiondb->prepare($SQLstr);
            $resultado->bind_param('sss', $questionE, $questiontextE, $idquestionE);
            $resultado->execute();
            if ($miConexion->conexiondb->affected_rows > 0) {
                return 1;
            } else {
                return 0;
            }
            $miConexion->desconectar();
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    // Método Listar
    function listarPreguntas($limite, $idcategoria, $orden)
    {
        $query = "SELECT * FROM questions INNER JOIN categories ON questions.idcategory=categories.idcategory";
        if ($idcategoria != 0) {
            $query .= " WHERE questions.idcategory=" . $idcategoria;
        }
        if ($orden != "") {
            $query .= " ORDER BY " . $orden;
        }
        if ($limite != -1) {
            $query .= " LIMIT " . $limite;
        }
        $preguntas  = array();
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($fila = $resultado->fetch_assoc()) {
                $pregunta             = new preguntas;
                $pregunta->idquestion = $fila['idquestion'];
                $pregunta->question   = $fila['question'];
                $pregunta->idautor    = $fila['idautor'];
                $pregunta->idcategory = $fila['idcategory'];
                $pregunta->datetime   = $fila['datetime'];
                $pregunta->views      = $fila['views'];
                $pregunta->category   = $fila['name'];
                $preguntas[]          = $pregunta;
            }
            return $preguntas;
            $miConexion->desconectar();
        }
    }
    
    // Método Listar por usuario
    function listarPreguntasByUser($limite, $iduser)
    {
        $query = "SELECT * FROM questions";
        if ($iduser != 0) {
            $query .= " WHERE idautor=" . $iduser . " ORDER BY datetime ASC";
        }
        if ($limite != 0) {
            $query .= " LIMIT " . $limite;
        }
        $preguntas  = array();
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($fila = $resultado->fetch_assoc()) {
                $pregunta             = new preguntas;
                $pregunta->idquestion = $fila['idquestion'];
                $pregunta->question   = $fila['question'];
                $pregunta->idautor    = $fila['idautor'];
                $pregunta->idcategory = $fila['idcategory'];
                $pregunta->datetime   = $fila['datetime'];
                $pregunta->views      = $fila['views'];
                ;
                $preguntas[] = $pregunta;
            }
            return $preguntas;
            $miConexion->desconectar();
        }
    }
    
    // Método Listar por id
    function listarPreguntasById($idpregunta)
    {
        $query      = "SELECT * FROM questions INNER JOIN categories ON questions.idcategory=categories.idcategory WHERE idquestion=" . $idpregunta;
        $pregunta   = new preguntas;
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($fila = $resultado->fetch_assoc()) {
                $pregunta               = new preguntas;
                $pregunta->idquestion   = $fila['idquestion'];
                $pregunta->question     = $fila['question'];
                $pregunta->questiontext = $fila['questiontext'];
                $pregunta->idautor      = $fila['idautor'];
                $pregunta->idcategory   = $fila['idcategory'];
                $pregunta->category     = $fila['name'];
                $pregunta->datetime     = $fila['datetime'];
                $pregunta->views        = $fila['views'];
                ;
            }
            $miConexion->desconectar();
            return $pregunta;
        }
    }
    
    
    // Método Listar por texto
    function listarPreguntasByTexto($limite, $texto, $orden)
    {
        $query = "SELECT * FROM questions INNER JOIN categories ON questions.idcategory=categories.idcategory WHERE question LIKE '%" . $texto . "%'";
        if ($orden != "") {
            $query .= " ORDER BY " . $orden;
        }
        if ($limite != 0) {
            $query .= " LIMIT " . $limite;
        }
        $preguntas  = array();
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($fila = $resultado->fetch_assoc()) {
                $pregunta             = new preguntas;
                $pregunta->idquestion = $fila['idquestion'];
                $pregunta->question   = $fila['question'];
                $pregunta->idautor    = $fila['idautor'];
                $pregunta->idcategory = $fila['idcategory'];
                $pregunta->datetime   = $fila['datetime'];
                $pregunta->views      = $fila['views'];
                $pregunta->category   = $fila['name'];
                $preguntas[]          = $pregunta;
            }
            return $preguntas;
            $miConexion->desconectar();
        }
    }
    
    // Método Listar Total
    function listarPreguntasTotal($idcategoria)
    {
        $query = "SELECT COUNT(*) AS total FROM questions";
        if ($idcategoria != 0) {
            $query .= " WHERE questions.idcategory=" . $idcategoria;
        }
        $total      = 0;
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($fila = $resultado->fetch_assoc()) {
                $total = $fila['total'];
            }
            return $total;
            $miConexion->desconectar();
        }
    }
    
    // Método Listar Total Por TExto
    function listarPreguntasTotalByTexto($texto)
    {
        $query = "SELECT COUNT(*) AS total FROM questions WHERE question LIKE '%" . $texto . "%'";
        
        $total      = 0;
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($fila = $resultado->fetch_assoc()) {
                $total = $fila['total'];
            }
            return $total;
            $miConexion->desconectar();
        }
    }
    
    
    // Método Listar Ultimas Preguntas con respuesta
    function listarPreguntasUltimasRespuestas($limite, $idcategoria, $orden)
    {
        $query = "SELECT questions.idquestion, questions.question, questions.idautor, questions.idcategory, questions.datetime, questions.views,categories.name
FROM questions
INNER JOIN categories ON questions.idcategory = categories.idcategory
INNER JOIN answers ON questions.idquestion = answers.idquestion";
        if ($idcategoria != 0) {
            $query .= " WHERE questions.idcategory=" . $idcategoria;
        }
        $query .= " GROUP BY questions.idquestion";
        if ($orden != "") {
            $query .= " ORDER BY " . $orden;
        }
        if ($limite != -1) {
            $query .= " LIMIT " . $limite;
        }
        $preguntas  = array();
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($fila = $resultado->fetch_assoc()) {
                $pregunta             = new preguntas;
                $pregunta->idquestion = $fila['idquestion'];
                $pregunta->question   = $fila['question'];
                $pregunta->idautor    = $fila['idautor'];
                $pregunta->idcategory = $fila['idcategory'];
                $pregunta->datetime   = $fila['datetime'];
                $pregunta->views      = $fila['views'];
                $pregunta->category   = $fila['name'];
                $preguntas[]          = $pregunta;
            }
            return $preguntas;
            $miConexion->desconectar();
        }
    }
    
}

?>