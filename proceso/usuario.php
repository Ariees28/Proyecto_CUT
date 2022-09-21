<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "../modelos/Usuario.php";
$usuario = new Usuario();

switch ($_GET["op"]) {

    case 'verificar':
        //validar si el usuario tiene acceso al sistema
        // primero traer la contraseña ya almacenada.
        $logina = $_POST['logina'];
        $clavea = $_POST['clavea'];
        $acceso = array();
        $rspta = $usuario->verificar($logina);
        while ($valor = $rspta->fetchObject()) {
            if (isset($valor->clave)) {
                if (password_verify($clavea, $valor->clave)) {
                    $_SESSION['nombre'] = $valor->nombre;
                    $_SESSION['login'] = $valor->Login;
                    $_SESSION['id'] = $valor->id;
                    $rspta2 = $usuario->permiso($valor->id);
                    $con = 0;
                    while ($valor2 = $rspta2->fetchObject()) {
                        $acceso[$con] = $valor2->IdMenu;
                        $con++;
                    }
                    $_SESSION['permiso'] = $acceso;
                    echo json_encode($valor);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        break;


}

function encriptar($clave)
{
    $options = ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3];
    $X = password_hash($clave, PASSWORD_ARGON2I, $options);
    return $X;
}

function foto($y)
{
    $b = "";
    if ($y == "" || $y == "NULL" || $y == "NULO") { //validar si existe en la base de datos
        $y = "sin_foto.jpg";
    } else {
        $b = "../usuario/images/avatars/" . $y;
        if (file_exists($b)) {
        } else {
            $y = "sin_foto.jpg";
        }
    }
    return $y;
}