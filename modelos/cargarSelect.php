<?php
//incluir la conexion de base de datos
require "../conexion/Conexion.php";
class CargarSelect
{

    private $db;

    //implementamos nuestro constructor
    public function __construct()
    {
        $this->db = Conexion::conectar();
    }

    public function privilegiosMenu()
    {
        $sql = $this->db->query("SELECT Idmenu, NomMenu FROM menu ORDER BY Idmenu"); // obtener el menu
        return $sql;
    } // fin de menu

} // fin de la clase