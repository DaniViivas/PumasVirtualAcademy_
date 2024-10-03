
function login() {    
    let u = $("#usuario").val();
    let c = $("#clave").val();
    if(u != "" && c != ""){
        $.ajax({
            url:'./funciones/login.php',
            type:'POST',           
            data: {usuario:u, clave:c},
            success: function(resp) {
                //alert(resp);
                if(resp == 1){
//                    alert("Usuario valido");
                    window.location.href = "../admins/frm/menu_principal.php"; 

  
                }else if(resp == 0){
                    alert("Usuario o Contraseña incorrectos!!!");
                }else{
                    alert("Error al realizar la petición");
                }
            }
         });    
    }else{
        alert("Debe llenar todos los campos para proceder!!!");
    }
    return false;
}


function loginuser() {    
    let u = $("#usuario").val();
    let c = $("#clave").val();
    if(u != "" && c != ""){
        $.ajax({
            url:'/PumasVirtualAcademy/admins/funciones/login.php',
            type:'POST',           
            data: {usuario:u, clave:c},
            success: function(resp) {
                //alert(resp);
                if(resp == 1){
//                    alert("Usuario valido");
                    window.location.href = "/PumasVirtualAcademy/menuprincipal.php"; 

  
                }else if(resp == 0){
                    alert("Usuario o Contraseña incorrectos!!!");
                }else{
                    alert("Error al realizar la petición usuario");
                }
            }
         });    
    }else{
        alert("Debe llenar todos los campos para proceder!!!");
    }
    return false;
}
function cerrarSesionUsuario() {
    $.ajax({
        url:'/PumasVirtualAcademy/admins/funciones/logout.php',
      
        type: 'POST',
        success: function(resp) {
            if (resp == 1) {
                window.location.href = '/PumasVirtualAcademy/'; // Redirige al usuario a la página de inicio de sesión
            } else {
                alert("Error al cerrar la sesión");
            }
        }
    });
}



function cerrarSesion() {
    $.ajax({
        url: '../funciones/logout.php',
        type: 'POST',
        success: function(resp) {
            if (resp == 1) {
                window.location.href = '../login.php'; // Redirige al usuario a la página de inicio de sesión
            } else {
                alert("Error al cerrar la sesión");
            }
        }
    });
}


function frm_agregar_personas() {
   
    
    let caso = "frm_agregar_personas";
    $.ajax({
        url:'../frm/formularios.php',
        type:'POST',           
        data: {caso:caso},
        success: function(resp) {
//            alert(resp); // Muestra la respuesta del servidor en una alerta
            $("#col-12").html(resp); // Actualiza el contenido en #contenedor_principal
       
        }
        
     }); 
}



function fnc_guardarPersona() {
    let valida = true;

    var casofrm = $("#casofrm").val();
    if(casofrm == "casoguardarPersona"){
        // Validar campos de texto y número
        $("#formularioPersonas input[type=text], #formularioPersonas input[type=number]").each(function(){
            if($(this).val().trim() === "" || $(this).val() === 0) {
                valida = false;
            }
        });

        // Validar género y tipo de persona
        if($("#genero").val() == 0 || $("#tipo_persona").val() == 0){
            valida = false;
        }

        // Validar campo de correo electrónico
        let correo = $("#correo").val().trim();
        if(correo === "" || !validateEmail(correo)) {
            valida = false;
        }

        if(valida) {
            let caso = "guardar_personas";
            let formData = new FormData($("#formularioPersonas")[0]); // Usa FormData para incluir archivos

            $.ajax({
                url: './controlador.php?caso=' + caso,
                type: 'POST',
                data: formData,
                processData: false, // No procesar los datos
                contentType: false, // No establecer el Content-Type
                success: function(resp) {
                    alert(resp);
                    if(resp == 3){
                        alert("El registro ya existe en la BD");
                    } else if(resp == 1){
                        alert("Los datos fueron almacenados exitosamente");
                        frm_agregar_personas(); // O la función que recarga el contenido
                    } else {
                        alert("Error al almacenar los datos");
                    }
                }
            });
        } else {
            alert("Por favor llene todos los campos correctamente");
        }
    } else if(casofrm == "casoactualizarPersona") {
        // Validar campos de texto y número
        let valida = true;
        $("#formularioPersonas input[type=text]").each(function(){
            if( ($(this).val() != "" || $(this).val() != 0) && valida == true){
                valida = true;
            } else {
                valida = false;
            }
        });
        if(valida == true){
            if($("#genero").val() != 0 && $("#tipo_persona").val() != 0){
                valida = true;
            } else {
                valida = false;
            }
        }

        // Validar campo de correo electrónico
        let correo = $("#correo").val().trim();
        if(correo === "" || !validateEmail(correo)) {
            valida = false;
        }

        if(valida == true) {
            let caso = "actualizar_personas";
            let formData = new FormData($("#formularioPersonas")[0]); // Usa FormData para incluir archivos

            $.ajax({
                url: './controlador.php?caso=' + caso,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(resp) {
                    alert(resp);
                    if(resp == 1){
                        alert("Los datos fueron actualizados exitosamente");
                        frm_agregar_personas();
                    } else {
                        alert("Error al actualizar los datos");
                    }
                }
            });
        } else {
            alert("Por favor llene todos los campos");
        }
    }
    return false;
}
// Función para validar el formato del correo electrónico
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function eliminarPersona(idpersona) {
    let decision = confirm("Desea eliminar este registro? ");
    if(decision == true){
        let caso = "eliminar_persona";        
        $.ajax({
            url: './controlador.php?caso='+caso,
            type: 'POST',           
            data: {idpersona:idpersona},
            success: function(resp) {
//                alert(resp);
                if(resp == 1){
                   alert("El registro se elimino correctamente!");   
                    // Aquí puedes recargar el contenido o eliminar la fila de la tabla
                    frm_agregar_personas(); //función que recarga el contenido
                }else{
                    alert("Error al eliminar los datos, verifique he intentelo de nuevo");
                }
            }
         }); 
    }
}

function cargarInfoPersona(idpersona) {
    let caso = "cargarInfoPersona";
    $.ajax({
        url: './controlador.php?caso=' + caso,
        type: 'POST',
        data: { idpersona: idpersona },
        success: function(resp) {
            var json = JSON.parse(resp);
            $("#nombrePersona").val(json.nombre);
            $("#apellidoPersona").val(json.apellido);
            $("#dni").val(json.dni);
            $("#edad").val(json.edad);
            $("#telefono").val(json.telefono);
            $("#correo").val(json.correo);
            $("#genero option[value=" + json.genero + "]").prop("selected", true);
            $("#tipo_persona option[value=" + json.id_tipo_empleado_fk + "]").prop("selected", true);
            $("#casofrm").val("casoactualizarPersona");
            $("#idp").val(idpersona);
            
            // Mostrar la foto si existe
            if (json.foto_persona) {
                $("#fotoPersonaPreview").attr("src", json.foto_persona).show();
            } else {
                $("#fotoPersonaPreview").hide();
            }
        }
    });
}






function frm_agregar_usuario() {
    let caso = "frm_agregar_usuario";
    $.ajax({
        url: '../frm/formularios.php',
        type: 'POST',
        data: { caso: caso },
        success: function(resp) {
            $("#col-12").html(resp);
        }
    });
}

function registrarUsuarioYDatos(event) {
    event.preventDefault(); // Evitar que se recargue la página
    
    // Primero, registra el usuario
    registrarUsuario(function(success) {
        if (success) {
            // Luego, registra los datos personales
            registrarUsuarioDatos();
        }
    });
}

function registrarUsuarioDatos() {
    let formData = new FormData(document.getElementById('registroForm'));

    $.ajax({
        url: '/PumasVirtualAcademy/admins/frm/controlador.php?caso=guardar_personas',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response == 1) {
                alert('Datos personales registrados exitosamente');
            } 
        },
        error: function(xhr, status, error) {
            alert('Ocurrió un error: ' + error);
        }
    });
}
function registrarCurso(id_curso, id_usuario) {
    console.log("ID Curso:", id_curso);
    console.log("ID Usuario:", id_usuario);

    $.ajax({
        url: './admins/clases/clase_registro.php',
        type: 'POST',
        data: {
            id_curso: id_curso,
            id_usuario: id_usuario
        },
        success: function(response) {
            $('#mensaje-registro').html('<p>Curso registrado exitosamente.</p>');
        },
        error: function(xhr, status, error) {
            $('#mensaje-registro').html('<p>Error al registrar el curso.</p>');
            console.error("Error en la solicitud AJAX:", error);
        }
    });
}

function registrarUsuario(callback) {
    const usuario = document.getElementById('usuarioRegistro').value;
    const clave = document.getElementById('claveRegistro').value;

    $.ajax({
        url: '/PumasVirtualAcademy/admins/frm/controlador.php?caso=guardar_usuarios',
        type: 'POST',
        data: {
            Usuario: usuario,
            clave: clave
        },
        success: function(response) {
            if (response == 1) {
                alert('Usuario registrado exitosamente');
                callback(true); // Llamar al callback si el registro es exitoso
            } else {
                alert('Ocurrió un error al registrar el usuario.');
                callback(false); // Llamar al callback con false en caso de error
            }
        },
        error: function(xhr, status, error) {
            alert('Ocurrió un error: ' + error);
            callback(false); // Llamar al callback con false en caso de error
        }
    });
}

function fnc_guardarUsuario() {
    let valida = true;

    var casofrm = $("#casofrm").val();
    if (casofrm == "casoguardarUsuario") {
        $("#formularioUsuarios input[type=text], #formularioUsuarios input[type=password]").each(function() {
            if ($(this).val().trim() === "") {
                valida = false;
            }
        });

        if (valida) {
            let caso = "guardar_usuarios";
            let formData = new FormData($("#formularioUsuarios")[0]);

            $.ajax({
                url: './controlador.php?caso=' + caso,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(resp) {
                    if (resp == 3) {
                        alert("El registro ya existe en la BD");
                    } else if (resp == 1) {
                        alert("Los datos fueron almacenados exitosamente");
                        frm_agregar_usuario();
                    } else {
                        alert("Error al almacenar los datos");
                    }
                }
            });
        } else {
            alert("Por favor llene todos los campos correctamente");
        }
    } else if (casofrm == "casoactualizarUsuario") {
        $("#formularioUsuarios input[type=text], #formularioUsuarios input[type=password]").each(function() {
            if ($(this).val().trim() === "") {
                valida = false;
            }
        });

        if (valida) {
            let caso = "actualizar_usuarios";
            let formData = new FormData($("#formularioUsuarios")[0]);

            $.ajax({
                url: './controlador.php?caso=' + caso,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(resp) {
                    if (resp == 1) {
                        alert("Los datos fueron actualizados exitosamente");
                        frm_agregar_usuario();
                    } else {
                        alert("Error al actualizar los datos");
                    }
                }
            });
        } else {
            alert("Por favor llene todos los campos");
        }
    }
    return false;
}

function eliminarUsuario(idusuario) {
    let decision = confirm("Desea eliminar este registro?");
    if (decision == true) {
        let caso = "eliminar_usuario";
        $.ajax({
            url: './controlador.php?caso=' + caso,
            type: 'POST',
            data: { idusuario: idusuario },
            success: function(resp) {
                if (resp == 1) {
                    alert("El registro se eliminó correctamente!");
                    frm_agregar_usuario();
                } else {
                    alert("Error al eliminar los datos, verifique e inténtelo de nuevo");
                }
            }
        });
    }
}

function cargarInfoUsuario(idusuario) {
    let caso = "cargarInfoUsuario";
    $.ajax({
        url: './controlador.php?caso=' + caso,
        type: 'POST',
        data: { idusuario: idusuario },
        success: function(resp) {
            var json = JSON.parse(resp);
            $("#Usuario").val(json.usuario);
            $("#clave").val(json.clave);
            $("#casofrm").val("casoactualizarUsuario");
            $("#idu").val(idusuario);
        }
    });
}








function frm_ver_usuarios() {
    let caso = "frm_ver_usuarios";
    $.ajax({
        url: '../frm/formularios.php',
        type: 'POST',
        data: { caso: caso },
        success: function(resp) {
            $("#col-12").html(resp); // Actualiza el contenido en #col-12
        }
    });
}


// LOGICA DEL SEGUNDO MODULO
//LOGICA PARA MODULO GESTION DE CURSOS :)



function eliminarCurso(idcurso) {
    let decision = confirm("¿Desea eliminar este curso?");
    if (decision == true) {
        let caso = "eliminar_curso";
        $.ajax({
            url: './controladorCursos.php?caso=' + caso,
            type: 'POST',
            data: { idcurso: idcurso },
            success: function(resp) {
                if (resp == 1) {
                    alert("El curso se eliminó correctamente");
                    frm_agregar_cursos(); // Recarga el contenido
                } else {
                    alert("Error al eliminar el curso, verifique e intente de nuevo: " + resp);
                }
            }
        });
    }
}

// Función para cargar el formulario para agregar un nuevo curso
function frm_agregar_cursos() {
    let caso = "frm_agregar_cursos";
    $.ajax({
        url: '../frm/formularios.php',
        type: 'POST',
        data: { caso: caso },
        success: function(resp) {
            $("#col-12").html(resp); // Actualiza el contenido en #col-12
            // Establecer casofrm a casoguardarCurso para el nuevo formulario
            $("#casofrm").val("casoguardarCurso");
        }
    });
}

// Función para guardar o actualizar un curso
function fnc_guardarCurso() {
    let valida = true;
    $("#formularioCursos input[type=text], #formularioCursos input[type=date], #formularioCursos textarea, #formularioCursos select").each(function() {
        if ($(this).val().trim() === "" || $(this).val() === null) {
            valida = false;
        }
    });

    if (valida) {
        let casofrm = $("#casofrm").val();
        let caso = casofrm === "casoguardarCurso" ? "guardar_cursos" : "actualizar_cursos";
        let formData = new FormData($("#formularioCursos")[0]);
        formData.append("caso", caso);

        $.ajax({
            url: './controladorCursos.php?caso=' + caso,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(resp) {
                alert(resp);
                if (resp == 1) {
                    let message = casofrm === "casoguardarCurso" ? "El curso fue almacenado exitosamente" : "El curso fue actualizado exitosamente";
                    alert(message);
                    frm_agregar_cursos(); // Recarga el contenido y restablece el formulario para agregar un nuevo curso
                } else {
                    alert("Error al almacenar el curso: " + resp);
                }
            }
        });
    } else {
        alert("Por favor llene todos los campos correctamente");
    }
    return false;
}





function cargarInfoCurso(idcurso) {
    let caso = "cargarInfoCurso";
    $.ajax({
        url: './controladorCursos.php?caso=' + caso,
        type: 'POST',
        data: { idcurso: idcurso },
        success: function(resp) {
            var json = JSON.parse(resp);
            $("#nombreCurso").val(json.nombre_curso);
            $("#tema").val(json.tema);
            $("#descripcionCurso").val(json.descripcion_curso);
            $("#nivelCurso option[value=" + json.nivel_curso + "]").prop("selected", true);
            $("#fechaInicio").val(json.fecha_inicio);
            $("#fechaFinalizacion").val(json.fecha_finalizacion);
//            $("#imagenCurso").val(json.imagen_curso);
            $("#tbl_persona_id_persona").val(json.tbl_persona_id_persona);
            $("#casofrm").val("casoactualizarCurso");
            $("#idc").val(idcurso);
        }
    });
}



//LOGICA PARA MODULO GESTION DE TAREA :)

// Función para cargar el formulario para agregar una nueva tarea
function frm_agregar_tareas() {
    let caso = "frm_agregar_tareas";
    $.ajax({
        url: '../frm/formularios.php',
        type: 'POST',
        data: { caso: caso },
        success: function(resp) {
            $("#col-12").html(resp); // Actualiza el contenido en #col-12
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", status, error);
        }
    });
}



// Función para guardar o actualizar una tarea
function fnc_guardarTarea() {
    let valida = true;

    // Validar que todos los campos del formulario estén llenos
    $("#formularioTareas input[type=text], #formularioTareas input[type=date], #formularioTareas textarea, #formularioTareas select").each(function() {
        if ($(this).val().trim() === "" || $(this).val() === null) {
            valida = false;
        }
    });

    if (valida) {
        // Determinar si se está guardando o actualizando
        let casofrm = $("#casofrm").val();
        let caso = casofrm === "guardar_tareas" ? "guardar_tareas" : "actualizar_tareas";
        let formData = new FormData($("#formularioTareas")[0]);
        formData.append("caso", caso);

        // Realizar la petición AJAX para guardar o actualizar la tarea
        $.ajax({
            url: './controladorTareas.php?caso=' + caso,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(resp) {
                if (resp == 1) {
                    let message = casofrm === "guardar_tareas" ? "La tarea fue almacenada exitosamente" : "La tarea fue actualizada exitosamente";
                    alert(message);
                    frm_agregar_tareas(); // Recarga el contenido y restablece el formulario para agregar una nueva tarea
                } else {
                    alert("Error al almacenar la tarea: " + resp);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error en la petición AJAX:", status, error);
                alert("Ocurrió un error en la comunicación con el servidor. Intente nuevamente.");
            }
        });
    } else {
        alert("Por favor llene todos los campos correctamente");
    }
    return false;
}
// Función para eliminar una tarea
function eliminarTarea(idtarea) {
    let decision = confirm("¿Desea eliminar esta tarea?");
    if (decision == true) {
        let caso = "eliminar_tareas";
        $.ajax({
            url: './controladorTareas.php',
            type: 'POST',
            data: { caso: caso, idtarea: idtarea },
            success: function(resp) {
                if (resp == 1) {
                    alert("La tarea se eliminó correctamente");
                    frm_agregar_tareas(); // Recarga el contenido
                } else {
                    alert("Error al eliminar la tarea, verifique e intente de nuevo: " + resp);
                }
            }
        });
    }
}

function cargarInfoTarea(idtarea) {
    let caso = "cargarInfoTarea";
    $.ajax({
        url: './controladorTareas.php',
        type: 'POST',
        data: { caso: caso, idtarea: idtarea },
        success: function(resp) {
            console.log(resp); // Para verificar la respuesta del servidor
            var json = JSON.parse(resp);
            $("#id_curso").val(json.id_curso);
            $("#titulo_tarea").val(json.titulo_tarea);
            $("#descripcion").val(json.descripcion);
            $("#fecha_entrega").val(json.fecha_entrega);
            $("#criterios_evaluacion").val(json.criterios_evaluacion);
            $("#puntuacion_maxima").val(json.puntuacion_maxima);
            $("#casofrm").val("actualizar_tareas");
            $("#idt").val(idtarea);
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", status, error);
        }
    });
}

//SECCION PARA AGREGAR LECCIONES
// Función para cargar el formulario para agregar una nueva lección
function frm_agregar_lecciones() {
    let caso = "frm_agregar_lecciones";
    $.ajax({
        url: '../frm/formularios.php',
        type: 'POST',
        data: { caso: caso },
        success: function(resp) {
            $("#col-12").html(resp); // Actualiza el contenido en #col-12
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", status, error);
        }
    });
}

// Función para guardar o actualizar una lección
function fnc_guardarLeccion() {
    let valida = true;
    $("#formularioLecciones input[type=text], #formularioLecciones input[type=date], #formularioLecciones textarea, #formularioLecciones select").each(function() {
        if ($(this).val().trim() === "" || $(this).val() === null) {
            valida = false;
        }
    });

    if (valida) {
        let casofrm = $("#casofrm").val();
        let caso = casofrm === "guardar_lecciones" ? "guardar_lecciones" : "actualizar_lecciones";
        let formData = new FormData($("#formularioLecciones")[0]);

        formData.append("caso", caso);

        $.ajax({
            url: './controladorLecciones.php?caso=' + caso,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(resp) {
                alert(resp);
                if (resp == 1) {
                    frm_agregar_lecciones(); // Recarga el contenido y restablece el formulario
                } else {
                    alert("Error al almacenar la lección: " + resp);
                }
            }
        });
    } else {
        alert("Por favor llene todos los campos correctamente");
    }
    return false;
}

// Función para eliminar una lección
function eliminarLeccion(idleccion) {
    let decision = confirm("¿Desea eliminar esta lección?");
    if (decision == true) {
        let formData = new FormData();
        formData.append("caso", "eliminar_lecciones");
        formData.append("idleccion", idleccion);

        $.ajax({
            url: './controladorLecciones.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(resp) {
                if (resp == 1) {
                    alert("La lección se eliminó correctamente");
                    frm_agregar_lecciones(); // Recarga el contenido
                } else {
                    alert("Error al eliminar la lección, verifique e intente de nuevo: " + resp);
                }
            }
        });
    }
}

// Función para cargar la información de una lección en el formulario
function cargarInfoLeccion(idleccion) {
    let caso = "cargarInfoLeccion";
    $.ajax({
        url: './controladorLecciones.php',
        type: 'POST',
        data: { caso: caso, idleccion: idleccion },
        success: function(resp) {
            console.log(resp); // Para verificar la respuesta del servidor
            var json = JSON.parse(resp);
            $("#id_curso").val(json.id_curso);
            $("#titulo_leccion").val(json.titulo_leccion);
            $("#contenido").val(json.contenido);
            $("#fecha_publicacion").val(json.fecha_publicacion);
            $("#casofrm").val("actualizar_lecciones");
            $("#idl").val(idleccion);
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", status, error);
        }
    });
}

//LOGICA PARA AGREGAR SUBIR CALIFICACIONES

// Función para cargar el formulario para agregar una nueva calificación
function frm_agregar_calificaciones() {
    let caso = "frm_agregar_calificaciones";
    $.ajax({
        url: '../frm/formularios.php',
        type: 'POST',
        data: { caso: caso },
        success: function(resp) {
            $("#col-12").html(resp); // Actualiza el contenido en #col-12
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", status, error);
        }
    });
}

// Función para guardar o actualizar una calificación
function fnc_guardarCalificacion() {
    let valida = true;
    $("#formularioCalificaciones input[type=text], #formularioCalificaciones textarea, #formularioCalificaciones select").each(function() {
        if ($(this).val().trim() === "" || $(this).val() === null) {
            valida = false;
        }
    });

    if (valida) {
        let casofrm = $("#casofrm").val();
        let caso = casofrm === "guardar_calificaciones" ? "guardar_calificaciones" : "actualizar_calificaciones";
        let formData = new FormData($("#formularioCalificaciones")[0]);
        formData.append("caso", caso);

        $.ajax({
            url: './controladorCalificaciones.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(resp) {
                alert(resp);
                if (resp == 1) {
                    frm_agregar_calificaciones(); // Recarga el contenido y restablece el formulario
                } else {
                    alert("Error al almacenar la calificación: " + resp);
                }
            }
        });
    } else {
        alert("Por favor llene todos los campos correctamente");
    }
    return false;
}

// Función para eliminar una calificación
function eliminarCalificacion(idcalificacion) {
    let decision = confirm("¿Desea eliminar esta calificación?");
    if (decision == true) {
        let caso = "eliminar_calificaciones";
        $.ajax({
            url: './controladorCalificaciones.php',
            type: 'POST',
            data: { caso: caso, idcalificacion: idcalificacion },
            success: function(resp) {
                if (resp == 1) {
                    alert("La calificación se eliminó correctamente");
                    frm_agregar_calificaciones(); // Recarga el contenido
                } else {
                    alert("Error al eliminar la calificación, verifique e intente de nuevo: " + resp);
                }
            }
        });
    }
}

function cargarInfoCalificacion(idcalificacion) {
    let caso = "cargarInfoCalificacion";
    $.ajax({
        url: './controladorCalificaciones.php',
        type: 'POST',
        data: { caso: caso, idcalificacion: idcalificacion },
        success: function(resp) {
            console.log("Respuesta del servidor:", resp); // Verifica el contenido de la respuesta
            
            // Verifica si la respuesta es un objeto y actúa en consecuencia
            if (typeof resp === 'object') {
                var json = resp; // La respuesta ya es un objeto
            } else {
                try {
                    var json = JSON.parse(resp); // Intenta parsear si es una cadena
                } catch (e) {
                    console.error("Error al parsear JSON:", e);
                    return;
                }
            }
            
            $("#id_curso").val(json.id_curso);
            $("#comentarios").val(json.comentarios);
            $("#fecha_calificacion").val(json.fecha_calificacion);
            $("#casofrm").val("actualizar_calificaciones");
            $("#idc").val(idcalificacion);
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", status, error);
        }
    });
}

