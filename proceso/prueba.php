<?php

switch($_GET["prueba"]){
  case "1":
    $nombre = $_POST["nombre"];
    echo "entro ".$nombre;
    break;
}