<?php

$caso = filter_input(INPUT_POST, "caso");
switch ($caso) {
    case "guardar_tareas":
        guardar_tareas();
        break;
    case "eliminar_tareas":
        eliminar_tareas();
        break;
    case "cargarInfoTarea":
        cargarInfoTarea();
        break;
    case "actualizar_tareas":
        actualizar_tareas();
        break;
    default:
        break;
}

// FUNCIONES PARA LA GESTIÓN DE TAREAS

function guardar_tareas() {
    include_once '../clases/clase_tarea.php';
    
    $id_curso = filter_input(INPUT_POST, "id_curso");
    $titulo_tarea = filter_input(INPUT_POST, "titulo_tarea");
    $descripcion = filter_input(INPUT_POST, "descripcion");
    $fecha_entrega = filter_input(INPUT_POST, "fecha_entrega");
    $criterios_evaluacion = filter_input(INPUT_POST, "criterios_evaluacion");
    $puntuacion_maxima = filter_input(INPUT_POST, "puntuacion_maxima");

    // Manejar la subida de archivos
    $imagenTarea = null;
    $archivoTarea = null;

    if (isset($_FILES['imagenTarea']) && $_FILES['imagenTarea']['error'] == 0) {
        $target_dir = "../imagenTarea/";
        $extension = pathinfo($_FILES['imagenTarea']['name'], PATHINFO_EXTENSION);
        $unique_name = uniqid() . '_' . time() . '.' . $extension;
        $imagenTarea = $target_dir . $unique_name;

        if (!move_uploaded_file($_FILES["imagenTarea"]["tmp_name"], $imagenTarea)) {
            echo "Error al subir la imagen.";
            return;
        }
    }
    
    if (isset($_FILES['archivoTarea']) && $_FILES['archivoTarea']['error'] == 0) {
        $target_dir = "../archivoTarea/";
        $extension = pathinfo($_FILES['archivoTarea']['name'], PATHINFO_EXTENSION);
        $unique_name = uniqid() . '_' . time() . '.' . $extension;
        $archivoTarea = $target_dir . $unique_name;

        if (!move_uploaded_file($_FILES["archivoTarea"]["tmp_name"], $archivoTarea)) {
            echo "Error al subir el archivo.";
            return;
        }
    }
    
    $tarea = new clase_tarea();
    $tarea->inicializarTarea($id_curso, $titulo_tarea, $descripcion, $fecha_entrega, $criterios_evaluacion, $puntuacion_maxima);
    $tarea->setImagen($imagenTarea);
    $tarea->setArchivo($archivoTarea);
    
    echo $tarea->guardarTarea();
}
    

function cargarInfoTarea() {
    include_once '../clases/clase_tarea.php';
    $idtarea = filter_input(INPUT_POST, "idtarea");
    $tarea = new clase_tarea();
    $tarea->inicializarIdTarea($idtarea);

    try {
        $result = $tarea->getTareaById();
        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(['error' => 'No se encontró la tarea.']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error en la solicitud: ' . $e->getMessage()]);
    }
}






function eliminar_tareas() {
    include_once '../clases/clase_tarea.php';
    $idtarea = filter_input(INPUT_POST, "idtarea");
    $tarea = new clase_tarea();
    $tarea->inicializarIdTarea($idtarea);
    $result = $tarea->eliminarTarea();
    echo $result;
}




















function actualizar_tareas() {
    include_once '../clases/clase_tarea.php';
    
    $id_tarea = filter_input(INPUT_POST, "id_tarea");
    $id_curso = filter_input(INPUT_POST, "id_curso");
    $titulo_tarea = filter_input(INPUT_POST, "titulo_tarea");
    $descripcion = filter_input(INPUT_POST, "descripcion");
    $fecha_entrega = filter_input(INPUT_POST, "fecha_entrega");
    $criterios_evaluacion = filter_input(INPUT_POST, "criterios_evaluacion");
    $puntuacion_maxima = filter_input(INPUT_POST, "puntuacion_maxima");

    $imagenTarea = null;
    $archivoTarea = null;

    if (isset($_FILES['imagenTarea']) && $_FILES['imagenTarea']['error'] == 0) {
        $target_dir = "../imagenTarea/";
        $extension = pathinfo($_FILES['imagenTarea']['name'], PATHINFO_EXTENSION);
        $unique_name = uniqid() . '_' . time() . '.' . $extension;
        $imagenTarea = $target_dir . $unique_name;

        if (!move_uploaded_file($_FILES["imagenTarea"]["tmp_name"], $imagenTarea)) {
            echo "Error al subir la imagen.";
            return;
        }
    }
    
    if (isset($_FILES['archivoTarea']) && $_FILES['archivoTarea']['error'] == 0) {
        $target_dir = "../archivoTarea/";
        $extension = pathinfo($_FILES['archivoTarea']['name'], PATHINFO_EXTENSION);
        $unique_name = uniqid() . '_' . time() . '.' . $extension;
        $archivoTarea = $target_dir . $unique_name;

        if (!move_uploaded_file($_FILES["archivoTarea"]["tmp_name"], $archivoTarea)) {
            echo "Error al subir el archivo.";
            return;
        }
    }
    
    $tarea = new clase_tarea();
    $tarea->inicializarTarea($id_curso, $titulo_tarea, $descripcion, $fecha_entrega, $criterios_evaluacion, $puntuacion_maxima);
    $tarea->setImagen($imagenTarea);
    $tarea->setArchivo($archivoTarea);
    
    echo $tarea->actualizarTarea($id_tarea);
}
?>
