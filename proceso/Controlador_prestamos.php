<?php

require_once "../modelos/Modelo_prestamos.php";

$modelo = new ModeloPrestamos();

session_start();

switch ($_GET["op"]) {
  
  case 'infLib':

    $id = $_POST["id"];

    $info = $modelo->infoCompleta($id);
    $cad = "";
    $month = date('m');
    $day = date('d');
    $year = date('Y');
    $res = array();

    while($reg = $info->fetchObject()){
      $genero = $reg->Genero;
      $id = $reg->id_libro;
      $today = $year . '-' . $month . '-' . $day;
      $libTotal = $reg->Ejemplares;
      $prestados = $reg->prestados;
      $disponibles = ($libTotal - 3) - $prestados;
      
      $cad .= "
        <div class='card'>
          <div class='card-body row'>
            <div class='col-lg-4 col-md-4 col-sm-4 mb-4'>
              <img src='../../files/portadas/$reg->Portada' class='card-img-top' style='border-radius: 10px'>
            </div>
            <div class='col-lg-8 col-md-8 col-sm-8 mb-4 row'>
              <h1 class='text-primary'>$reg->Titulo</h1>
              <div class='col-lg-6 col-md-6 col-sm-6'>
                <label>DISPONIBLES: $disponibles</label><br>
                <label>FECHA DE RECOGIDA</label>
                <input type='date' class='form-control' id='fechaR' min='$today'>
              </div>
              <div class='col-lg-6 col-md-6 col-sm-6'></div>
              <div class='col-lg-6 col-md-6 col-sm-6'>
                <label>FECHA DE ENTREGA</label>
                <h3 id='fechaE' class='text-success'></h3>
              </div>
            </div>
            <div class='col-lg-4 col-md-4 col-sm-4 mb-4'></div>
            <div class='col-lg-4 col-md-4 col-sm-4 mb-4'>
              <button id='solicitar' class='btn-wide mb-2 mr-2 btn btn-hover-shine btn btn-success btn-lg' onclick='solicitar()'>SOLICITAR PRESTAMO</button>
            </div>
          </div>
        </div>
        ";
    }

    $tipoRespuesta = $modelo->tipoPrestamo($genero)->fetchObject();
    $tipo = $tipoRespuesta->tipoPrestamos;

    $res[] = array(
      "0" => $cad,
      "1" => $tipo,
      "2" => $id
    );

    echo json_encode($res);
    break;

  case "solicitar":

    $idLibro = $_POST["idLibro"];
    $fechaS = $_POST["fechaS"];
    $fechaE = $_POST["fechaE"]; 
    $idSolicitante = $_SESSION["id"];

    if($modelo->prestamo($idSolicitante, $idLibro, $fechaS, $fechaE)){
      $modelo->sumarPrestamo($idLibro);
      echo "SOLICITUD REALIZADA";
    }else{
      echo "OCURRIÓ UN ERROR";
    }
    break;

  case "numPrestamos":

    $idUs = $_SESSION["id"];
    $num = array();
    $return = array();
    $datos = $modelo->listadoPrestamosAct($idUs);

    while($res = $datos->fetchObject()){
      $num[] = array(
        "0" => $res->entregado
      );
    }

    if(count($num)>= 3){
      $cad = "
        <div class='card' style='align-items: center; text-align: center'>
          <div class='card-body row'>
            <h1 class='text-warning'>No puedes tener más de 3 solicitudes de prestamo activas</h1>
          </div>
        </div>
        ";
      $return[] = array(
        "0" => "false",
        "1" => $cad
      );
      echo json_encode($return);
    }else{
      $return[] = array(
        "0" => "true"
      );
      echo json_encode($return);
    }

    break;

}