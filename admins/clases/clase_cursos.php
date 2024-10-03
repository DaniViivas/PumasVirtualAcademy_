<?php

include_once 'clase_conexion.php';

class clase_cursos {
    private $nombre_curso;
    private $tema;
    private $descripcion_curso;
    private $nivel_curso;
    private $fecha_inicio;
    private $fecha_finalizacion;
    private $idCurso;
    private $tbl_persona_id_persona;
    private $fotoCurso;
    private $foto;
     
public function inicializarCurso($nombre_curso, $tema, $descripcion_curso, $nivel_curso, $fecha_inicio, $fecha_finalizacion, $tbl_persona_id_persona, $fotoCurso = null) {
    $this->nombre_curso = $nombre_curso;
    $this->tema = $tema;
    $this->descripcion_curso = $descripcion_curso;
    $this->nivel_curso = $nivel_curso;
    $this->fecha_inicio = $fecha_inicio;
    $this->fecha_finalizacion = $fecha_finalizacion;
    $this->tbl_persona_id_persona = $tbl_persona_id_persona;
    $this->foto = $fotoCurso; // Almacena el valor de la imagen o nulo

    }

    public function inicializarIdCurso($idCurso) {
        $this->idCurso = $idCurso;
    }
    
    
    
     public function obtenerFotoCurso($idCurso) {
        try {
            $con = new clase_conexion();
            $pdo = $con->abrirConexion();
            $query = 'SELECT foto_persona FROM tbl_curso WHERE id_curso = ?';
            $stmt = $pdo->prepare($query);
            $stmt->execute([$idCurso]);
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            error_log("Error al obtener la foto de la persona: " . $e->getMessage());
            return false;
        }
    }

    // Obtiene todos los cursos
    public function getCursos() {
        $con = new clase_conexion();
        $pdo = $con->abrirConexion();
        $query = 'SELECT * FROM tbl_curso';
        $stmt = $pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtiene un curso específico por ID
    public function getCursoById() {
        $con = new clase_conexion();
        $pdo = $con->abrirConexion();
        $query = 'SELECT * FROM tbl_curso WHERE id_curso = ?';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->idCurso]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Elimina un curso de la base de datos
    public function eliminarCurso() {
        try {
            $con = new clase_conexion();
            $pdo = $con->abrirConexion();
            $query = 'DELETE FROM tbl_curso WHERE id_curso = ?';
            $stmt = $pdo->prepare($query);
            $success = $stmt->execute([$this->idCurso]);
            return $success ? 1 : 'Error: No se pudo eliminar el curso'; // Retorna éxito o mensaje de error
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage(); // Mensaje de error
        }
    }

    // Guarda un nuevo curso en la base de datos
    public function guardarCurso() {
        try {
            $con = new clase_conexion();
            $pdo = $con->abrirConexion();
            $query = 'INSERT INTO tbl_curso (nombre_curso, tema, descripcion_curso, nivel_curso, fecha_inicio, fecha_finalizacion, tbl_persona_id_persona, foto_curso) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = $pdo->prepare($query);
            $success = $stmt->execute([
                $this->nombre_curso, 
                $this->tema, 
                $this->descripcion_curso, 
                $this->nivel_curso, 
                $this->fecha_inicio, 
                $this->fecha_finalizacion, 
                $this->tbl_persona_id_persona,
                $this->foto
                    
            ]);
            return $success ? 1 : 0;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // Actualiza la información de un curso
    public function actualizarCurso() {
        try {
            $con = new clase_conexion();
            $pdo = $con->abrirConexion();
            $query = 'UPDATE tbl_curso SET nombre_curso=?, tema=?, descripcion_curso=?, nivel_curso=?, fecha_inicio=?, fecha_finalizacion=?, tbl_persona_id_persona=? WHERE id_curso=?';
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                $this->nombre_curso, 
                $this->tema, 
                $this->descripcion_curso, 
                $this->nivel_curso, 
                $this->fecha_inicio, 
                $this->fecha_finalizacion, 
                $this->tbl_persona_id_persona,
                $this->idCurso
            ]);
            return 1; // Éxito
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage(); // Mensaje de error
        }
    }
    
    
    // Añadir en clase_cursos.php
public function getCursosPorUsuario($id_usuario) {
    try {
        $con = new clase_conexion();
        $pdo = $con->abrirConexion();
        $query = 'SELECT c.* FROM tbl_curso c
                  INNER JOIN tbl_usuario_tipo ut ON c.id_curso = ut.id_curso
                  WHERE ut.id_usuario = ?';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        error_log("Error al obtener los cursos para el usuario: " . $e->getMessage());
        return []; // Retorna un array vacío en caso de error
    }
}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
?>
