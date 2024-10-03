<?php
$caso = filter_input(INPUT_POST, "caso");

switch ($caso) {
    case "frm_agregar_personas":
        frm_agregar_personas();
        break;
     case "frm_agregar_usuario":
        frm_agregar_usuario();
        break;
    case "frm_ver_usuarios":
        frm_ver_usuarios();
        break;
    case "frm_agregar_cursos":
        frm_agregar_cursos();
        break;
    case "frm_agregar_tareas":
        frm_agregar_tareas();
        break;
     case "frm_agregar_lecciones":
        frm_agregar_lecciones();
        break;
     case "frm_agregar_calificaciones":
        frm_agregar_calificaciones();
        break;
    default:
        break;
}

function frm_agregar_personas() {
    include_once '../clases/clase_persona.php';
    $html = '
    <div class="formdata">
        <div class="col-12" style="text-align: center; box-shadow: 5px 1px 12px -4px rgba(0,0,0,0.5); border: 1px solid black;">
            <h4>Gestión de Personas</h4>
          
            <form id="formularioPersonas" name="formularioPersonas" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="nombrePersona" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombrePersona" name="nombrePersona" placeholder="Ingrese su nombre" required>
                    </div>
                    <div class="col-12">
                        <label for="apellidoPersona" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellidoPersona" name="apellidoPersona" placeholder="Ingrese su apellido" required>
                    </div>
                    <div class="col-12">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text" class="form-control" id="dni" name="dni" placeholder="Ingrese su DNI" required>
                    </div>
                    <div class="col-12">
                        <label for="edad" class="form-label">Edad</label>
                        <input type="number" min="0" max="150" class="form-control" id="edad" name="edad" placeholder="Ingrese su edad" required>
                    </div>
                    <div class="col-12">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ingrese su teléfono" required>
                    </div>
                    <div class="col-12">
                        <label for="genero" class="form-label">Genero</label>
                        <select id="genero" name="genero" class="form-control">
                            <option value="0">Seleccione</option>
                            <option value="1">Masculino</option>
                            <option value="2">Femenino</option>
                        </select>
                    </div>
                    
                    <div class="col-12">
                        <label for="correo" class="form-label">Correo: correo@ejemplo.com</label>
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="correo@ejemplo.com" required>
                    </div>
                      <div class="col-12">
                        <label for="fotoPersona" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="fotoPersona" name="fotoPersona" accept="image/*">
                        <img id="fotoPersonaPreview" src="" alt="Foto Persona" style="display:none; max-width: 100px; max-height: 100px; margin-top: 10px;">

                    </div>
                    <div class="col-12">
                        <label for="tipo_persona" class="form-label">Tipo de Persona</label>
                        <select id="tipo_persona" name="tipo_persona" class="form-control">
                            <option value="0">Seleccione</option>';
                 
                           
    $persona = new clase_persona();
    $tiposPersonas = $persona->getTipoPersona();
    $personas = $persona->getPersonas();
    foreach ($tiposPersonas as $val) {
        $html .= '<option value="' . $val['id_tipo_usuario'] . '">' . $val['tipo_usuario'] . '</option>';
    }

    $html .= '</select>
                    </div>          
                    <div class="col-12">
                        <button style="width: 20%;" class="btn btn-success" type="button" onclick="fnc_guardarPersona();">Guardar</button>  
                        <input type="hidden" id="casofrm" name="casofrm" value="casoguardarPersona">
                        <input type="hidden" id="idp" name="idp" value="">
                    </div>
                </div>
            </form>
        </div> 
        <div class="col-12" style="text-align: center; box-shadow: 5px 1px 12px -4px rgba(0,0,0,0.5); border: 1px solid black;">  
            <h4>Personas Registradas</h4>
            <div> 
                <table id="tbl_persona" class="" style="width:100%; border: 1px solid black;">
                    <thead style="background: #BCC7D1;">
                        <tr>
                            <th>N.</th>
                            <th>Nombre</th>
                            <th>Apellido</th>   
                            <th>DNI</th>
                            <th>Edad</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Genero</th>
                            <th>Tipo Persona</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';

    $i = 1;
    foreach ($personas as $val) {
        $html .= '<tr>
                    <td>' . $i . '</td>
                    <td>' . $val['nombre'] . '</td>
                    <td>' . $val['apellido'] . '</td>
                    <td>' . $val['dni'].'</td>
                    <td>' . $val['edad'] . '</td>
                    <td>' . $val['telefono'].'</td>
                    <td>' . $val['correo'] . '</td>
                    <td>' . $val['genero'] . '</td>
                    <td>' . $val['tipo_usuario'] . '</td>
                    <td>
                        <button type="button" class="btn-success" onclick="cargarInfoPersona(' . $val['id_persona'] . ')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 4 13H3a.5.5 0 0 1-.354-.854z"/>
                            </svg>
                        </button>
                        <button type="button" class="btn-outline-danger" onclick="eliminarPersona(' . $val['id_persona'] . ')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 .5.5V6h1.5a.5.5 0 0 1 .5.5v.5a.5.5 0 0 1-.5.5H13v6a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7h-.5a.5.5 0 0 1-.5-.5v-.5a.5.5 0 0 1 .5-.5H5V5.5zM4.5 2a.5.5 0 0 1 .5-.5H11a.5.5 0 0 1 .5.5V3h1a1 1 0 0 1 1 1v1h-1.5a.5.5 0 0 1-.5.5H5.5a.5.5 0 0 1-.5-.5H3V4a1 1 0 0 1 1-1h1.5V2z"/>
                            </svg>
                        </button>
                    </td>
                </tr>';
        $i++;
    }
    
    $html .= '</tbody>
                </table>
            </div>
        </div>
    </div>';
    
    echo $html;
}

function frm_agregar_usuario() {
    include_once '../clases/clase_usuario.php';

    $html = '
    <div class="formdata">
        <div class="col-12" style="text-align: center; box-shadow: 5px 1px 12px -4px rgba(0,0,0,0.5); border: 1px solid black;">
            <h4>Gestión de Usuarios</h4>
          
            <form id="formularioUsuarios" name="formularioUsuarios" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="nombreUsuario" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="Usuario" name="Usuario" placeholder="Ingrese su usuario" required>
                    </div>
                 
             
                    <div class="col-12">
                        <label for="passwordUsuario" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="clave" name="clave" placeholder="Ingrese su contraseña" required>
                    </div>
       
                    <div class="col-12">
                        <button style="width: 20%;" class="btn btn-success" type="button" onclick="fnc_guardarUsuario();">Guardar</button>  
                        <input type="hidden" id="casofrm" name="casofrm" value="casoguardarUsuario">
                        <input type="hidden" id="idu" name="idu" value="">
                    </div>
                </div>
            </form>
        </div> 
        <div class="col-12" style="text-align: center; box-shadow: 5px 1px 12px -4px rgba(0,0,0,0.5); border: 1px solid black;">  
            <h4>Usuarios Registrados</h4>
            <div> 
                <table id="tbl_usuario" class="" style="width:100%; border: 1px solid black;">
                    <thead style="background: #BCC7D1;">
                        <tr>
                            <th>N.</th>
                            <th>usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';

    $usuario = new clase_usuario();
    $usuarios = $usuario->getUsuarios();
    $i = 1;
    foreach ($usuarios as $val) {
        $html .= '<tr>
                    <td>' . $i . '</td>
                    <td>' . $val['usuario'] . '</td>
                    <td>
                        <button type="button" class="btn-success" onclick="cargarInfoUsuario(' . $val['id_usuario'] . ')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 4 13H3a.5.5 0 0 1-.354-.854z"/>
                            </svg>
                        </button>
                        <button type="button" class="btn-outline-danger" onclick="eliminarUsuario(' . $val['id_usuario'] . ')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 .5.5V6h1.5a.5.5 0 0 1 .5.5v.5a.5.5 0 0 1-.5.5H13v6a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7h-.5a.5.5 0 0 1-.5-.5v-.5a.5.5 0 0 1 .5-.5H5V5.5zM4.5 2a.5.5 0 0 1 .5-.5H11a.5.5 0 0 1 .5.5V3h1a1 1 0 0 1 1 1v1h-1.5a.5.5 0 0 1-.5.5H5.5a.5.5 0 0 1-.5-.5H3V4a1 1 0 0 1 1-1h1.5V2z"/>
                            </svg>
                        </button>
                    </td>
                </tr>';
        $i++;
    }
    
    $html .= '</tbody>
                </table>
            </div>
        </div>
    </div>';
    
    echo $html;
}

function frm_ver_usuarios() {
    include_once '../clases/clase_persona.php';
    $persona = new clase_persona();
    $personas = $persona->getPersonas();
    
    $html = '
    <div class="formdata" style="text-align: center; box-shadow: 5px 1px 12px -4px rgba(0,0,0,0.5); border: 1px solid black;">  
        <h4>Personas Registradas</h4>
        <div> 
            <table id="tbl_persona" style="width:100%; border: 1px solid black;">
                <thead style="background: #BCC7D1;">
                    <tr>
                        <th>N.</th>
                        <th>Nombre</th>
                        <th>Apellido</th>   
                        <th>DNI</th>
                        <th>Edad</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Genero</th>
                        <th>Tipo Persona</th>

                    </tr>
                </thead>
                <tbody>';

    $i = 1;
    foreach ($personas as $val) {
        $html .= '<tr>
                    <td>' . $i . '</td>
                    <td>' . $val['nombre'] . '</td>
                    <td>' . $val['apellido'] . '</td>
                    <td>' . $val['dni'].'</td>
                    <td>' . $val['edad'] . '</td>
                    <td>' . $val['telefono'].'</td>
                    <td>' . $val['correo'] . '</td>
                    <td>' . $val['genero'] . '</td>
                    <td>' . $val['tipo_usuario'] . '</td>
                    <td>
                
                    </td>
                </tr>';
        $i++;
    }
    
    $html .= '</tbody>
                </table>
            </div>
        </div>
    </div>';
    
    echo $html;
}




// SECCION PARA MODULOS DE GESTION DE CURSOS

function frm_agregar_cursos() {
    include_once '../clases/clase_cursos.php';
    $html = '
    <div class="formdata">
        <div class="col-12" style="text-align: center; box-shadow: 5px 1px 12px -4px rgba(0,0,0,0.5); border: 1px solid black;">
            <h4>Agregar Curso</h4>
          
            <form id="formularioCursos" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="nombreCurso" class="form-label">Nombre del Curso</label>
                        <input type="text" class="form-control" id="nombreCurso" name="nombreCurso" placeholder="Ingrese el nombre del curso" required>
                    </div>
                    <div class="col-12">
                        <label for="tema" class="form-label">Tema</label>
                        <input type="text" class="form-control" id="tema" name="tema" placeholder="Ingrese el tema del curso" required>
                    </div>
                    <div class="col-12">
                        <label for="descripcionCurso" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcionCurso" name="descripcionCurso" placeholder="Ingrese la descripción del curso" required></textarea>
                    </div>
                    <div class="col-12">
                        <label for="nivelCurso" class="form-label">Nivel</label>
                        <select id="nivelCurso" name="nivelCurso" class="form-control" required>
                            <option value="">Seleccione el nivel</option>
                            <option value="Básico">Básico</option>
                            <option value="Intermedio">Intermedio</option>
                            <option value="Avanzado">Avanzado</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                        <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required>
                    </div>
                    <div class="col-12">
                        <label for="fechaFinalizacion" class="form-label">Fecha de Finalización</label>
                        <input type="date" class="form-control" id="fechaFinalizacion" name="fechaFinalizacion" required>
                    </div>
                    <div class="col-12">
                        <label for="fotoCurso" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="fotoCurso" name="fotoCurso" accept="image/*">
                        <img id="fotoCursoPreview" src="" alt="Foto Curso" style="display:none; max-width: 100px; max-height: 100px; margin-top: 10px;">

                    </div>
                
                    <div class="col-12">
                    <div class="col-12">
                        <label for="tbl_persona_id_persona" class="form-label">ID del Instructor</label>
                        <input type="number" class="form-control" id="tbl_persona_id_persona" name="tbl_persona_id_persona" placeholder="Ingrese el ID del instructor" required>
                    </div>
                    <div class="col-12">
                         <input type="hidden" id="casofrm" name="casofrm" value="guardar_cursos">  
                            <input type="hidden" id="idc" name="idc" value="">  
                            <button style="width: 20%;" class="btn btn-success" type="button" onclick="fnc_guardarCurso();">Guardar</button>  
                       
                    </div>
                </div>
            </form>
        </div> 
        <div class="col-12" style="text-align: center; box-shadow: 5px 1px 12px -4px rgba(0,0,0,0.5); border: 1px solid black;">  
            <h4>Cursos Registrados</h4>
            <div> 
                <table id="tbl_curso" class="" style="width:100%; border: 1px solid black;">
                    <thead style="background: #BCC7D1;">
                        <tr>
                            <th>N.</th>
                            <th>Nombre</th>
                            <th>Tema</th>   
                            <th>Descripción</th>
                            <th>Nivel</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Finalización</th>
                        
                            <th>ID del Instructor</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';

    $curso = new clase_cursos();
    $cursos = $curso->getCursos();
    $i = 1;
    foreach ($cursos as $val) {
        $html .= '<tr>
                    <td>' . $i . '</td>
                    <td>' . $val['nombre_curso'] . '</td>
                    <td>' . $val['tema'] . '</td>
                    <td>' . $val['descripcion_curso'] . '</td>
                    <td>' . $val['nivel_curso'] . '</td>
                    <td>' . $val['fecha_inicio'] . '</td>
                    <td>' . $val['fecha_finalizacion'] . '</td>
                    
                    <td>' . $val['tbl_persona_id_persona'] . '</td>
                    <td>
                        <button type="button" class="btn-success" onclick="cargarInfoCurso(' . $val['id_curso'] . ')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 4 13H3a.5.5 0 0 1-.354-.854z"/>
                            </svg>
                        </button>
                        <button type="button" class="btn-outline-danger" onclick="eliminarCurso(' . $val['id_curso'] . ')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 .5.5V6h1.5a.5.5 0 0 1 .5.5v.5a.5.5 0 0 1-.5.5H13v6a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7h-.5a.5.5 0 0 1-.5-.5v-.5a.5.5 0 0 1 .5-.5H5V5.5zM4.5 2a.5.5 0 0 1 .5-.5H11a.5.5 0 0 1 .5.5V3h1a1 1 0 0 1 1 1v1h-1.5a.5.5 0 0 1-.5.5H5.5a.5.5 0 0 1-.5-.5H3V4a1 1 0 0 1 1-1h1.5V2z"/>
                            </svg>
                        </button>
                    </td>
                </tr>';
        $i++;
    }
    
    $html .= '</tbody>
                </table>
            </div>
        </div>
    </div>';
    
    echo $html;
}



function frm_agregar_tareas() {
    include_once '../clases/clase_cursos.php';
    include_once '../clases/clase_tarea.php';
    
    $curso = new clase_cursos();
    $cursos = $curso->getCursos();
    
    $html = '
    <div class="formdata">
        <div class="col-12" style="text-align: center; box-shadow: 5px 1px 12px -4px rgba(0,0,0,0.5); border: 1px solid black;">
            <h4>Agregar Tarea</h4>
            <form id="formularioTareas" name="formularioTareas" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="id_curso" class="form-label">Curso</label>
                        <select id="id_curso" name="id_curso" class="form-control" required>
                            <option value="">Seleccione un curso</option>';
                            foreach ($cursos as $curso) {
                                $html .= '<option value="' . $curso['id_curso'] . '">' . $curso['nombre_curso'] . '</option>';
                            }
    $html .= '
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="titulo_tarea" class="form-label">Título de la Tarea</label>
                        <input type="text" class="form-control" id="titulo_tarea" name="titulo_tarea" placeholder="Ingrese el título de la tarea" required>
                    </div>
                    <div class="col-12">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese la descripción de la tarea" required></textarea>
                    </div>
                    <div class="col-12">
                        <label for="fecha_entrega" class="form-label">Fecha de Entrega</label>
                        <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" required>
                    </div>
                    <div class="col-12">
                        <label for="criterios_evaluacion" class="form-label">Criterios de Evaluación</label>
                        <textarea class="form-control" id="criterios_evaluacion" name="criterios_evaluacion" placeholder="Ingrese los criterios de evaluación" required></textarea>
                    </div>
                    <div class="col-12">
                        <label for="puntuacion_maxima" class="form-label">Puntuación Máxima</label>
                        <input type="number" class="form-control" id="puntuacion_maxima" name="puntuacion_maxima" placeholder="Ingrese la puntuación máxima" required>
                    </div>
                    
                    <div class="col-12">
                          <label for="imagenTarea" class="form-label">Imagen de la Tarea</label>
                          <input type="file" class="form-control" id="imagenTarea" name="imagenTarea" accept="image/*">
                          <img id="imagenTareaPreview" src="" alt="Imagen de la Tarea" style="display:none; max-width: 100px; max-height: 100px; margin-top: 10px;">
                      </div>
                      <div class="col-12">
                          <label for="archivoTarea" class="form-label">Archivo de la Tarea</label>
                          <input type="file" class="form-control" id="archivoTarea" name="archivoTarea" accept=".pdf,.doc,.docx,.txt">
                      </div>
                    <div class="col-12">
                        <input type="hidden" id="casofrm" name="casofrm" value="guardar_tareas">  
                        <input type="hidden" id="idt" name="idt" value="">  
                       <button style="width: 20%;" class="btn btn-success" type="button" onclick="fnc_guardarTarea();">Guardar</button>
 
                    </div>
                </div>
            </form>
        </div> 
        <div class="col-12" style="text-align: center; box-shadow: 5px 1px 12px -4px rgba(0,0,0,0.5); border: 1px solid black;">  
            <h4>Tareas Registradas</h4>
            <div> 
                <table id="tbl_tarea" class="" style="width:100%; border: 1px solid black;">
                    <thead style="background: #BCC7D1;">
                        <tr>
                            <th>N.</th>
                            <th>Curso</th>
                            <th>Título</th>   
                            <th>Descripción</th>
                            <th>Fecha de Entrega</th>
                            <th>Criterios de Evaluación</th>
                            <th>Puntuación Máxima</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';
                    
    $tarea = new clase_tarea();
    $tareas = $tarea->getTareas();
    $i = 1;
    foreach ($tareas as $val) {
        $html .= '<tr>
                    <td>' . $i . '</td>
                    <td>' . $val['id_curso'] . '</td>
                    <td>' . $val['titulo_tarea'] . '</td>
                    <td>' . $val['descripcion'] . '</td>
                    <td>' . $val['fecha_entrega'] . '</td>
                    <td>' . $val['criterios_evaluacion'] . '</td>
                    <td>' . $val['puntuacion_maxima'] . '</td>
                    <td>
                        <button type="button" class="btn-success" onclick="cargarInfoTarea(' . $val['id_tarea'] . ')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 4 13H3a.5.5 0 0 1-.354-.854z"/>
                            </svg>
                        </button>
                        <button type="button" class="btn-outline-danger" onclick="eliminarTarea(' . $val['id_tarea'] . ')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 .5.5V6h1.5a.5.5 0 0 1 .5.5v.5a.5.5 0 0 1-.5.5H13v6a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7h-.5a.5.5 0 0 1-.5-.5v-.5a.5.5 0 0 1 .5-.5H5V5.5zM4.5 2a.5.5 0 0 1 .5-.5H11a.5.5 0 0 1 .5.5V3h1a1 1 0 0 1 1 1v1h-1.5a.5.5 0 0 1-.5.5H5.5a.5.5 0 0 1-.5-.5H3V4a1 1 0 0 1 1-1h1.5V2z"/>
                            </svg>
                        </button>
                    </td>
                </tr>';
        $i++;
    }
    
    $html .= '</tbody>
                </table>
            </div>
        </div>
    </div>';
    
    echo $html;
}


    
function frm_agregar_lecciones() {
    include_once '../clases/clase_cursos.php';
    include_once '../clases/clase_lecciones.php'; // Asegúrate de tener una clase para manejar lecciones

    $curso = new clase_cursos();
    $cursos = $curso->getCursos();
    
    $html = '
    <div class="formdata">
        <div class="col-12" style="text-align: center; box-shadow: 5px 1px 12px -4px rgba(0,0,0,0.5); border: 1px solid black;">
            <h4>Agregar Lección</h4>
            <form id="formularioLecciones" name="formularioLecciones" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="id_curso" class="form-label">Curso</label>
                        <select id="id_curso" name="id_curso" class="form-control" required>
                            <option value="">Seleccione un curso</option>';
                            foreach ($cursos as $curso) {
                                $html .= '<option value="' . $curso['id_curso'] . '">' . $curso['nombre_curso'] . '</option>';
                            }
    $html .= '
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="titulo_leccion" class="form-label">Título de la Lección</label>
                        <input type="text" class="form-control" id="titulo_leccion" name="titulo_leccion" placeholder="Ingrese el título de la lección" required>
                    </div>
                    <div class="col-12">
                        <label for="contenido" class="form-label">Contenido</label>
                        <textarea class="form-control" id="contenido" name="contenido" placeholder="Ingrese el contenido de la lección" required></textarea>
                    </div>
                    <div class="col-12">
                        <label for="fecha_publicacion" class="form-label">Fecha de Publicación</label>
                        <input type="date" class="form-control" id="fecha_publicacion" name="fecha_publicacion" required>
                    </div>
                    <div class="col-12">
                            <label for="imagen_leccion" class="form-label">Imagen de la Lección</label>
                            <input type="file" class="form-control" id="imagen_leccion" name="imagen_leccion">
                        </div>
                        <div class="col-12">
                            <label for="archivo_leccion" class="form-label">Archivo Adjunto</label>
                            <input type="file" class="form-control" id="archivo_leccion" name="archivo_leccion">
                        </div>
                    <div class="col-12">
                        <input type="hidden" id="casofrm" name="casofrm" value="guardar_lecciones">  
                        <input type="hidden" id="idl" name="idl" value="">  
                       <button style="width: 20%;" class="btn btn-success" type="button" onclick="fnc_guardarLeccion();">Guardar</button>
                    </div>
                </div>
            </form>
        </div> 
        <div class="col-12" style="text-align: center; box-shadow: 5px 1px 12px -4px rgba(0,0,0,0.5); border: 1px solid black;">  
            <h4>Lecciones Registradas</h4>
            <div> 
                <table id="tbl_leccion" class="" style="width:100%; border: 1px solid black;">
                    <thead style="background: #BCC7D1;">
                        <tr>
                            <th>N.</th>
                            <th>Curso</th>
                            <th>Título</th>   
                            <th>Contenido</th>
                            <th>Fecha de Publicación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';
                    
    $leccion = new clase_lecciones();
    $lecciones = $leccion->getLecciones();
    $i = 1;
    foreach ($lecciones as $val) {
        $html .= '<tr>
                    <td>' . $i . '</td>
                    <td>' . $val['id_curso'] . '</td>
                    <td>' . $val['titulo_leccion'] . '</td>
                    <td>' . $val['contenido'] . '</td>
                    <td>' . $val['fecha_publicacion'] . '</td>
                    <td>
                        <button type="button" class="btn-success" onclick="cargarInfoLeccion(' . $val['id_leccion'] . ')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 4 13H3a.5.5 0 0 1-.354-.854z"/>
                            </svg>
                        </button>
                        <button type="button" class="btn-outline-danger" onclick="eliminarLeccion(' . $val['id_leccion'] . ')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 .5.5V6h1.5a.5.5 0 0 1 .5.5v.5a.5.5 0 0 1-.5.5H13v6a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7h-.5a.5.5 0 0 1-.5-.5v-.5a.5.5 0 0 1 .5-.5H5V5.5zM4.5 2a.5.5 0 0 1 .5-.5H11a.5.5 0 0 1 .5.5V3h1a1 1 0 0 1 1 1v1h-1.5a.5.5 0 0 1-.5.5H5.5a.5.5 0 0 1-.5-.5H3V4a1 1 0 0 1 1-1h1.5V2z"/>
                            </svg>
                        </button>
                    </td>
                </tr>';
        $i++;
    }
    
    $html .= '</tbody>
                </table>
            </div>
        </div>
    </div>';
    
    echo $html;
}

function frm_agregar_calificaciones() {
    include_once '../clases/clase_cursos.php';
    include_once '../clases/clase_calificaciones.php'; // Asegúrate de tener una clase para manejar calificaciones

    $curso = new clase_cursos();
    $cursos = $curso->getCursos();
    
    $html = '
    <div class="formdata">
        <div class="col-12" style="text-align: center; box-shadow: 5px 1px 12px -4px rgba(0,0,0,0.5); border: 1px solid black;">
            <h4>Agregar Calificación</h4>
            <form id="formularioCalificaciones" name="formularioCalificaciones">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="id_curso" class="form-label">Curso</label>
                        <select id="id_curso" name="id_curso" class="form-control" required>
                            <option value="">Seleccione un curso</option>';
                            foreach ($cursos as $curso) {
                                $html .= '<option value="' . $curso['id_curso'] . '">' . $curso['nombre_curso'] . '</option>';
                            }
    $html .= '
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="comentarios" class="form-label">Comentarios</label>
                        <textarea class="form-control" id="comentarios" name="comentarios" placeholder="Ingrese los comentarios" required></textarea>
                    </div>
                    <div class="col-12">
                        <label for="fecha_calificacion" class="form-label">Fecha de Calificación</label>
                        <input type="date" class="form-control" id="fecha_calificacion" name="fecha_calificacion" required>
                    </div>
                    <div class="col-12">
                        <input type="hidden" id="casofrm" name="casofrm" value="guardar_calificaciones">  
                        <input type="hidden" id="idc" name="idc" value="">  
                       <button style="width: 20%;" class="btn btn-success" type="button" onclick="fnc_guardarCalificacion();">Guardar</button>
                    </div>
                </div>
            </form>
        </div> 
        <div class="col-12" style="text-align: center; box-shadow: 5px 1px 12px -4px rgba(0,0,0,0.5); border: 1px solid black;">  
            <h4>Calificaciones Registradas</h4>
            <div> 
                <table id="tbl_calificacion" class="" style="width:100%; border: 1px solid black;">
                    <thead style="background: #BCC7D1;">
                        <tr>
                            <th>N.</th>
                            <th>Curso</th>
                            <th>Comentarios</th>
                            <th>Fecha de Calificación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';
                    
    $calificacion = new clase_calificaciones();
    $calificaciones = $calificacion->getCalificaciones();
    $i = 1;
    foreach ($calificaciones as $val) {
        $html .= '<tr>
                    <td>' . $i . '</td>
                    <td>' . $val['id_curso'] . '</td>
                    <td>' . $val['comentarios'] . '</td>
                    <td>' . $val['fecha_calificacion'] . '</td>
                    <td>
                        <button type="button" class="btn-success" onclick="cargarInfoCalificacion(' . $val['id_calificacion'] . ')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 4 13H3a.5.5 0 0 1-.354-.854z"/>
                            </svg>
                        </button>
                        <button type="button" class="btn-outline-danger" onclick="eliminarCalificacion(' . $val['id_calificacion'] . ')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 .5.5V6h1.5a.5.5 0 0 1 .5.5v.5a.5.5 0 0 1-.5.5H13v6a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7h-.5a.5.5 0 0 1-.5-.5v-.5a.5.5 0 0 1 .5-.5H5V5.5zM4.5 2a.5.5 0 0 1 .5-.5H11a.5.5 0 0 1 .5.5V3h1a1 1 0 0 1 1 1v1h-1.5a.5.5 0 0 1-.5.5H5.5a.5.5 0 0 1-.5-.5H3V4a1 1 0 0 1 1-1h1.5V2z"/>
                            </svg>
                        </button>
                    </td>
                </tr>';
        $i++;
    }
    
    $html .= '</tbody>
                </table>
            </div>
        </div>
    </div>';
    
    echo $html;
}
    





?>


