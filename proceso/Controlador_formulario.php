<?php

require_once "../modelos/Modelo_formulario.php";

$modelo = new ModeloFormulario();

switch($_GET["op"]){
  case "guardar":
      $autor = $_POST["autor"];
      $titulo = $_POST["titulo"];
      $paginas = $_POST["paginas"];
      $genero = $_POST["apachedecombate"];

      $res = $modelo->guardarLibros($titulo, $autor, $paginas, $genero);

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
}