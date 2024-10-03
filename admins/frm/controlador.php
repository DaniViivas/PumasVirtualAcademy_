<?php

//print_r($_POST);
//print_r($_GET);
$caso = filter_input(INPUT_GET, "caso");

switch ($caso) {
    case "guardar_personas":
        guardar_personas();
        break;
    case "eliminar_persona":
        eliminar_personas();
        break;
    case "cargarInfoPersona":
        cargarInfoPersona();
        break;
    case "actualizar_personas":
        actualizar_personas();
        break;
        case "guardar_usuarios":
        guardar_usuarios();
        break;
    case "eliminar_usuario":
        eliminar_usuario();
        break;
    case "cargarInfoUsuario":
        cargarInfoUsuario();
        break;
    case "actualizar_usuarios":
        actualizar_usuarios();
        break;
    default:
        break;
}
function guardar_personas() {
    include_once '../clases/clase_persona.php';
    include_once '../clases/clase_usuario.php';

    // Obtener datos de la persona
    $nombre = filter_input(INPUT_POST, "nombrePersona");
    $apellido = filter_input(INPUT_POST, "apellidoPersona");
    $dni = filter_input(INPUT_POST, "dni");
    $edad = filter_input(INPUT_POST, "edad");
    $telefono = filter_input(INPUT_POST, "telefono");
    $genero = filter_input(INPUT_POST, "genero");
    $correo = filter_input(INPUT_POST, "correo");
    $tipoPersona = filter_input(INPUT_POST, "tipo_persona");

    // Manejo de la imagen
    $fotoPersona = $_FILES['fotoPersona']['name'];
    $unique_name = null;

    if ($fotoPersona) {
        $target_dir = "../imagenes/";
        $extension = pathinfo($fotoPersona, PATHINFO_EXTENSION);
        $unique_name = uniqid() . '_' . time() . '.' . $extension;
        $target_file = $target_dir . $unique_name;
        if (!move_uploaded_file($_FILES["fotoPersona"]["tmp_name"], $target_file)) {
            echo "Error al subir la foto.";
            return;
        }
    }

    $persona = new clase_persona();
    $persona->inicializarPersona($nombre, $apellido, $dni, $edad, $telefono, $genero, $correo, $tipoPersona, $unique_name);

    // Guardar la persona y obtener el ID generado
    $resultado = $persona->guardarPersona();

    if ($resultado == 1) {
        $idPersona = $persona->getLastInsertId(); // Obtener el último id insertado

        // Ahora, registrar el usuario
        $usuario = filter_input(INPUT_POST, "usuarioRegistro");
        $clave = filter_input(INPUT_POST, "claveRegistro");

        $user = new clase_usuario($usuario, $clave, $idPersona);
        $resultadoUsuario = $user->guardarUsuario();

        echo $resultadoUsuario;
    } else {
        echo $resultado; // Error al guardar persona
    }
}


function eliminar_personas() {
    include_once '../clases/clase_persona.php';
    $idPersona = filter_input(INPUT_POST, "idpersona", FILTER_VALIDATE_INT);

    if ($idPersona) {
        $persona = new clase_persona();
        $fotoPersona = $persona->obtenerFotoPersona($idPersona);

        if ($fotoPersona) {
            $target_file = "..//imagenes/" . $fotoPersona;
            if (file_exists($target_file)) {
                unlink($target_file);
            }
        }

        $resultado = $persona->eliminarPersona($idPersona);
        echo $resultado ? 1 : 'Error al eliminar la persona';
    } else {
        echo 'ID de persona inválido';
    }
}




function cargarInfoPersona() {
    include_once '../clases/clase_persona.php';
    $id = filter_input(INPUT_POST, "idpersona");
    $persona = new clase_persona();
    $persona->inicializarIdPersona($id);
    $resultado = $persona->cargarInfoPersona();
    echo $resultado;
}

function actualizar_personas() {
    include_once '../clases/clase_persona.php';
    $nombre = filter_input(INPUT_POST, "nombrePersona");
    $apellido = filter_input(INPUT_POST, "apellidoPersona");
    $dni = filter_input(INPUT_POST, "dni");
    $edad = filter_input(INPUT_POST, "edad");
    $telefono = filter_input(INPUT_POST, "telefono");
    $genero = filter_input(INPUT_POST, "genero");
    $correo = filter_input(INPUT_POST, "correo");
    $tipoPersona = filter_input(INPUT_POST, "tipo_persona");
    $idpersona = filter_input(INPUT_POST, "idp");

    // Instanciar la clase persona
    $persona = new clase_persona();
    $persona->inicializarIdPersona($idpersona);

    // Manejo de la imagen
    $fotoPersona = $_FILES['fotoPersona']['name'];
    if ($fotoPersona) {
        $target_dir = "../imagenes/";

        // Generar un nombre único para el archivo
        $extension = pathinfo($fotoPersona, PATHINFO_EXTENSION);
        $unique_name = $idpersona . '_' . time() . '.' . $extension;
        $target_file = $target_dir . $unique_name;

        // Mover la nueva foto
        if (move_uploaded_file($_FILES["fotoPersona"]["tmp_name"], $target_file)) {
            // Obtener la foto anterior
            $fotoAnterior = $persona->obtenerFotoPersona($idpersona);

            // Eliminar la foto anterior si existe
            if ($fotoAnterior && file_exists($target_dir . $fotoAnterior)) {
                unlink($target_dir . $fotoAnterior);
            }

            $persona->inicializarPersona($nombre, $apellido, $dni, $edad, $telefono, $genero, $correo, $tipoPersona, $unique_name);
        } else {
            echo "Error al subir la nueva foto.";
            return;
        }
    } else {
        $persona->inicializarPersona($nombre, $apellido, $dni, $edad, $telefono, $genero, $correo, $tipoPersona);
    }

    echo $resultado = $persona->actualizarPersona();
}






function guardar_usuarios() {
    include_once '../clases/clase_usuario.php';
    $usuario = filter_input(INPUT_POST, "Usuario");
    $clave = filter_input(INPUT_POST, "clave");

    $user = new clase_usuario($usuario, $clave, null);
    $resultado = $user->guardarUsuario();

    echo $resultado;
}

function eliminar_usuario() {
    include_once '../clases/clase_usuario.php';
    $idusuario = filter_input(INPUT_POST, "idusuario");

    $user = new clase_usuario();
    $user->inicializarIdUsuario($idusuario);
    $resultado = $user->eliminarUsuario();

    echo $resultado;
}

function cargarInfoUsuario() {
    include_once '../clases/clase_usuario.php';
    $idusuario = filter_input(INPUT_POST, "idusuario");

    $user = new clase_usuario();
    $user->inicializarIdUsuario($idusuario);
    $usuario = $user->getUsuarioById();

    echo json_encode($usuario);
}

function actualizar_usuarios() {
    include_once '../clases/clase_usuario.php';
    $idusuario = filter_input(INPUT_POST, "idu");
    $usuario = filter_input(INPUT_POST, "Usuario");
    $clave = filter_input(INPUT_POST, "clave");

    $user = new clase_usuario($usuario, $clave, null);
    $user->inicializarIdUsuario($idusuario);
    $resultado = $user->actualizarUsuario();

    echo $resultado;
}

?>

