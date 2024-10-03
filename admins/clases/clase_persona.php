<?php

include_once 'clase_conexion.php';

class clase_persona {
    private $nombre;
    private $apellido;
    private $dni;
    private $edad;
    private $telefono;
    private $genero;
    private $correo;
    private $tipoPersona;
    private $fotoPersona;
    private $idPersona;
    private $foto;

    // Inicializa los datos de la persona
    public function inicializarPersona($nombre, $apellido, $dni, $edad, $telefono, $genero, $correo, $tipoPersona, $fotoPersona = null) {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->edad = $edad;
        $this->telefono = $telefono;
        $this->genero = $genero;
        $this->correo = $correo;
        $this->tipoPersona = $tipoPersona;
        if ($fotoPersona) {
            $this->foto = $fotoPersona;
        }
    }
    
    // Inicializa el ID de la persona (si es necesario)
    public function inicializarIdPersona($idpersona) {
        $this->idPersona = $idpersona;
    }
    
 public function obtenerFotoPersona($idPersona) {
        try {
            $con = new clase_conexion();
            $pdo = $con->abrirConexion();
            $query = 'SELECT foto_persona FROM tbl_persona WHERE id_persona = ?';
            $stmt = $pdo->prepare($query);
            $stmt->execute([$idPersona]);
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            error_log("Error al obtener la foto de la persona: " . $e->getMessage());
            return false;
        }
    }
  
    // Obtiene los tipos de usuario
    public function getTipoPersona() {
        $con = new clase_conexion();
        $pdo = $con->abrirConexion();
        $query = 'SELECT * FROM tbl_tipo_usuario WHERE 1=1';
        $stmt = $pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtiene todas las personas junto con su tipo
    public function getPersonas() {
        $con = new clase_conexion();
        $pdo = $con->abrirConexion();
        $query = 'SELECT * FROM tbl_persona a JOIN tbl_tipo_usuario b ON a.id_tipo_empleado_fk = b.id_tipo_usuario';
        $stmt = $pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Verifica si una persona con el mismo DNI ya existe (excluyendo un ID específico)
    public function getPersona($excludeId = null) {
        $con = new clase_conexion();
        $pdo = $con->abrirConexion();
        $query = 'SELECT COUNT(*) FROM tbl_persona WHERE dni = ?';
        if ($excludeId !== null) {
            $query .= ' AND id_persona != ?';
            $stmt = $pdo->prepare($query);
            $stmt->execute([$this->dni, $excludeId]);
        } else {
            $stmt = $pdo->prepare($query);
            $stmt->execute([$this->dni]);
        }
        return $stmt->fetchColumn();
    }


    // Guarda una nueva persona en la base de datos
    public function guardarPersona() {
        try {
            $con = new clase_conexion();
            $pdo = $con->abrirConexion();
            $query = 'INSERT INTO tbl_persona (id_persona, nombre, apellido, dni, edad, telefono, correo, genero, id_tipo_empleado_fk, foto_persona) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                $this->nombre,
                $this->apellido,
                $this->dni,
                $this->edad,
                $this->telefono,
                $this->correo,
                $this->genero,
                $this->tipoPersona,
                $this->foto
            ]);
            return 1; // Éxito
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage(); // Mensaje de error
        }
    }

    // Elimina una persona de la base de datos
 public function eliminarPersona($idPersona) {
        try {
            $con = new clase_conexion();
            $pdo = $con->abrirConexion();
            $query = 'DELETE FROM tbl_persona WHERE id_persona = ?';
            $stmt = $pdo->prepare($query);
            $stmt->execute([$idPersona]);
            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            error_log("Error al eliminar la persona: " . $e->getMessage());
            return false;
        }
    }

    // Carga la información de una persona
   public function cargarInfoPersona() {
    $con = new clase_conexion();
    $pdo = $con->abrirConexion();
    $query = 'SELECT * FROM tbl_persona WHERE id_persona = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$this->idPersona]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $arreglo = array(
        "id_persona" => $resultado['id_persona'],
        "nombre" => $resultado['nombre'],
        "apellido" => $resultado['apellido'],
        "dni" => $resultado['dni'],
        "edad" => $resultado['edad'],
        "telefono" => $resultado['telefono'],
        "correo" => $resultado['correo'],
        "genero" => $resultado['genero'],
        "id_tipo_empleado_fk" => $resultado['id_tipo_empleado_fk'],
        "foto_persona" => $resultado['foto_persona'] ? "../imagenes/" . $resultado['foto_persona'] : null
    );

    return json_encode($arreglo);
}

    // Actualiza la información de una persona
 public function actualizarPersona() {
        $con = new clase_conexion();
        $pdo = $con->abrirConexion();
        $query = 'UPDATE tbl_persona SET nombre = ?, apellido = ?, dni = ?, edad = ?, telefono = ?, correo = ?, genero = ?, id_tipo_empleado_fk = ?, foto_persona = ? WHERE id_persona = ?';
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            $this->nombre,
            $this->apellido,
            $this->dni,
            $this->edad,
            $this->telefono,
            $this->correo,
            $this->genero,
            $this->tipoPersona,
            $this->foto,
            $this->idPersona
        ]);
        return 1; // Éxito
    }
}



