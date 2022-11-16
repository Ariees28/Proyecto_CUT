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
                    $_SESSION['id'] = $valor->id;
                    $_SESSION['login'] = $valor->Login;
                    $_SESSION['nombre'] = $valor->nombre;
                    $_SESSION['Correo'] = $valor->Correo;
                    $_SESSION['tipo'] = $valor->Privilegio;
                    $_SESSION['verificado'] = $valor->verificado;
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
