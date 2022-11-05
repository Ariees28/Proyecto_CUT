<?php

require_once "../modelos/Modelo_prestamos.php";

$modelo = new ModeloPrestamos();

switch ($_GET["op"]) {
  
  case 'infLib':

    $id = $_POST["id"];

    $info = $modelo->infoCompleta($id);
    $cad = "";
    $month = date('m');
    $day = date('d');
    $year = date('Y');

    


    while($reg = $info->fetchObject()){
      $genero = $reg->Genero;

      // if($genero == "Literatura y Novelas"){
      //   if($month == 12){
      //     $month = 1;
      //   }else{
      //     $month++;
      //   }

      //   $today = $year . '-' . $month . '-' . $day;
      // }
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
              <input type='hidden' value='$genero' id='genero'>
              <h1 class='text-primary'>$reg->Titulo</h1>
              <div class='col-lg-4 col-md-4 col-sm-4'>
                <label>DISPONIBLES: $disponibles</label>
                <label>FECHA DE RECOGIDA</label>
                <input type='date' class='form-control' id='fechaR' min='$today'>
                <label>FECHA DE ENTREGA</label>
                <input type='date' class='form-control' disabled id='fechaE'>
              </div>
            </div>
          </div>
        </div>
        ";
    }

    echo $cad;
    break;

}