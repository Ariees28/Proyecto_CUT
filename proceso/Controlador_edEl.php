<?php

require_once "../modelos/Modelo_edEl.php";

$modelo = new ModeloEdicion();

switch ($_GET["op"]) {
  case 'listadoLib':

    $datos = $modelo->datos();
    $arr = array();

    while($reg = $datos->fetchObject()){
      $arr[] = array(
        "0" => $reg->Titulo,
        "1" => $reg->Autor,
        "2" => $reg->ISBN,
        "3" => $reg->Ejemplares
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
    $isbn = $_POST["isbn"];

    $datos = $modelo->datosIsbn($isbn);
    $arr = array();

    while($reg = $datos->fetchObject()){
      $arr[] = array(
        "0" => $reg->Titulo,
        "1" => $reg->Autor,
        "2" => $reg->Paginas,
        "3" => $reg->Genero,
        "4" => $reg->ISBN,
        "5" => $reg->Editorial,
        "6" => $reg->Fecha,
        "7" => $reg->Idioma,
        "8" => $reg->Ejemplares,
        "9" => $reg->sipnosis,
        "10" => $reg->id_libro,
        "11" => $reg->Portada
      );
    }

    echo json_encode($arr);
    break;

  case "guardar":
    
    $id = $_POST["id"];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $paginas = $_POST['paginas'];
    $genero = $_POST['genero'];
    $isbn = $_POST['isbn'];
    $editorial = $_POST['editorial'];
    $fecha = $_POST['fecha'];
    $idioma = $_POST['idioma'];
    $ejemplares = $_POST['ejemplares'];
    $sipnosis = $_POST['sipnosis'];


    $res = $modelo->editarLibro($titulo, $autor, $paginas, $genero, $isbn, $editorial, $fecha, $idioma, $ejemplares, $sipnosis, $id);

    if($res == true){
      echo "REGISTRO EXITOSO";
    }else{
      echo $res;
    }
    break;

  case "guardarP":

    $id = $_POST["id"];
    $titulo = $_POST["titulo"];
    $autor = $_POST["autor"];

    if(isset($_FILES["portada"])){
      $filename = $_FILES["portada"]["name"];
      $source = $_FILES["portada"]["tmp_name"];
      $extension = $_FILES["portada"]["type"];
      $directorio = '../files/portadas/';

      if (!file_exists($directorio)) {
        mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");
      }

      if ($extension == "image/jpg" || $extension == "image/jpeg" || $extension == "image/png") {

        
        $target_path = $directorio . '/' . $titulo . "_" . $autor . "_" . $filename;
        $dir = opendir($directorio);

        if (move_uploaded_file($source, $target_path)) {
          $imagen = $titulo . "_" . $autor . "_" . $filename;
        }else {
          die("Ha ocurrido un error al guardar la imagen, por favor inténtelo de nuevo.");
        }
        closedir($dir);        
      }else {
        die("Ha ocurrido un error con la extension de la imagen, por favor Verifique.");
      }

    }else{
      $imagen = "Portada_Generica.png";
    }

    $res = $modelo->actPortada($imagen, $id);

    if($res == true){
      echo "Correcto";
    }else{
      echo "Ocurrió un error";
    }
    break;
  
}