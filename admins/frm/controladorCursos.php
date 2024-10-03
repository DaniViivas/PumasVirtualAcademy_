<?php

$caso = filter_input(INPUT_GET, "caso");
switch ($caso) {
    case "guardar_cursos":
        guardar_cursos();
        break;
    case "eliminar_curso":
        eliminar_curso();
        break;
    case "cargarInfoCurso":
        cargarInfoCurso();
        break;
    case "actualizar_cursos":
        actualizar_cursos();
        break;
    default:
        break;
}

//FUNCIONES PARA LA GESTION DE CURSOS

function eliminar_curso() {
    include_once '../clases/clase_cursos.php';
    $idcurso = filter_input(INPUT_POST, "idcurso");
    $curso = new clase_cursos();
    $curso->inicializarIdCurso($idcurso);
    $result = $curso->eliminarCurso();
    echo $result;
}

function guardar_cursos() {
    include_once '../clases/clase_cursos.php';
    
    $nombre = filter_input(INPUT_POST, "nombreCurso");
    $tema = filter_input(INPUT_POST, "tema");
    $descripcion = filter_input(INPUT_POST, "descripcionCurso");
    $nivel = filter_input(INPUT_POST, "nivelCurso");
    $fechaInicio = filter_input(INPUT_POST, "fechaInicio");
    $fechaFinalizacion = filter_input(INPUT_POST, "fechaFinalizacion");
    $tbl_persona_id_persona = filter_input(INPUT_POST, "tbl_persona_id_persona");

    // Manejo de la imagen
    $fotoCurso = $_FILES['fotoCurso']['name'];
    $unique_name = null;

    if (!empty($fotoCurso)) {
        $target_dir = "../imagenes_cursos/";

        // Generar un nombre único para el archivo
        $extension = pathinfo($fotoCurso, PATHINFO_EXTENSION);
        $unique_name = uniqid() . '_' . time() . '.' . $extension;
        $target_file = $target_dir . $unique_name;

        // Mover la nueva foto
        if (!move_uploaded_file($_FILES["fotoCurso"]["tmp_name"], $target_file)) {
            echo "Error al subir la foto.";
            return;
        }
    }

    error_log("Datos recibidos: nombre=$nombre, tema=$tema, descripcion=$descripcion, nivel=$nivel, fechaInicio=$fechaInicio, fechaFinalizacion=$fechaFinalizacion, id_persona=$tbl_persona_id_persona");

    $curso = new clase_cursos();
    $curso->inicializarCurso($nombre, $tema, $descripcion, $nivel, $fechaInicio, $fechaFinalizacion, $tbl_persona_id_persona, $unique_name);
    
    echo $curso->guardarCurso();
}

function cargarInfoCurso() {
    include_once '../clases/clase_cursos.php';
    $id = filter_input(INPUT_POST, "idcurso");
    $curso = new clase_cursos();
    $curso->inicializarIdCurso($id);
    $resultado = $curso->getCursoById();
    echo json_encode($resultado);
}











function actualizar_cursos() {
    include_once '../clases/clase_cursos.php';
    $nombre = filter_input(INPUT_POST, "nombreCurso");
    $tema = filter_input(INPUT_POST, "tema");
    $descripcion = filter_input(INPUT_POST, "descripcionCurso");
    $nivel = filter_input(INPUT_POST, "nivelCurso");
    $fechaInicio = filter_input(INPUT_POST, "fechaInicio");
    $fechaFinalizacion = filter_input(INPUT_POST, "fechaFinalizacion");
    $idcurso = filter_input(INPUT_POST, "idc");
    $tbl_persona_id_persona = filter_input(INPUT_POST, "tbl_persona_id_persona");
    
    $curso = new clase_cursos();
    $curso->inicializarIdCurso($idcurso);
    $curso->inicializarCurso($nombre, $tema, $descripcion, $nivel, $fechaInicio, $fechaFinalizacion, $tbl_persona_id_persona);
    echo $curso->actualizarCurso();
}
?>
