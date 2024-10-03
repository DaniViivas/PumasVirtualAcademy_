<?php
include_once '../clases/clase_conexion.php';

$u = filter_input(INPUT_POST, "usuario");
$c = filter_input(INPUT_POST, "clave");

if($u != "" && $c != ""){
    $con = new clase_conexion();
    $id_usuario = $con->logeo($u, $c);  // Ahora devuelve el ID del usuario
    if($id_usuario !== false){
        session_start();
        $_SESSION['usuario'] = $u;
        $_SESSION['id_usuario'] = $id_usuario;  // Guardar el ID del usuario en la sesión
        $_SESSION['tiempo'] = time();
        echo 1;  // Respuesta exitosa
    } else {
        echo 2;  // Credenciales incorrectas
    }
} else {
    echo 2;  // Faltan datos
}
?>
