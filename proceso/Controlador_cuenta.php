<?php

session_start();
require_once "../modelos/Modelo_Cuenta.php";

$modelo = new ModeloCuenta();


switch ($_GET["op"]) {
  case 'actPss':
    $id = $_SESSION["id"];
    $contra = $_POST["contra"];
    $contEnc = encriptar($contra);
    $res = $modelo->actPss($contEnc, $id);

    if($res == true){
      echo "true";
    }else{
      echo "false";
    }

    break;

  case "grdDatos":

    $id = $_SESSION["id"];
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];

    $res = $modelo->actDatos($nombre, $correo, $id);

    if($res == true){
      $_SESSION["nombre"] = $nombre;
      $_SESSION["Correo"] = $correo;
      echo "true";
    }else{
      echo "false";
    }
    break;

  case "verificarEmail":

    $email = $_POST["correo"];
    $datos = $modelo->verificarEmail($email);
    $id = "";

    while($res = $datos->fetchObject()){
      $id = $res->id;
    }
    if($id != ""){
      echo "error";
    }else{
      echo "true";
    }

    break;
}

function encriptar($clave)
{
    $options = ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3];
    $X = password_hash($clave, PASSWORD_ARGON2I, $options);
    return $X;
}