<?php

include_once 'clase_conexion.php';

class clase_calificaciones {
    
    private $id_curso;
    private $id_calificacion;
    private $comentarios;
    private $fecha_calificacion;

    public function inicializarCalificacion($id_curso, $comentarios, $fecha_calificacion) {
        $this->id_curso = $id_curso;
        $this->comentarios = $comentarios;
        $this->fecha_calificacion = $fecha_calificacion;
    }
    
    public function inicializarIdCalificacion($id_calificacion) {
        $this->id_calificacion = $id_calificacion;
    }
    
    public function getCalificaciones() {
        $con = new clase_conexion();
        $pdo = $con->abrirConexion();
        $query = 'SELECT * FROM tbl_calificaciones';
        $stmt = $pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getCalificacionesById() {
        $con = new clase_conexion();
        $pdo = $con->abrirConexion();
        $query = 'SELECT * FROM tbl_calificaciones WHERE id_calificacion = ?';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->id_calificacion]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function eliminarCalificacion() {
        try {
            $con = new clase_conexion();
            $pdo = $con->abrirConexion();
            $query = 'DELETE FROM tbl_calificaciones WHERE id_calificacion = ?';
            $stmt = $pdo->prepare($query);
            $success = $stmt->execute([$this->id_calificacion]);
            return $success ? 1 : 'Error: No se pudo eliminar la calificación';
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
    
    public function guardarCalificacion() {
        try {
            $con = new clase_conexion();
            $pdo = $con->abrirConexion();
            $query = 'INSERT INTO tbl_calificaciones (id_curso, comentarios, fecha_calificacion) VALUES (?, ?, ?)';
            $stmt = $pdo->prepare($query);
            $success = $stmt->execute([
                $this->id_curso, 
                $this->comentarios, 
                $this->fecha_calificacion
            ]);
            return $success ? 1 : 0;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function actualizarCalificacion() {
        try {
            $con = new clase_conexion();
            $pdo = $con->abrirConexion();
            $query = 'UPDATE tbl_calificaciones SET id_curso=?, comentarios=?, fecha_calificacion=? WHERE id_calificacion=?';
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                $this->id_curso, 
                $this->comentarios, 
                $this->fecha_calificacion,
                $this->id_calificacion
            ]);
            return 1;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
?>
