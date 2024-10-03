<?php

//print_r($_POST);
//print_r($_GET);
$caso = filter_input(INPUT_GET, "caso");

switch ($caso) {
    case "guardar_usuario":
        guardar_usuario();
        break;
    case "eliminar_usuario":
        eliminar_usuario();
        break;
    case "cargarInfoUsuario":
        cargarInfoUsuario();
        break;
    case "actualizar_usuario":
        actualizar_usuario();
        break;
    default:
        break;
}
function guardar_usuario() {
    include_once '../clases/clase_usuario.php';  
}


function eliminar_usuario() {
    include_once '../clases/clase_usuario.php';  
}


function cargarInfoUsuario() {
    include_once '../clases/clase_usuario.php';
 
}

function actualizar_personas() {
    include_once '../clases/clase_usuario.php';

}



