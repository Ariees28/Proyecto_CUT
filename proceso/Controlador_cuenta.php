<?php

session_start();
require_once "../modelos/Modelo_Cuenta.php";
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';


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

  case "grdDatosNombre":

    $id = $_SESSION["id"];
    $nombre = $_POST["nombre"];
    $res = $modelo->actDatosNombre($nombre, $id);

    if($res == true){
      $_SESSION["nombre"] = $nombre;
      echo "true";
    }else{
      echo "false";
    }
    break;

    case "grdDatosEmail":

      $id = $_SESSION["id"];
      $email = $_POST["email"];
      $res = $modelo->actDatosEmail($email, $id);
  
      if($res == true){
        $_SESSION["Correo"] = $email;
        $_SESSION["verificado"] = "0";
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

  case "verificar":
    $nombre = $_SESSION["nombre"];
    $correo = $_SESSION["Correo"];
    $id = $_SESSION["id"];
    $token = "";

    $datos = $modelo->traerTokenUs($id);
      while($res = $datos->fetchObject()){
      $token = $res->TokenUsuario;
    }
    $url = generarUrl("andromedabiblioteca.com/usuario/plantillas/verCor.php",$id, $token);

    $mail = new PHPMailer(true);

    try {
      $mail->SMTPDebug = 0;
      $mail->isSMTP();
      $mail->Host = "smtp.hostinger.com";
      $mail->SMTPAuth = true;
      $mail->Username = "verificaciondecuentas@andromedabiblioteca.com";
      $mail->Password = "VerificacionCuentas1!";
      $mail->SMTPSecure = "ssl";
      $mail->Port = 465;
      $mail->setFrom("verificaciondecuentas@andromedabiblioteca.com", "Verificar Email");
      $mail->addAddress($correo);
      $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
        );
  
      $mail->isHTML(true);
      $mail->Subject = "Verificacion de Email";
  
      $message = "<html><body>";
      $message .= "<h1>HOLA! $nombre</h1>";
      $message .= "<h2>Para verificar tu correo, da click <a href='$url'>AQUI</a></h2>";
      $message .= "<h3>o ingresa al siguiente enlace: $url</h3>";
      $message .= "</body></html>";
  
      $mail->Body = $message;
  
      $mail->send();
      echo "exito";
    } catch (Exception $e) {
      echo "error", $mail->ErrorInfo;
    }
    break;

  case "solContraNueva":
    $email = $_POST["email"];


    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
      if($res = $modelo->verificarEmail($email)->fetchObject()){
        $id = $res->id;
        $token = generarToken();
        $res = $modelo->solNvContra($id, $token);

        if($res){
          $url = generarUrl("andromedabiblioteca.com/usuario/plantillas/cambCont.php",$id, $token);
          $mail = new PHPMailer(true);

          try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = "smtp.hostinger.com";
            $mail->SMTPAuth = true;
            $mail->Username = "password-recovery@andromedabiblioteca.com";
            $mail->Password = "PasswordRec1!";
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;
            $mail->setFrom("password-recovery@andromedabiblioteca.com", "Recuperar Cuenta");
            $mail->addAddress($email);
            $mail->SMTPOptions = array(
              'ssl' => array(
              'verify_peer' => false,
              'verify_peer_name' => false,
              'allow_self_signed' => true
              )
              );
        
            $mail->isHTML(true);
            $mail->Subject = "Recuperacion de cuenta";
        
            $message = "<html><body>";
            $message .= "<h1>HOLA!</h1>";
            $message .= "<h2>Se ha solicitado un cambio de contrase&ntildea para esta cuenta</h2>";
            $message .= "<h3>Si tu no has solicitado el cambio de contrase&ntildea, cambiala ahora</h3>";
            $message .= "<h2>Si has sido tu quien solicit&oacute el cambio de contrase&ntildea, da click <a href='$url'>Aqu&iacute</a></h2>";
            $message .= "<p>o ingresa al siguiente enlace: $url</p>";
            $message .= "</body></html>";
        
            $mail->Body = $message;
        
            $mail->send();
            $msg = "exito";
          } catch (Exception $e) {
            $msg = "error " . $mail->ErrorInfo;
          }

          echo $msg;

        }else{
          echo "Error al solicitar recuperación";
        }
      }else{
        echo "email no encontrado";
      }
    }else{
      echo "email en formato incorrecto";
    }
    break;

  case "verCambCont":

    $id = $_POST["id"];
    $token = $_POST["token"];
    $tk = "";

    if($datos = $modelo->revCambCont($id, $token)->fetchObject()){
      echo "true";
    }else{
      echo "REGISTRO NO ENCONTRADO";
    }
    
    break;

  case "nvaContra":
    $contra = $_POST["contra"];
    $contra2 = $_POST["contra2"];
    $id = $_POST["id"];
    $token = $_POST["token"];

    if($contra != $contra2){
      echo "error";
      exit;
    }else{
      $clave = encriptar($contra);

      $res = $modelo->cambCont($id, $token, $clave);
      echo $res ? "exito" : "error";
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

function generarUrl($ruta, $id, $token){
  $url = "$ruta?op=$id&tk=$token";
  return $url;
}