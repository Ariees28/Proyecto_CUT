<?php

require_once "../modelos/Modelo_NuevoUsuario.php";

$modelo = new ModeloNuevoUsuario();

switch ($_GET["op"]) {
  case 'NuevoLector':
    $login = $_POST["user"];
    $clave = $_POST["contra"];
    $nombre = $_POST["nombre"];
    $correo = $_POST["email"];
    $privilegio = "Lector";
    $usCheck = "";

    $r = $modelo->revisarUs($login);
    while($reg = $r->fetchObject()){
      $usCheck = $reg->Login;
    }

    if($usCheck == ""){
      $clave = encriptar($clave);
      $token = generarToken();
      $res = $modelo->nuevo($login, $clave, $nombre, $correo, $privilegio, $token);

      if($res == true){
        echo "exito";
      }else{
        echo $e;
      }
    }else{
      echo "0";
    }
    
    break;

  case "NuevoUser":

    $login = $_POST["user"];
    $clave = $_POST["contra"];
    $nombre = $_POST["nombre"];
    $correo = $_POST["email"];
    $privilegio = $_POST["tipo"];
    $usCheck = "";

    $r = $modelo->revisarUs($login);
    while($reg = $r->fetchObject()){
      $usCheck = $reg->Login;
    }

    if($usCheck == ""){
      $clave = encriptar($clave);
      $token = generarToken();
      $res = $modelo->nuevo($login, $clave, $nombre, $correo, $privilegio, $token);

      if($res == true){
        echo "exito";
      }else{
        echo $e;
      }
    }else{
      echo "0";
    }

    break;

  case "usuarios":

    $usuarios = $modelo->usuarios();
    $arr = array();
    
    while($reg = $usuarios->fetchObject()){
      $arr[] = array(
        "0" => $reg->Login,
        "1" => $reg->nombre,
        "2" => $reg->Correo,
        "3" => $reg->Privilegio,
        "4" => $reg->id
      );
    }

    $results = array(
      "sEcho" => 1,
      "iTotalRecords" => count($arr),
      "iTotalDisplayRecords" => count($arr),
      "aaData" => $arr
    );
    echo json_encode($results);
    break;

  case "editar":
    $id = $_POST["id"];
    $res = $modelo->datUsEdit($id);
    $arr = array();

    while($reg = $res->fetchObject()){
      $arr[] = array(
        "0" => $reg->Correo,
        "1" => $reg->nombre,
        "2" => $reg->Privilegio,
      );
    }

    echo json_encode($arr);
    break;

  case "editarUs":
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $privilegio = $_POST["privilegio"];

    $res = $modelo->editar($nombre, $correo, $privilegio, $id);

    if($res == true){
      echo "exito";
    }else{
      echo "hubo un error";
    }
    break;

  case "nuevaContra":
    $id = $_POST["id"];
    $contra = $_POST["contra"];

    $contra = encriptar($contra);

    $res = $modelo->editarContra($id, $contra);

    if($res == true){
      echo "true";
    }else{
      echo "falso";
    }
    break;
}


function encriptar($clave)
{
    $options = ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3];
    $X = password_hash($clave, PASSWORD_ARGON2I, $options);
    return $X;
}
function generarToken(){
  $gen = md5(uniqid(mt_rand(), false));
  return $gen;
}