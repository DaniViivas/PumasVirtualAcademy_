<?php

$caso = filter_input(INPUT_POST, "caso");
switch ($caso) {
    case "guardar_lecciones":
        guardar_lecciones();
        break;
    case "eliminar_lecciones":
        eliminar_lecciones();
        break;
    case "cargarInfoLeccion":
        cargarInfoLeccion();
        break;
    case "actualizar_lecciones":
        actualizar_lecciones();
        break;
    default:
        break;
}

function guardar_lecciones() {
    include_once '../clases/clase_lecciones.php';

    $id_curso = filter_input(INPUT_POST, "id_curso");
    $titulo_leccion = filter_input(INPUT_POST, "titulo_leccion");
    $contenido = filter_input(INPUT_POST, "contenido");
    $fecha_publicacion = filter_input(INPUT_POST, "fecha_publicacion");

    // Manejar la imagen
    $imagen_leccion = $_FILES['imagen_leccion']['name'];
    $archivo_leccion = $_FILES['archivo_leccion']['name'];

    
    
    if (isset($_FILES['imagen_leccion']) && $_FILES['imagen_leccion']['error'] == 0) {
        $target_dir = "../imagenleccion/";
        $extension = pathinfo($_FILES['imagen_leccion']['name'], PATHINFO_EXTENSION);
        $unique_name = uniqid() . '_' . time() . '.' . $extension;
        $imagen_leccion = $target_dir . $unique_name;

        if (!move_uploaded_file($_FILES["imagen_leccion"]["tmp_name"], $imagen_leccion)) {
            echo "Error al subir la imagen.";
            return;
        }
    }
    
       if (isset($_FILES['archivo_leccion']) && $_FILES['archivo_leccion']['error'] == 0) {
        $target_dir = "../archivoleccion/";
        $extension = pathinfo($_FILES['archivo_leccion']['name'], PATHINFO_EXTENSION);
        $unique_name = uniqid() . '_' . time() . '.' . $extension;
        $archivo_leccion = $target_dir . $unique_name;

        if (!move_uploaded_file($_FILES["archivo_leccion"]["tmp_name"], $archivo_leccion)) {
            echo "Error al subir la imagen.";
            return;
        }
    }
    
    


    $leccion = new clase_lecciones();
    $leccion->inicializarLeccion($id_curso, $titulo_leccion, $contenido, $fecha_publicacion, $imagen_leccion, $archivo_leccion);

    echo $leccion->guardarLeccion();
}

function eliminar_lecciones() {
    include_once '../clases/clase_lecciones.php';
    
    $id_leccion = filter_input(INPUT_POST, "idleccion");
    $leccion = new clase_lecciones();
    $leccion->inicializarIdLeccion($id_leccion);
    $result = $leccion->eliminarLeccion();
    echo $result;
}

function cargarInfoLeccion() {
    include_once '../clases/clase_lecciones.php';
    
    $id_leccion = filter_input(INPUT_POST, "idleccion");
    $leccion = new clase_lecciones();
    $leccion->inicializarIdLeccion($id_leccion);

    try {
        $result = $leccion->getLeccionesById();
        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(['error' => 'No se encontró la lección.']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error en la solicitud: ' . $e->getMessage()]);
    }
}

function actualizar_lecciones() {
    include_once '../clases/clase_lecciones.php';

    $id_leccion = filter_input(INPUT_POST, "idl");
    $id_curso = filter_input(INPUT_POST, "id_curso");
    $titulo_leccion = filter_input(INPUT_POST, "titulo_leccion");
    $contenido = filter_input(INPUT_POST, "contenido");
    $fecha_publicacion = filter_input(INPUT_POST, "fecha_publicacion");

    $leccion = new clase_lecciones();
    $leccion->inicializarIdLeccion($id_leccion);
    $leccion->inicializarLeccion($id_curso, $titulo_leccion, $contenido, $fecha_publicacion);

    // Manejo de imagen y archivo
    if (isset($_FILES['imagen_lecciones']['tmp_name']) && $_FILES['imagen_lecciones']['tmp_name'] !== '') {
        $imagen_leccion = file_get_contents($_FILES['imagen_lecciones']['tmp_name']);
        $leccion->setImagenLeccion($imagen_leccion);
    }

    if (isset($_FILES['archivo_lecciones']['tmp_name']) && $_FILES['archivo_lecciones']['tmp_name'] !== '') {
        $archivo_leccion = file_get_contents($_FILES['archivo_lecciones']['tmp_name']);
        $leccion->setArchivoLeccion($archivo_leccion);
    }

    echo $leccion->actualizarLeccion();
}
?>
