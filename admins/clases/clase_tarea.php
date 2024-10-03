<?php

include_once 'clase_conexion.php';

class clase_tarea {
    private $id_curso;
    private $titulo_tarea;
    private $descripcion;
    private $fecha_entrega;
    private $criterios_evaluacion;
    private $puntuacion_maxima;
    private $id_tarea;
    private $imagen;
    private $archivo;
    
    // Método para inicializar una tarea
    public function inicializarTarea($id_curso, $titulo_tarea, $descripcion, $fecha_entrega, $criterios_evaluacion, $puntuacion_maxima) {
        $this->id_curso = $id_curso;
        $this->titulo_tarea = $titulo_tarea;
        $this->descripcion = $descripcion;
        $this->fecha_entrega = $fecha_entrega;
        $this->criterios_evaluacion = $criterios_evaluacion;
        $this->puntuacion_maxima = $puntuacion_maxima;
    }

    // Método para inicializar el ID de la tarea
    public function inicializarIdTarea($id_tarea) {
        $this->id_tarea = $id_tarea;
    }

    // Método para establecer la imagen de la tarea
    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    // Método para establecer el archivo de la tarea
    public function setArchivo($archivo) {
        $this->archivo = $archivo;
    }
    
    // Método para obtener todas las tareas
    public function getTareas() {
        $con = new clase_conexion();
        $pdo = $con->abrirConexion();
        $query = 'SELECT * FROM tbl_tarea';
        $stmt = $pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Método para obtener una tarea por su ID
   public function getTareaById() {
    $con = new clase_conexion();
    $pdo = $con->abrirConexion();
    $query = 'SELECT * FROM tbl_tarea WHERE id_tarea = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$this->id_tarea]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ? $result : false;
}

    // Método para eliminar una tarea
    public function eliminarTarea() {
        try {
            $con = new clase_conexion();
            $pdo = $con->abrirConexion();
            $query = 'DELETE FROM tbl_tarea WHERE id_tarea = ?';
            $stmt = $pdo->prepare($query);
            $success = $stmt->execute([$this->id_tarea]);
            return $success ? 1 : 'Error: No se pudo eliminar la tarea';
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // Método para guardar una nueva tarea
    public function guardarTarea() {
        try {
            $con = new clase_conexion();
            $pdo = $con->abrirConexion();
            $query = 'INSERT INTO tbl_tarea (id_curso, titulo_tarea, descripcion, fecha_entrega, criterios_evaluacion, puntuacion_maxima, imagen, archivo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = $pdo->prepare($query);
            $success = $stmt->execute([
                $this->id_curso, 
                $this->titulo_tarea, 
                $this->descripcion, 
                $this->fecha_entrega, 
                $this->criterios_evaluacion, 
                $this->puntuacion_maxima,
                $this->imagen,
                $this->archivo
            ]);
            return $success ? 1 : 0;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // Método para actualizar una tarea existente
    public function actualizarTarea($id_tarea) {
        try {
            $con = new clase_conexion();
            $pdo = $con->abrirConexion();
            $query = 'UPDATE tbl_tarea SET id_curso=?, titulo_tarea=?, descripcion=?, fecha_entrega=?, criterios_evaluacion=?, puntuacion_maxima=?';

            // Agregar la actualización de imagen y archivo si existen
            $params = [
                $this->id_curso, 
                $this->titulo_tarea, 
                $this->descripcion, 
                $this->fecha_entrega, 
                $this->criterios_evaluacion, 
                $this->puntuacion_maxima
            ];

            if ($this->imagen) {
                $query .= ', imagen=?';
                $params[] = $this->imagen;
            }

            if ($this->archivo) {
                $query .= ', archivo=?';
                $params[] = $this->archivo;
            }

            // Finalizar la consulta
            $query .= ' WHERE id_tarea=?';
            $params[] = $id_tarea;

            // Preparar y ejecutar la consulta
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
            return 1;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
    
    public function getTareasByCurso($id_curso) {
    try {
        $con = new clase_conexion();
        $pdo = $con->abrirConexion();
        $query = 'SELECT * FROM tbl_tarea WHERE id_curso = ?';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id_curso]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        error_log("Error al obtener las tareas para el curso: " . $e->getMessage());
        return []; // Retorna un array vacío en caso de error
    }
}

    
    
    
    
    
}



?>
