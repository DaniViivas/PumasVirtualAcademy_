<?php

/**
 * Description of clase_conexion
 *
 * @author OM
 */
class clase_conexion {
  protected $database_host = "localhost";
  protected $database_name = "bd_campus_learning";
  protected $database_user = "root";
  protected $database_pass = "";

  public function __construct(){
  }

  //abre conexion
  public function abrirConexion() {
    $opciones = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Agregado para manejo de errores
    );
    try {
      return new PDO("mysql:host=".$this->database_host.";dbname=".$this->database_name, $this->database_user, $this->database_pass, $opciones);
    } catch (PDOException $e) {
      exit('ERROR al conectarse a la base datos. \nDescripción del ERROR: '.$e->getMessage());
    }
  }

  //verificar usuario
 public function logeo($user, $pass) {
    $pdo = $this->abrirConexion();
    $stmt = $pdo->prepare('SELECT id_usuario FROM tbl_usuario WHERE usuario = :usuario AND clave = :clave');
    $stmt->execute([
        ':usuario' => $user,
        ':clave' => md5($pass)
    ]);
    // Retornar el ID del usuario si existe, o false si no existe
    return $stmt->fetchColumn();
}


  //retornar usuario
  public function infoUsuario($user) {
    $pdo = $this->abrirConexion();
    if (isset($user)) {
      $stmt = $pdo->prepare('SELECT * FROM tbl_persona a JOIN tbl_usuario b ON a.tbl_usuario_id_usuario = b.id_usuario WHERE b.usuario = :usuario');
      $stmt->execute([':usuario' => $user]);
      $contact = $stmt->fetch(PDO::FETCH_ASSOC);
      return json_encode($contact);
    }
    return null;
  }
}
?>


