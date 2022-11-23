<?php

require_once "../modelos/Modelo_busqueda.php";

$modelo = new ModeloBusqueda();
session_start();

switch ($_GET["op"]) {
  case "generos":
    $generos = $modelo->generos();
    $arr = array();

    while($reg = $generos->fetchObject()){
      $arr[] = array(
        "0" => $reg->genero
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

  case "listadoLibrosGenero":
    $genero = $_POST["genero"];
    $libros = $modelo->librosGenero($genero);
    $cad = "";
    $cad2 = "";
    $cont = "";
    $arr = array();

    while($reg = $libros->fetchObject()){
      $cont = $reg->id_libro;
      $cad .= 
      "
      <div class='col-lg-2 col-md-3 col-sm-6 mb-4'>
        <div class='card'>
          <div class='card-body'>
            <img src='../../files/portadas/$reg->Portada' class='card-img-top' style='border-radius: 10px' height='300'>
            <br><br>
            <h4 class='text-primary overflow-ellipsis'>$reg->Titulo</h4>
            <h6 class='overflow-ellipsis'>$reg->Autor</h6>
            <h6 class='overflow-ellipsis'>$reg->Editorial</h6><br>
            <input type='button' class='mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-info' value='Información' id='$reg->id_libro' onclick='info(this)'>
          </div>
        </div>
      </div>
      ";
    }

    $desc = $modelo->descGen($genero);

    while($reg = $desc->fetchObject()){
      $cad2 = "
        <p>$reg->descripcion</p>
      ";
    }

    if($cont != ""){
      $results = array(
        "lib" => $cad,
        "desc" => $cad2
      );

      echo json_encode($results);
      

    }else{
      $cad = "
        <div class='card mb-4' style='align-items: center; text-align: center'>
          <div class='col-md-4'>
            <h3 class='text-primary'>Lo sentimos, tu busqueda no retornó resultados :(</h3>
          </div>
        </div>";
        
        
        $results = array(
          "lib" => $cad,
          "desc" => $cad2
        );
  
        echo json_encode($results);
    }
    break;

  case "listadoLibrosBusqueda":
    $libro = $_POST["libro"];
    $libros = $modelo->librosBusqueda($libro);
    $cad = "";
    $cont = "";

    while($reg = $libros->fetchObject()){
      $cont = $reg->id_libro;
      $cad .= 
      "
      <div class='col-lg-2 col-md-2 col-sm-6 mb-4'>
        <div class='card'>
          <div class='card-body'>
            <img src='../../files/portadas/$reg->Portada' class='card-img-top' style='border-radius: 10px' height='300'>
            <br><br>
            <h4 class='text-primary overflow-ellipsis'>$reg->Titulo</h4>
            <h6 class='overflow-ellipsis'>$reg->Autor</h6>
            <h6 class='overflow-ellipsis'>$reg->Editorial</h6><br>
            <input type='button' class='mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-info' value='Información' id='$reg->id_libro' onclick='info(this)'>
          </div>
        </div>
      </div>
      ";
    }
    if($cont != ""){
      echo $cad;
    }else{
      $cad = "
        <div class='card mb-4' style='align-items: center; text-align: center'>
          <div class='col-md-4'>
            <h3 class='text-primary'>Lo sentimos, tu busqueda no retornó resultados :(</h3>
          </div>
        </div>";
        echo $cad;
    }
    break;

  case "infoCompl":
    $id = $_POST["id"];
    $info = $modelo->infoCompleta($id);
    $cad = "";

    while($reg = $info->fetchObject()){
      $cad .= "
        <div class='card'>
          <div class='card-body row'>
            <div class='col-lg-4 col-md-4 col-sm-4 mb-4'>
              <img src='../../files/portadas/$reg->Portada' class='card-img-top' style='border-radius: 10px' height='600'>
            </div>
            <div class='col-lg-8 col-md-8 col-sm-8 mb-4 row'>
              <h1 class='text-primary'>$reg->Titulo</h1>
              <br><br>
              <h4><label style='font-weight: 600'>AUTOR:</label> $reg->Autor</h4>
              <h4><label style='font-weight: 600'>EDITORIAL:</label> $reg->Editorial</h4>
              <h5><label style='font-weight: 600'>ISBN:</label> $reg->ISBN</h5>
              <hr>
              <h4 style='font-weight: 600'>SIPNOSIS:</h4>
              <h5>$reg->sipnosis</h5>
              <div class='divider'></div>
              <h4 style='font-weight: 600'>INFORMACIÓN ADICIONAL:</h4>
              <br><br>
              <div class='col-lg-4 col-md-4 col-sm-4 mb-4'>
                <h6><label style='font-weight: 600'>IDIOMA:</label> $reg->Idioma</h6>
              </div>
              <div class='col-lg-4 col-md-4 col-sm-4 mb-4'>
                <h6><label style='font-weight: 600'>PAGINAS:</label> $reg->Paginas</h6>
              </div>
              <div class='col-lg-4 col-md-4 col-sm-4 mb-4'>
                <h6><label style='font-weight: 600'>AÑO DE PUBLICACIÓN:</label> $reg->Fecha</h6>
              </div>";

      if($_SESSION["verificado"] == "1"){
        if($reg->prestados < ($reg->Ejemplares - 3)){
          $cad .= "
                <button class='mb-2 mr-2 btn-hover-shine btn btn-success' id='$reg->id_libro' onclick='solicitarPrestamo(this)'>SOLICITAR PRESTAMO</button>
              </div>
            </div>
          </div>
          ";
        }else{
          $cad .= "
                <button disabled class='mb-2 mr-2 btn btn-success disabled'>SOLICITAR PRESTAMO</button>
                <h4>Libro no disponible para prestamo</h4>
              </div>
            </div>
          </div>
          ";
        }
      }else{
        $cad .= "
                <button disabled class='mb-2 mr-2 btn btn-success disabled'>SOLICITAR PRESTAMO</button>
                <h4>Libro no disponible para prestamo(verifica tu correo electronico)</h4>
              </div>
            </div>
          </div>
          ";
      }

      
    }

    echo $cad;
    break;

  case "generosList":

    $gen = $modelo->generos();
    $cad = "";

    while($reg = $gen->fetchObject()){
      $cad .= 
      "
      <div class='col-lg-4 col-md-4 col-sm-6 mb-4'>
        <div class='card'>
          <div class='card-body'>
            <img src='../../files/generos/$reg->imagen' class='card-img-top' style='border-radius: 10px'>
            <br><br>
            <h4 class='text-primary overflow-ellipsis'>$reg->genero</h4>
            <input type='button' class='mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-info' value='Información' id='$reg->genero' onclick='buscGenList(this)'>
          </div>
        </div>
      </div>
      ";
    }

    echo $cad;
    break;

}