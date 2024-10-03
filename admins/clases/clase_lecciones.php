<?php

include_once 'clase_conexion.php';

class clase_lecciones {
    
    private $id_curso;
    private $titulo_leccion;
    private $contenido;
    private $fecha_publicacion;
    private $imagen_leccion;
    private $archivo_leccion;
    private $id_leccion;
    

    public function inicializarLeccion($id_curso, $titulo_leccion, $contenido, $fecha_publicacion, $imagen_leccion = null, $archivo_leccion = null) {
        $this->id_curso = $id_curso;
        $this->titulo_leccion = $titulo_leccion;
        $this->contenido = $contenido;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->imagen_leccion = $imagen_leccion;
        $this->archivo_leccion = $archivo_leccion;
    }
    
    
     public function setImagenLeccion($imagen) {
        $this->imagen_leccion = $imagen;
    }

    public function setArchivoLeccion($archivo) {
        $this->archivo_leccion = $archivo;
    }
    public function inicializarIdLeccion($id_leccion) {
        $this->id_leccion = $id_leccion;
    }
    
    public function getLecciones() {
        $con = new clase_conexion();
        $pdo = $con->abrirConexion();
        $query = 'SELECT * FROM tbl_lecciones';
        $stmt = $pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getLeccionesById() {
        $con = new clase_conexion();
        $pdo = $con->abrirConexion();
        $query = 'SELECT * FROM tbl_lecciones WHERE id_leccion = ?';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->id_leccion]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Función para eliminar la lección
    public function eliminarLeccion() {
        try {
            $con = new clase_conexion();
            $pdo = $con->abrirConexion();
            $query = 'DELETE FROM tbl_lecciones WHERE id_leccion = ?';
            $stmt = $pdo->prepare($query);
            $success = $stmt->execute([$this->id_leccion]);
            return $success ? 1 : 'Error: No se pudo eliminar la lección';
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
    
      public function guardarLeccion() {
        try {
            $con = new clase_conexion();
            $pdo = $con->abrirConexion();
            $query = 'INSERT INTO tbl_lecciones (id_curso, titulo_leccion, contenido, fecha_publicacion, imagen_leccion, archivo_leccion) VALUES (?, ?, ?, ?, ?, ?)';
            $stmt = $pdo->prepare($query);
            $success = $stmt->execute([
                $this->id_curso, 
                $this->titulo_leccion, 
                $this->contenido, 
                $this->fecha_publicacion,
                $this->imagen_leccion,
                $this->archivo_leccion
            ]);
            return $success ? 1 : 0;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

  // Función para actualizar la lección
  public function actualizarLeccion() {
    try {
        $con = new clase_conexion();
        $pdo = $con->abrirConexion();

        $query = 'UPDATE tbl_lecciones SET id_curso=?, titulo_leccion=?, contenido=?, fecha_publicacion=?';

        // Si hay imagen o archivo, los añadimos a la consulta
        $params = [$this->id_curso, $this->titulo_leccion, $this->contenido, $this->fecha_publicacion];

        if ($this->imagen_leccion !== null) {
            $query .= ', imagen_leccion=?';
            $params[] = $this->imagen_leccion;
        }
        if ($this->archivo_leccion !== null) {
            $query .= ', archivo_leccion=?';
            $params[] = $this->archivo_leccion;
        }

        $query .= ' WHERE id_leccion=?';
        $params[] = $this->id_leccion;

        $stmt = $pdo->prepare($query);
        $success = $stmt->execute($params);

        return $success ? 1 : 0;
    } catch (PDOException $e) {
        return 'Error: ' . $e->getMessage();
    }
 }
 
 
 public function getLeccionesByCurso($id_curso) {
    try {
        $con = new clase_conexion();
        $pdo = $con->abrirConexion();
        $query = 'SELECT * FROM tbl_lecciones WHERE id_curso = ?';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id_curso]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        error_log("Error al obtener las lecciones para el curso: " . $e->getMessage());
        return []; // Retorna un array vacío en caso de error
    }
}

}
?>
