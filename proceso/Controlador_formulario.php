<?php

require_once "../modelos/Modelo_formulario.php";

$modelo = new ModeloFormulario();

switch($_GET["op"]){
  case "guardar":
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
    //$portada = $_POST["portada"];

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


    $res = $modelo->guardarLibros($titulo, $autor, $paginas, $genero, $isbn, $editorial, $fecha, $idioma, $ejemplares, $imagen, $sipnosis);

    if($res == true){
      echo "REGISTRO EXITOSO";
    }else{
      echo "OCURRIÓ UN ERROR";
    }
      
    break;

  case "vista":

    // VARIABLE EN LA QUE SE GUARDA EL OBJETO CON LA INFORMACION DE LA CONSULTA
    $datos = $modelo->mostrarLibros();
    //ARREGLO PARA GUARDAR LOS VALORES
    $arr = array();

    /* 
    BUCLE WHILE, DONDE ALMACENAMOS EN UNA VARIABLE TEMPORAL (reg)
    CADA UNO DE LOS ROWS DE NUESTRA INFORMACIO TRAIDA
    DE LA BASE DE DATOS, EL METODO fetchObject() NOS PERMITE
    ACCEDER A CADA UNO DE ESOS ROWS
    */
    while($reg = $datos->fetchObject()){

      //ALMACENAMOS LA INFORMACION EN UN ARREGLO (PREVIAMENTE DECLARADO)
      $arr[] = array(
        //SE DECLARA EL INDICE (EMPEZANDO POR 0), Y LA INFO QUE BUSCAMOS
        "0" => $reg->Titulo,
        "1" => $reg->Autor,
        "2" => $reg->Paginas,
        "3" => $reg->Genero
      );
    }

    //SE DECLARA UN ARREGLO CON INFORMACION QUE DATATABLE REQUIERE
    //PARA MOSTRAR CORRECTAMENTE LA INFORMACION
    $results = array(
      "sEcho" => 1,
      "iTotalRecords" => count($arr),
      "iTotalDisplayRecords" => count($arr),
      "aaData" => $arr
    );

    //ENVIAMOS LA INFORMACION CON JSON
    echo json_encode($results);

    break;

  case "cargarGeneros":
    
    $generos = $modelo->generos();
    $opciones = "";

    while($res = $generos->fetchObject()){
      $opciones .= "<option value='".$res->genero."'>".$res->genero."</option>";
    }
    echo $opciones;

    break;

}