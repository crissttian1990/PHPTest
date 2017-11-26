<?php
// Clases requeridas
require_once 'claseconexion.php';

// Definición de la clase
class categorias
{
    // Atributos
    var $idcategory;
    var $name;
    var $total;
    var $description;
    
    //Método mostrar todas las categorias sin el número total de preguntas
    function getCategoriasSn()
    {
        $query      = "SELECT * FROM categories";
        $categorias = array();
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($filacat = $resultado->fetch_assoc()) {
                $categ             = new categorias;
                $categ->idcategory = $filacat['idcategory'];
                $categ->name       = $filacat['name'];
                $categorias[]      = $categ;
            }
            $miConexion->desconectar();
            return $categorias;
        }
    }
    
    //Método mostrar todas las categorias
    function getCategorias()
    {
        $query      = "select categories.idcategory, categories.name, COUNT(categories.idcategory) as total from categories INNER JOIN questions ON categories.idcategory=questions.idcategory GROUP BY categories.idcategory";
        $categorias = array();
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($filacat = $resultado->fetch_assoc()) {
                $categ             = new categorias;
                $categ->idcategory = $filacat['idcategory'];
                $categ->name       = $filacat['name'];
                $categ->total      = $filacat['total'];
                $categorias[]      = $categ;
            }
            $miConexion->desconectar();
            return $categorias;
        }
    }
    
    // Método Listar una categoría
    function getCategoria($id)
    {
        $query      = "SELECT * FROM categories WHERE idcategory=" . $id;
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            $categoria = new categorias;
            while ($filacat = $resultado->fetch_assoc()) {
                $categoria->idcategory  = $filacat['idcategory'];
                $categoria->name        = $filacat['name'];
                $categoria->description = $filacat['description'];
            }
            $miConexion->desconectar();
            return $categoria;
        }
    }
    
    
    // Método insertar una nueva categoría
    function addCategoria($nameI, $descI)
    {
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $SQLstr    = "INSERT INTO categories VALUES (NULL,?,?);";
            $resultado = $miConexion->conexiondb->prepare($SQLstr);
            $resultado->bind_param('ss', $nameI, $descI);
            $resultado->execute();
            if ($miConexion->conexiondb->affected_rows > 0) {
                return 1;
            } else {
                return 0;
            }
            $miConexion->desconectar();
        }
    }
    
    // Método borrar categoría
    function removeCategoria($idcategoryD)
    {
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $SQLstr    = "DELETE FROM categories WHERE idcategory=? ";
            $resultado = $miConexion->conexiondb->prepare($SQLstr);
            $resultado->bind_param('s', $idcategoryD);
            $resultado->execute();
            if ($miConexion->conexiondb->affected_rows > 0) {
                return 1;
            } else {
                return 0;
            }
            $miConexion->desconectar();
        }
    }
    // Método borrar las preguntas pertenecientes a una categoría
    function removePreguntasCategoria($idcategoryD)
    {
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $SQLstr    = "DELETE FROM questions WHERE idcategory=? ";
            $resultado = $miConexion->conexiondb->prepare($SQLstr);
            $resultado->bind_param('s', $idcategoryD);
            $resultado->execute();
            if ($miConexion->conexiondb->affected_rows > 0) {
                return 1;
            } else {
                return 0;
            }
            $miConexion->desconectar();
        }
    }
    
    // Método editar categoría
    function editCategoria($idcategoryE, $nameE, $descE)
    {
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $SQLstr    = "UPDATE categories SET name=?, description=? WHERE idcategory=?;";
            $resultado = $miConexion->conexiondb->prepare($SQLstr);
            $resultado->bind_param('sss', $nameE, $descE, $idcategoryE);
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