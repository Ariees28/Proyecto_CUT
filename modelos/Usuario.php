<?php
//incluir la conexion de base de datos
require "../conexion/Conexion.php";
class Usuario
{

    private $db;

    //implementamos nuestro constructor
    public function __construct()
    {
        $this->db = Conexion::conectar();
    }

    public function verificar($login)
    {

        $sql = $this->db->query("SELECT * FROM usuario WHERE Login='$login'");
        return $sql;
    } // fin de verificar

    public function permiso($id)
    {

        $sql = $this->db->query("SELECT IdMenu FROM privilegio WHERE UsuarioPer='$id'");
        return $sql;
    } // fin de verificar

    public function registrados()
    {
        $sql = $this->db->query("SELECT MAX(id) as id FROM usuario");
        return $sql;
    } // fin de registrados

    public function listar()
    {
        $sql = $this->db->query("SELECT id, Login, nombre, fotoUser, StatusUser FROM usuario WHERE StatusUser IN (1,0)");
        return $sql;
    } // fin de listar

    public function mostrar($id)
    {
        $sql = $this->db->query("SELECT * FROM usuario WHERE id='$id'");
        return $sql;
    } // fin de mostrar

    public function nuevo($nomUser, $DomUse, $TelUse, $telcel, $sexuser, $puestouser, $Gradouser, $AdsUser, $user, $pass, $foto, $correo)
    {

        $sql = $this->db->prepare("INSERT INTO usuario (Login,clave,nombre,DomicilioUser,TelOfiUser,TelCelUser,CorEleUser,sexoUser,PuestoUser,GradoUser,AdscripcionUser,fotoUser) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        try {
            $sql->execute([$user, $pass, $nomUser, $DomUse, $TelUse, $telcel, $correo, $sexuser, $puestouser, $Gradouser, $AdsUser, $foto]);
            return true;
        } catch (Exception $e) {
            return false;
        }

    }
    public function editado($nomUser, $DomUse, $TelUse, $telcel, $sexuser, $puestouser, $Gradouser, $AdsUser, $imagen, $correo, $id, $pass, $login)
    {

        $sql = $this->db->prepare("UPDATE usuario SET nombre=?, DomicilioUser=?, TelOfiUser=?, TelCelUser=?, sexoUser=?, PuestoUser=?,
                                                        GradoUser=?, AdscripcionUser=?, fotoUser=?, CorEleUser=?, clave=?, Login=? WHERE id=?");
        try {
            $sql->execute([$nomUser, $DomUse, $TelUse, $telcel, $sexuser, $puestouser, $Gradouser, $AdsUser, $imagen, $correo, $pass, $login, $id]);
            return true;
        } catch (Exception $e) {
            return false;
        }

    }

    public function privilegios($id, $priv)
    {

        $sql = $this->db->prepare("INSERT INTO privilegio (UsuarioPer,IdMenu) VALUES (?,?)");
        try {
            foreach ($priv as $valor) {
                $sql->execute([$id, $valor]);
            }
            return true;
        } catch (Exception $e) {
            return false;
        }

    }
} // fin de la clase