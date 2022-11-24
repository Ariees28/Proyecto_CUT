<?php

require_once "../modelos/Modelo_escritorio.php";

$modelo = new ModeloEscritorio();

switch ($_GET["op"]) {

  case "frases":
    $id = $_POST["id"];
    $respuesta = array();
    $datosFrase = $modelo->frases($id);
    while($r = $datosFrase->fetchObject()){
      $respuesta[] = array(
        "0" => $r->frase,
        "1" => $r->fuente
      );
    }
    
    echo json_encode($respuesta);
}