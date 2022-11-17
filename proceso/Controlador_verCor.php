<?php

require_once "../modelos/Modelo_verCor.php";

$modelo = new ModeloVerCor();

switch ($_GET["op"]) {
  case 'verCor':
    $id = $_POST["id"];
    $token = $_POST["token"];

    $datos = $modelo->validarToken($id, $token);
    $campo = "";
    
    while($res = $datos->fetchObject()){
      $campo = $res->verificado;
    }

    if($campo != ""){
      if($campo == 1){
        $msg = "La cuenta ya ha sido activada anteriormente";
      }else{
        if($modelo->valCorreo($id)){
          $msg = "Correo Validado!";
        }else{
          $msg = "Error al validar, notifique al administrador";
        }
      }
    }else{
      $msg = "No existe registro";
    }

    echo $msg;
    break;
  
}