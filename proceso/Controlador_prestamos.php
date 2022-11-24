<?php

require_once "../modelos/Modelo_prestamos.php";
require_once "../modelos/Modelo_busqueda.php";

$modelo = new ModeloPrestamos();
$modeloB = new ModeloBusqueda();

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
              <img src='../../files/portadas/$reg->Portada' class='card-img-top' style='border-radius: 10px' height='600'>
            </div>
            <div class='col-lg-8 col-md-8 col-sm-8 mb-4 row'>
              <h1 class='text-primary'>$reg->Titulo</h1>
              <div class='card'>
                <div class='card-body'>
                  <h2>Te recordamos que los libros de carácter literario se prestan hasta un máximo de 30 días, Mientras que los de estudio tienen un prestamo de 3 días.</h2>
                </div>
              </div>
              <div class='col-lg-6 col-md-6 col-sm-6 mt-3'>
                <label>DISPONIBLES: $disponibles</label><br>
                <h3>FECHA DE RECOGIDA</label>
                <input id='fechaR'  placeholder='DD/MM/AAAA' data-input/>
              </div>
              <div class='col-lg-6 col-md-6 col-sm-6'></div>
              <div class='col-lg-6 col-md-6 col-sm-6'>
                <h3>FECHA DE ENTREGA</h3>
                <h2 id='fechaE' class='text-success'></h2>
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
    $res = array();

    $n = $modelo->ultNumSeg();
    $num = $n->fetchObject()->numSeguim;
    $num ++;

    if($modelo->prestamo($idSolicitante, $idLibro, $fechaS, $fechaE, $num)){
      $modelo->sumarPrestamo($idLibro);
      $res[] = array(
        "0" => "SOLICITUD REALIZADA CON EXITO",
        "1" => $num
      );
      echo json_encode($res);
    }else{
      $res[] = array(
        "0" => "OCURRIO UN ERROR",
        "1" => "Verificar"
      );
      echo json_encode($res);
    }
    break;


  case "revPres":
    $idU = $_POST["idU"];
    $idL = $_POST["idL"];
    $num = array();

    $datos = $modelo->conLibPres($idL, $idU);
    while($res = $datos->fetchObject()){
      $num[] = array(
        "0" => $res->entregado
      );
    }

    if(count($num)>= 1){
      echo "false";
    }else{
      echo "true";
    }
    
    break;
  
  case "numPrestadosEmp":
    $idUs = $_POST["id"];
    $num = array();
    $datos = $modelo->listadoPrestamosAct($idUs);

    while($res = $datos->fetchObject()){
      $num[] = array(
        "0" => $res->entregado
      );
    }

    if(count($num)>= 3){
      echo "false";
    }else{
      echo "true";
    }
    break;

  case "numPrestamos":

    $idUs = $_SESSION["id"];
    $idLibro = $_POST["id"];
    $num = array();
    $num2 = array();
    $return = array();
    $datos = $modelo->listadoPrestamosAct($idUs);

    while($res = $datos->fetchObject()){
      $num[] = array(
        "0" => $res->entregado
      );
    }

    if(count($num)>= 3){
      $cad = "
        <div class='card' style='align-items: center; text-align: center'
        >
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

      $datos = $modelo->conLibPres($idLibro, $idUs);
      while($res = $datos->fetchObject()){
        $num2[] = array(
          "0" => $res->entregado
        );
      }
      if(count($num2)>= 1){
        $cad = "
        <div class='card' style='align-items: center; text-align: center'
        >
          <div class='card-body row'>
            <h1 class='text-warning'>No puedes el solicitar el prestamo del mismo libro más de una vez</h1>
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
      
    }

    break;

  case "listPrestUsuario":

    $idUs = $_SESSION["id"];
    $res = $modelo->listPrestUs($idUs);
    $cad = "";

    if($res->rowCount() < 1){
      echo "
      <div class='card-group mt-4 col-md-7 mb-4'>
      <div class='card'>
        <img src='../../files/portadas/Portada_Generica.png' class='card-img-top' style='border-radius: 10px'>
      </div>
      <div class='card'>
        <div class='card-body'>
          <h1>NO HAS SOLICITADO NINGUN PRESTAMO</h1>
          <p style='font-size: 15px;'>Puedes solicitar el prestamo de un libro desde el modulo de consulta de libros(es necesario que hayas verificado tu cuenta de correo electronico con anterioridad)</p>
        </div>
      </div>
    </div>
    <div class='card-group mt-4 col-md-5 mb-4'></div>
      ";
    }else{
      while($r = $res->fetchObject()){
        //obtenemos el id del libro
        $id = $r->id_libro;
        //buscamos la info del libro
        $info = $modeloB->infoCompleta($id);
        $infoB = $info->fetchObject();
        //obtenemos la info y la guardamos en variables
        $img = $infoB->Portada;
        $titulo = $infoB->Titulo;
        $autor = $infoB->Autor;
        $isbn = $infoB->ISBN;
        //Ahora guardamos los datos del prestamo
        $fechaSoli = $r->fecha_solicitud;
        $fechaEnt = $r->fecha_entrega;
        $st = $r->entregado;
        //Obtemenos la fecha actual para comparar
        $fechaActual = date('Y-m-d');
        if($st == "0"){
          if($fechaActual>$fechaEnt){
            $st = "<h5 class='text-danger'>FECHA DE ENTREGA EXCEDIDA</h5>";
          }else{
            $st = "<h5 class='text-warning'>NO ENTREGADO</h5><p>Aun estás a tiempo</p>";
          }
        }else{
          $st = "<h5 class='text-success'>ENTREGADO</h5>";
        }
        //concatenamos el div con la información
        $cad .= "
        <div class='card-group mt-4 col-md-7 mb-4'>
        <div class='card'>
          <img src='../../files/portadas/$img' class='card-img-top' style='border-radius: 10px'>
        </div>
        <div class='card'>
          <div class='card-body'>
            <h1>$titulo</h1>
            <h4>AUTOR:</h4>
            <p style='font-size: 15px;'>$autor</p>
            <h4>ISBN:</h4>
            <p style='font-size: 15px;'>$isbn</p>
            <h4>FECHA SOLICITUD:</h4>
            <p style='font-size: 15px;'>$fechaSoli</p>
            <h4>FECHA ENTREGA:</h4>
            <p style='font-size: 15px;'>$fechaEnt</p>
            <h4>STATUS:</h4>
            $st
          </div>
        </div>
      </div>
      <div class='card-group mt-4 col-md-5 mb-4'></div>
        ";
      }
      echo $cad;
    }

    break;

  case "usuarios":

    $usuarios = $modelo->usuarios();
    $arr = array();
    
    while($reg = $usuarios->fetchObject()){
      $arr[] = array(
        "0" => $reg->id,
        "1" => $reg->Login,
        "2" => $reg->nombre,
        "3" => $reg->Correo,
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

  case "libros":
      $libros = $modelo->libros();
      $arr = array();
      
      while($reg = $libros->fetchObject()){
        $arr[] = array(
          "0" => $reg->Titulo,
          "1" => $reg->Autor,
          "2" => $reg->ISBN,
          "3" => $reg->Genero,
          "4" => $reg->Ejemplares,
          "5" => $reg->prestados,
          "6" => $reg->id_libro
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

  case "tipoP":
    $genero = $_POST["genero"];
    $dato = $modelo->tipoP($genero);
    $res = $dato->fetchObject();
    echo $res->tipoPrestamos;
    break;

    
  case "solicitarEmp":

    $idLibro = $_POST["idLibro"];
    $fechaS = $_POST["fechaS"];
    $fechaE = $_POST["fechaE"]; 
    $idSolicitante = $_POST["id"];
    $res = array();

    $n = $modelo->ultNumSeg();
    $num = $n->fetchObject()->numSeguim;
    $num ++;

    if($modelo->prestamo($idSolicitante, $idLibro, $fechaS, $fechaE, $num)){
      $modelo->sumarPrestamo($idLibro);
      $res[] = array(
        "0" => "SOLICITUD REALIZADA CON EXITO",
        "1" => $num
      );
      echo json_encode($res);
    }else{
      $res[] = array(
        "0" => "OCURRIO UN ERROR",
        "1" => "Verificar"
      );
      echo json_encode($res);
    }
    break;

  case "prestamosUs":
    $id = $_POST["id"];
    $datos = $modelo->listadoPrestamosAct($id);
    $respuesta = array();

    while($r = $datos->fetchObject()){
      $respuesta[] = array(
        "0" => $r->NumSeguim,
        "1" => $r->id_libro,
        "2" => $r->fecha_solicitud,
        "3" => $r->fecha_entrega
      );
    }
    $results = array(
      "sEcho" => 1,
      "iTotalRecords" => count($respuesta),
      "iTotalDisplayRecords" => count($respuesta),
      "aaData" => $respuesta
    );
    echo json_encode($results);
    break;

  case "retornarLib":
    $idL = $_POST["idL"];
    $idU = $_POST["idU"];

    if($modelo->retornarLib($idL,$idU)){
      if($modelo->restarPrest($idL)){
        echo "true";
      }else{
        echo "Error al restar el prestamo";
      }
    }else{
      echo "Error al retornar el libro";
    }

    break;

  case "listadoPresTot":
    //Arrays donde almacenaremos toda la información
    $idUsuario  = array();
    $idLibros   = array();
    $nomUsu     = array();
    $titulosLib = array();
    $statusEntrega  = array();
    $numSeguimiento = array();
    $fechaSolicitud = array();
    $fechaEntrega   = array();
    $arregloMostrar = array();
    //Mouskerramienta misteriosa(dia de hoy, para hacer comparaciones)
    $hoy = date('Y-m-d');


    //obtenemos todos los prestamos
    $datosPrestamo = $modelo->listaPresTotal();
    //almacenamos la info en los arrays correspondientes
    while($r = $datosPrestamo->fetchObject()){
      $idUsuario[]      = $r->id_solicitante;
      $idLibros[]       = $r->id_libro;
      $fechaSolicitud[] = $r->fecha_solicitud;
      $fechaEntrega[]   = $r->fecha_entrega;
      $numSeguimiento[] = $r->NumSeguim;
      
      if($r->fecha_entrega<$hoy && $r->entregado == "0"){
        $statusEntrega[] = "ATRASADO";
      }else if($r->entregado == "0"){
        $statusEntrega[] = "PENDIENTE";
      }else if($r->entregado == "1"){
        $statusEntrega[] = "ENTREGADO";
      }else{
        $statusEntrega[] = "ERROR";
      }
    }

    //con el array de id's de usuarios, obtenemos sus nombres
    for ($i=0; $i < count($idUsuario); $i++) { 
      $datosUsuario = $modelo->infoUs($idUsuario[$i]);
      while($r = $datosUsuario->fetchObject()){
        $nomUsu[] = $r->nombre;
      }
    }

    //Hacemos lo mismo para los titulos de los libros
    for ($i=0; $i < count($idLibros); $i++) { 
      $datosLibros = $modelo->infoCompleta($idLibros[$i]);
      while($r = $datosLibros->fetchObject()){
        $titulosLib[] = $r->Titulo;
      }
    }

    for($i=0; $i < count($idUsuario); $i++){
      $arregloMostrar[] = array(
        "0" => $titulosLib[$i],
        "1" => $nomUsu[$i],
        "2" => $numSeguimiento[$i],
        "3" => $fechaSolicitud[$i],
        "4" => $fechaEntrega[$i],
        "5" => $statusEntrega[$i]
      );
    }

    $results = array(
      "sEcho" => 1,
      "iTotalRecords" => count($arregloMostrar),
      "iTotalDisplayRecords" => count($arregloMostrar),
      "aaData" => $arregloMostrar
    );
    echo json_encode($results);
    break;

  case "numUsua":
    $usuario = $_POST["usuario"];
    $datosUs = $modelo->infoUsBusq($usuario);

    if($datosUs->rowCount() == 0){
      $arr[] = array(
        "0" => "NO ENCONTRADO"
      );
      echo json_encode($arr);
    }else if($datosUs->rowCount() > 0){
      while($r = $datosUs->fetchObject()){
        $arr[] = array(
          "0" => $r->nombre,
          "1" => $r->id
        ); 
      }
      echo json_encode($arr);
    }
    break;

  case "prestUsuaBusq":
    $id      = $_POST["id"];
    $datosMostrar = array();
    $nombre = "";
    $correo = "";
    $usRet  = "";
    $verif  = "";
    $idUs   = "";

    $datosUs = $modelo->infoUs($id);
    if($datosUs->rowCount()>0){
      while($r = $datosUs->fetchObject()){

        $idUs   = $r->id;
        $nombre = $r->nombre;
        $correo = $r->Correo;
        $usRet  = $r->Login;
        if($r->verificado == "1"){
          $verif = "VERIFICADO";
        }else{
          $verif = "NO VERIFICADO";
        }
      }
      $datosMostrar[] = array(
        "nombre" => $nombre,
        "correo" => $correo,
        "usuario" => $usRet,
        "verif" => $verif,
        "id" => $idUs
      );
    }else{
      $datosMostrar[] = array(
        "0" => "NO ENCONTRADO"
      );
    }
    
    echo json_encode($datosMostrar);
    break;

  case "listCuentPrest":
    $idUs = $_POST["id"];
    $res = $modelo->listPrestUs($idUs);
    $cad = "";

    if($res->rowCount() < 1){
      echo "
      <div class='card-group mt-4 col-md-7 mb-4'>
      <div class='card'>
        <img src='../../files/portadas/Portada_Generica.png' class='card-img-top' style='border-radius: 10px'>
      </div>
      <div class='card'>
        <div class='card-body'>
          <h1>ESTE USUARIO NO HA SOLICITADO PRESTAMOS</h1>
          <p style='font-size: 15px;'>Se puede solicitar el prestamo de un libro desde el modulo de consulta de libros(es necesario que se haya verificado la cuenta de correo electronico con anterioridad)</p>
        </div>
      </div>
    </div>
    <div class='card-group mt-4 col-md-5 mb-4'></div>
      ";
    }else{
      while($r = $res->fetchObject()){
        //obtenemos el id del libro
        $id = $r->id_libro;
        //buscamos la info del libro
        $info = $modeloB->infoCompleta($id);
        $infoB = $info->fetchObject();
        //obtenemos la info y la guardamos en variables
        $img = $infoB->Portada;
        $titulo = $infoB->Titulo;
        $autor = $infoB->Autor;
        $isbn = $infoB->ISBN;
        //Ahora guardamos los datos del prestamo
        $fechaSoli = $r->fecha_solicitud;
        $fechaEnt = $r->fecha_entrega;
        $st = $r->entregado;
        //Obtemenos la fecha actual para comparar
        $fechaActual = date('Y-m-d');
        if($st == "0"){
          if($fechaActual>$fechaEnt){
            $st = "<h5 class='text-danger'>FECHA DE ENTREGA EXCEDIDA</h5>";
          }else{
            $st = "<h5 class='text-warning'>NO ENTREGADO</h5><p>Aun a tiempo</p>";
          }
        }else{
          $st = "<h5 class='text-success'>ENTREGADO</h5>";
        }
        //concatenamos el div con la información
        $cad .= "
        <div class='card-group mt-4 col-md-6 mb-4'>
        <div class='card'>
          <img src='../../files/portadas/$img' class='card-img-top' style='border-radius: 10px'>
        </div>
        <div class='card'>
          <div class='card-body'>
            <h1>$titulo</h1>
            <h4>AUTOR:</h4>
            <p style='font-size: 15px;'>$autor</p>
            <h4>ISBN:</h4>
            <p style='font-size: 15px;'>$isbn</p>
            <h4>FECHA SOLICITUD:</h4>
            <p style='font-size: 15px;'>$fechaSoli</p>
            <h4>FECHA ENTREGA:</h4>
            <p style='font-size: 15px;'>$fechaEnt</p>
            <h4>STATUS:</h4>
            $st
          </div>
        </div>
      </div>
        ";
      }
      echo $cad;
    }

    break;


  case "busqLibro":
    $libro = $_POST["libro"];
    $datosLib = $modelo->infoLibBusq($libro);

    if($datosLib->rowCount() == 0){
      $arr[] = array(
        "0" => "NO ENCONTRADO"
      );
      echo json_encode($arr);
    }else if($datosLib->rowCount() > 0){
      while($r = $datosLib->fetchObject()){
        $arr[] = array(
          "0" => $r->Titulo,
          "1" => $r->id_libro
        ); 
      }
      echo json_encode($arr);
    }
    break;

  case "infLibBusq":
    $id = $_POST["id"];
    $datosLib = $modelo->infoCompleta($id);

    while($r = $datosLib->fetchObject()){
      $arr[] = array(
        "0" => $r->Titulo,
        "1" => $r->Autor,
        "2" => $r->Paginas,
        "3" => $r->Genero,
        "4" => $r->ISBN,
        "5" => $r->Editorial,
        "6" => $r->Portada,
        "7" => $r->id_libro
      );
    }
    echo json_encode($arr);
    break;

    case "listadoPresTot2":
      //Arrays donde almacenaremos toda la información
      $idUsuario  = array();
      $nomUsu     = array();
      $titulosLib = array();
      $statusEntrega  = array();
      $numSeguimiento = array();
      $fechaSolicitud = array();
      $fechaEntrega   = array();
      $arregloMostrar = array();
      //Mouskerramienta misteriosa(dia de hoy, para hacer comparaciones)
      $hoy = date('Y-m-d');
      $id_Lib = $_POST["idLib"];
  
  
      //obtenemos todos los prestamos
      $datosPrestamo = $modelo->listaPresTotal2($id_Lib);
      //almacenamos la info en los arrays correspondientes
      while($r = $datosPrestamo->fetchObject()){
        $idUsuario[]      = $r->id_solicitante;
        $fechaSolicitud[] = $r->fecha_solicitud;
        $fechaEntrega[]   = $r->fecha_entrega;
        $numSeguimiento[] = $r->NumSeguim;
        
        if($r->fecha_entrega<$hoy && $r->entregado == "0"){
          $statusEntrega[] = "ATRASADO";
        }else if($r->entregado == "0"){
          $statusEntrega[] = "PENDIENTE";
        }else if($r->entregado == "1"){
          $statusEntrega[] = "ENTREGADO";
        }else{
          $statusEntrega[] = "ERROR";
        }
      }
  
      //con el array de id's de usuarios, obtenemos sus nombres
      for ($i=0; $i < count($idUsuario); $i++) { 
        $datosUsuario = $modelo->infoUs($idUsuario[$i]);
        while($r = $datosUsuario->fetchObject()){
          $nomUsu[] = $r->nombre;
        }
      }
  
      for($i=0; $i < count($idUsuario); $i++){
        $arregloMostrar[] = array(
          "0" => $nomUsu[$i],
          "1" => $numSeguimiento[$i],
          "2" => $fechaSolicitud[$i],
          "3" => $fechaEntrega[$i],
          "4" => $statusEntrega[$i],
        );
      }
  
      $results = array(
        "sEcho" => 1,
        "iTotalRecords" => count($arregloMostrar),
        "iTotalDisplayRecords" => count($arregloMostrar),
        "aaData" => $arregloMostrar
      );
      echo json_encode($results);
      break;
}

