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
    $portada = $_POST["portada"];
    $imagenmodificar = $_POST['imagenactual'];

        if ($_FILES["portada"]['tmp_name']) {
          //Validamos que el archivo exista
          $filename = $_FILES["portada"]["name"]; //Obtenemos el nombre original del archivo
          $source = $_FILES["portada"]["tmp_name"]; //Obtenemos un nombre temporal del archivo
          $extension = $_FILES["portada"]["type"]; //obtenemos la extension del archivo que se sube
          $directorio = '../files/portadas/'; //Declaramos un  variable con la ruta donde guardaremos los archivos
          //Validamos si la ruta de destino existe, en caso de no existir la creamos
          if (!file_exists($directorio)) {
              mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");
          }
          if ($extension == "image/jpg" || $extension == "image/jpeg" || $extension == "image/png") { //formatos validos
              $target_path = $directorio . '/' . $titulo . $filename; //Indicamos la ruta de destino, así como el nombre del archivo
              $dir = opendir($directorio); //Abrimos el directorio de destino
              //Movemos y validamos que el archivo se haya cargado correctamente
              //El primer campo es el origen y el segundo el destino
              if (move_uploaded_file($source, $target_path)) {
                  //    echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
                  $imagen = $titulo . $filename; //al nombre real del archivo le asignamos fecha y hora para que si existe otro igual tenga algo diferente
              } else {
                  die("Ha ocurrido un error al guardar la imagen, por favor inténtelo de nuevo.<br>");
              }
              closedir($dir); //Cerramos el directorio de destino
          } else {
              die("Ha ocurrido un error con la extension de la imagen, por favor Verifique¡¡¡¡.<br>");
          }
      } else {
          if ($imagenmodificar == "") { // condicion para modificar imagen si el archivo no existe y es nuevo
              $imagen = "Portada_Generica.jpg";
          } else {
              $imagen = $imagenmodificar; // guardara el mismo nombre que tenia
          }

      }

      $res = $modelo->guardarLibros($titulo, $autor, $paginas, $genero, $isbn, $editorial, $fecha, $idioma, $ejemplares, $imagen);
        if($res == true){
          echo "INSERSION DE DATOS EXITOSA";
        }else{
          echo "HUBO UN ERROR";
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