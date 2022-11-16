<?php

//$usuario = "u179151166_Ariees";
//$contra = "ArieesAndrom2803";
//u179151166_biblioteca
$usuario = "root";
$contra = "";
$conn = new PDO("mysql:host=localhost;dbname=biblioteca", $usuario, $contra);


function validarToken($id, $token)
  {
    global $conn;
    $sql = $conn->query("SELECT verificado FROM usuario WHERE id = '$id' and TokenUsuario = '$token' LIMIT 1;");
    $campo = "";
    
    while($res = $sql->fetchObject()){
      $campo = $res->verificado;
    }
    
    if($campo != ""){
      if($campo == 1){
        $msg = "La cuenta ya ha sido activada anteriormente";
      }else{
        if(valCorreo($id)){
          $msg = "Correo Validado!";
        }else{
          $msg = "Error al validar, notifique al administrador";
        }
      }
    }else{
      $msg = "No existe registro";
    }

    return $msg;
  }

function valCorreo($id){
  global $conn;
  $sql = $conn->prepare("UPDATE usuario SET verificado = 1 WHERE id = '$id'");
  $res = $sql->execute();
  return $res;
}
