<?php
session_start();
session_start();
include_once '../clases/clase_conexion.php';

if (!isset($_SESSION['id_usuario']) || $_SESSION['id_usuario'] <= 0) {
    echo 'ID de usuario no encontrado en la sesión.';
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$id_curso = filter_input(INPUT_POST, 'id_curso', FILTER_SANITIZE_NUMBER_INT);

if (!$id_curso) {
    echo 'ID del curso no es válido: ' . var_export($id_curso, true);
    exit;
}

if (!$id_usuario) {
    echo 'ID del usuario no es válido: ' . var_export($id_usuario, true);
    exit;
}

try {
    $con = new clase_conexion();
    $pdo = $con->abrirConexion();
    $query = 'INSERT INTO tbl_usuario_tipo (id_usuario, id_curso) VALUES (?, ?)';
    $stmt = $pdo->prepare($query);
    $success = $stmt->execute([$id_usuario, $id_curso]);

    if ($success) {
        echo '¡Curso registrado exitosamente!';
    } else {
        echo 'Error al registrar el curso.';
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

?>
