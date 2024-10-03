<?php

include_once 'clase_conexion.php';

class clase_usuario {
    private $usuario;
    private $clave;
    private $id_persona_us;
    private $id_usuario;
    
    private function hashPassword($password) {
    return md5($password);
}

    public function __construct($usuario = null, $clave = null, $id_persona_us = null) {
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->id_persona_us = $id_persona_us;
    }

    public function inicializarUsuario($usuario, $clave, $id_persona_us) {
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->id_persona_us = $id_persona_us;
    }

    public function inicializarIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function getUsuarios() {
        $con = new clase_conexion();
        $pdo = $con->abrirConexion();
        $query = 'SELECT * FROM tbl_usuario';
        $stmt = $pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsuarioById() {
        $con = new clase_conexion();
        $pdo = $con->abrirConexion();
        $query = 'SELECT * FROM tbl_usuario WHERE id_usuario = ?';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->id_usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function eliminarUsuario() {
        try {
            $con = new clase_conexion();
            $pdo = $con->abrirConexion();
            $query = 'DELETE FROM tbl_usuario WHERE id_usuario = ?';
            $stmt = $pdo->prepare($query);
            $success = $stmt->execute([$this->id_usuario]);
            return $success ? 1 : 'Error: No se pudo eliminar el usuario';
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

public function guardarUsuario() {
    try {
        $con = new clase_conexion();
        $pdo = $con->abrirConexion();
        $query = 'INSERT INTO tbl_usuario (usuario, clave, id_persona_us) VALUES (?, ?, ?)';
        $stmt = $pdo->prepare($query);
        $success = $stmt->execute([
            $this->usuario, 
            $this->hashPassword($this->clave), 
            $this->id_persona_us
        ]);
        return $success ? 1 : 0;
    } catch (PDOException $e) {
        return 'Error: ' . $e->getMessage();
    }
}

   public function actualizarUsuario() {
    try {
        $con = new clase_conexion();
        $pdo = $con->abrirConexion();
        $query = 'UPDATE tbl_usuario SET usuario=?, clave=?, id_persona_us=? WHERE id_usuario=?';
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            $this->usuario, 
            $this->hashPassword($this->clave), 
            $this->id_persona_us,
            $this->id_usuario
        ]);
        return 1; // Éxito
    } catch (PDOException $e) {
        return 'Error: ' . $e->getMessage(); // Mensaje de error
    }
}
}
?>
