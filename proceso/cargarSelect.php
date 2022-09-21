<?php
session_start();
require_once "../modelos/cargarSelect.php";
$cargarselect = new CargarSelect();
$tmp = "";
switch ($_POST['opcion']) { // recibimos la opcion

    case '1':
        $rspta = $cargarselect->privilegiosMenu();
        $tmp .= "<option value='No Aplica'>Seleccione</option>";
        while ($res = $rspta->fetchObject()) {
            $tmp .= '<option value="' . $res->Idmenu . '">' . $res->NomMenu . '</option>'; // privilegios solo para el menu
        }
        //  $tmp .= "<option value='Otros'> Otros </option>";
        echo $tmp;
        break;

}