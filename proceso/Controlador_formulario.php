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
}