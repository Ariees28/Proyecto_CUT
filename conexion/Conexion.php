<?php

class Conexion
{

    public static function conectar()
    {

        $usuario = "root";
        $contra = "";


        $conn = new PDO("mysql:host=localhost;dbname=biblioteca", $usuario, $contra);

        return $conn;
    }
}