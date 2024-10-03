<?php

$caso = filter_input(INPUT_POST, "caso");
switch ($caso) {
    case "guardar_calificaciones":
        guardar_calificaciones();
        break;
    case "eliminar_calificaciones":
        eliminar_calificaciones();
        break;
    case "cargarInfoCalificacion":
        cargarInfoCalificacion();
        break;
    case "actualizar_calificaciones":
        actualizar_calificaciones();
        break;
    default:
        break;
}

function guardar_calificaciones() {
    include_once '../clases/clase_calificaciones.php';
    
    $id_curso = filter_input(INPUT_POST, "id_curso");
    $comentarios = filter_input(INPUT_POST, "comentarios");
    $fecha_calificacion = filter_input(INPUT_POST, "fecha_calificacion");

    $calificacion = new clase_calificaciones();
    $calificacion->inicializarCalificacion($id_curso, $comentarios, $fecha_calificacion);
    
    echo $calificacion->guardarCalificacion();
}

function eliminar_calificaciones() {
    include_once '../clases/clase_calificaciones.php';
    
    $id_calificacion = filter_input(INPUT_POST, "idcalificacion");
    $calificacion = new clase_calificaciones();
    $calificacion->inicializarIdCalificacion($id_calificacion);
    $result = $calificacion->eliminarCalificacion();
    echo $result;
}
function cargarInfoCalificacion() {
    include_once '../clases/clase_calificaciones.php';
    
    $id_calificacion = filter_input(INPUT_POST, "idcalificacion");
    $calificacion = new clase_calificaciones();
    $calificacion->inicializarIdCalificacion($id_calificacion);

    try {
        $result = $calificacion->getCalificacionesById();
        header('Content-Type: application/json');
        echo json_encode($result);
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Error en la solicitud: ' . $e->getMessage()]);
    }
}






function actualizar_calificaciones() {
    include_once '../clases/clase_calificaciones.php';

    $id_curso = filter_input(INPUT_POST, "id_curso");
    $comentarios = filter_input(INPUT_POST, "comentarios");
    $fecha_calificacion = filter_input(INPUT_POST, "fecha_calificacion");
    $id_calificacion = filter_input(INPUT_POST, "idc"); // Asegúrate de que el nombre del campo es correcto

    $calificacion = new clase_calificaciones();
    $calificacion->inicializarCalificacion($id_curso, $comentarios, $fecha_calificacion);
    $calificacion->inicializarIdCalificacion($id_calificacion);

    echo $calificacion->actualizarCalificacion();
}








?>
