<?php
// Clases requeridas
require_once 'claseconexion.php';

// Definición de la clase
class usuarios
{
    // Atributos
    var $iduser;
    var $nick;
    var $pass;
    var $mail;
    var $birthday;
    var $country;
    var $idpermission;
    var $avatar;
    
    // Obtiene el número de preguntas realizadas por el usuario
    function getPreguntasTotalUser($iduser)
    {
        $query = "SELECT COUNT(*) AS total FROM questions WHERE idautor=" . $iduser;
        
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
    
    // Obtiene el número de respuestas realizadas por el usuario
    function getRespuestasTotalUser($iduser)
    {
        $query = "SELECT COUNT(*) AS total FROM answers WHERE idautor=" . $iduser;
        
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
    
    
    // Método insertar usuario
    function addUsuario($nickI, $passI, $mailI, $birthdayI, $countryI, $idpermissionI, $avatarI)
    {
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $SQLstr    = "INSERT INTO users VALUES (NULL,?,?,?,?,?,?,?);";
            $resultado = $miConexion->conexiondb->prepare($SQLstr);
            $resultado->bind_param('sssssis', $nickI, $passI, $mailI, $birthdayI, $countryI, $idpermissionI, $avatarI);
            $resultado->execute();
            if ($miConexion->conexiondb->affected_rows > 0) {
                return 1;
            } else {
                return 0;
            }
            $miConexion->desconectar();
        }
    }
    
    // Método buscar por id del usuario
    function getUsuarioById($iduser)
    {
        $query      = "SELECT * FROM users WHERE iduser=" . $iduser;
        $user       = new usuarios;
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($filausr = $resultado->fetch_assoc()) {
                $user->iduser       = $filausr['iduser'];
                $user->nick         = $filausr['nick'];
                $user->pass         = $filausr['pass'];
                $user->mail         = $filausr['mail'];
                $user->birthday     = $filausr['birthday'];
                $user->country      = $filausr['country'];
                $user->idpermission = $filausr['idpermission'];
                $user->avatar       = $filausr['avatar'];
            }
            $miConexion->desconectar();
            return $user;
        }
    }
    
    // Método buscar por nick del usuario
    function getUsuarioByUser($user)
    {
        $query      = "SELECT * FROM users WHERE nick='" . $user . "'";
        $user       = new usuarios;
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($filausr = $resultado->fetch_assoc()) {
                $user->iduser       = $filausr['iduser'];
                $user->nick         = $filausr['nick'];
                $user->pass         = $filausr['pass'];
                $user->mail         = $filausr['mail'];
                $user->birthday     = $filausr['birthday'];
                $user->country      = $filausr['country'];
                $user->idpermission = $filausr['idpermission'];
                $user->avatar       = $filausr['avatar'];
            }
            $miConexion->desconectar();
            return $user;
        }
    }
    
    // Método listar usuarios
    function getUsuarios($limite)
    {
        $query = "SELECT * FROM users ORDER BY idpermission DESC, nick LIMIT " . $limite;
        
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($filausr = $resultado->fetch_assoc()) {
                $user               = new usuarios;
                $user->iduser       = $filausr['iduser'];
                $user->nick         = $filausr['nick'];
                $user->mail         = $filausr['mail'];
                $user->birthday     = $filausr['birthday'];
                $user->country      = $filausr['country'];
                $user->idpermission = $filausr['idpermission'];
                $user->avatar       = $filausr['avatar'];
                $usuarios[]         = $user;
            }
            $miConexion->desconectar();
            return $usuarios;
        }
    }
    
    // Método total usuarios
    function getUsersTotal()
    {
        $query      = "SELECT COUNT(*) AS total FROM users";
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
    
    // Método editar contraseña
    function editPass($iduserE, $passE)
    {
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $SQLstr    = "UPDATE users SET pass=? WHERE iduser=?;";
            $resultado = $miConexion->conexiondb->prepare($SQLstr);
            $resultado->bind_param('si', $passE, $iduserE);
            $resultado->execute();
            if ($miConexion->conexiondb->affected_rows > 0) {
                return 1;
            } else {
                return 0;
            }
            $miConexion->desconectar();
        }
    }
    
    // Método login
    function getLogin($user, $pass)
    {
        $query      = "SELECT * FROM users WHERE nick='" . $user . "' AND pass='" . $pass . "'";
        $user       = new usuarios;
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($filausr = $resultado->fetch_assoc()) {
                $user->iduser       = $filausr['iduser'];
                $user->nick         = $filausr['nick'];
                $user->pass         = $filausr['pass'];
                $user->mail         = $filausr['mail'];
                $user->birthday     = $filausr['birthday'];
                $user->country      = $filausr['country'];
                $user->idpermission = $filausr['idpermission'];
                $user->avatar       = $filausr['avatar'];
            }
            $miConexion->desconectar();
            return $user;
        }
    }
    
    // Método editar avatar
    function editAvatar($iduserE, $avatarE)
    {
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $SQLstr    = "UPDATE users SET avatar=? WHERE iduser=?";
            $resultado = $miConexion->conexiondb->prepare($SQLstr);
            $resultado->bind_param('ss', $avatarE, $iduserE);
            $resultado->execute();
            if ($miConexion->conexiondb->affected_rows > 0) {
                return 1;
            } else {
                return 0;
            }
            $miConexion->desconectar();
        }
    }
    
    // Método editar usuario
    function editUser($iduserE, $mailE, $birthdayE, $countryE, $idpermissionE)
    {
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $SQLstr    = "UPDATE users SET mail=?,birthday=?,country=?,idpermission=? WHERE iduser=?;";
            $resultado = $miConexion->conexiondb->prepare($SQLstr);
            $resultado->bind_param('sssis', $mailE, $birthdayE, $countryE, $idpermissionE, $iduserE);
            $resultado->execute();
            if ($miConexion->conexiondb->affected_rows > 0) {
                return 1;
            } else {
                return 0;
            }
            $miConexion->desconectar();
        }
    }
    
    // Método borrar usuario
    function removeUser($iduserD)
    {
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $SQLstr    = "DELETE FROM users WHERE iduser=?;";
            $resultado = $miConexion->conexiondb->prepare($SQLstr);
            $resultado->bind_param('s', $iduserD);
            $resultado->execute();
            if ($miConexion->conexiondb->affected_rows > 0) {
                return 1;
            } else {
                return 0;
            }
            $miConexion->desconectar();
        }
    }
    
    // Comprueba si hay un usuario con el mismo nombre
    function getCoincidenciaUser($usuario)
    {
        $miConexion = new conexion;
        // si la conexion fue satisfactoria
        if ($miConexion->conectar()) {
            $SQLstr    = "SELECT * FROM users WHERE nick='" . $usuario . "'";
            $resultado = $miConexion->conexiondb->query($SQLstr);
            if ($miConexion->conexiondb->affected_rows == 0) {
                // si el usuario existe retornamos falso
                return 0;
            } else {
                // si no verdadero
                $fila = $resultado->fetch_assoc();
                return $fila['nick'];
            }
        }
    }
    
    
    // Método buscar por nick
    function buscarUsuarioPorNick($nick)
    {
        $query = "SELECT * FROM users WHERE nick='" . $nick . "'";
        $usuarios;
        $miConexion = new conexion;
        if ($miConexion->conectar()) {
            $resultado = $miConexion->conexiondb->query($query);
            while ($filausr = $resultado->fetch_assoc()) {
                $user               = new usuarios;
                $user->iduser       = $filausr['iduser'];
                $user->nick         = $filausr['nick'];
                $user->mail         = $filausr['mail'];
                $user->birthday     = $filausr['birthday'];
                $user->country      = $filausr['country'];
                $user->idpermission = $filausr['idpermission'];
                $user->avatar       = $filausr['avatar'];
                $usuarios           = $user;
            }
            return $usuarios;
            $miConexion->desconectar();
        }
    }
}

?>