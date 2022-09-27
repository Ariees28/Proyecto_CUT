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

} // fin de la clase