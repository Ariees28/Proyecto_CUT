<?php

class Conexion
{

    public static function conectar()
    {

        //$usuario = "u179151166_Ariees";
        //$contra = "ArieesAndrom2803";
        //u179151166_biblioteca
        $usuario = "root";
        $contra = "";


        $conn = new PDO("mysql:host=localhost;dbname=biblioteca", $usuario, $contra);
            //PHP DATA OBJECT
        return $conn;
    }
}