<?php

class Conexion
{

    public static function conectar()
    {
        // $usuario = "sridpec1_TalamantesArma";
        // $contra = "O)Vm9QapxBJk";
        $usuario = "root";
        $contra = "";


        $conn = new PDO("mysql:host=localhost;dbname=Armamento", $usuario, $contra);

        return $conn;
    }
}