
<?php

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistema de Gestión de Tareas</title>
<style>
    body {
        font-family: 'Roboto Slab', serif;
        background-color: #81007f;
        padding: 20px;
        color: black; /* Color de fuente a negro */
    }
    .main-container {
        display: flex;
        gap: 20px;
        max-width: 1200px;
        margin: 0 auto; /* Centrar el contenido */
    }
    .container {
        background-color: #e0e0e0; /* Cambio de color de fondo de los contenedores */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        flex: 1;
        max-width: 600px; /* Ancho máximo ajustado */
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: black; /* Color de los encabezados */
    }
    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: black; /* Color de las etiquetas */
    }
    input[type="text"], input[type="date"], select {
        width: calc(100% - 16px);
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        color: black; /* Color del texto de entrada */
    }
    textarea {
        width: calc(100% - 16px);
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        resize: vertical;
        color: black; /* Color del texto de entrada */
    }
    input[type="submit"] {
        background-color: #81007f;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        margin-right: 10px;
    }
    input[type="submit"]:hover {
        background-color: #670066;
    }
    .btn-registrar {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        display: none; /* Ocultamos el botón inicialmente */
    }
    .btn-registrar:hover {
        background-color: #0056b3;
    }
    .tarea {
        margin-bottom: 10px;
        padding: 10px;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        border-radius: 4px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .tarea-content {
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    .tarea h3 {
        margin-top: 0;
        color: #81007f;
    }
    .tarea p {
        color: #555;
    }
    .tarea-buttons {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-left: 20px;
    }
    .tarea-buttons button {
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
    }
    .tarea-buttons .btn-editar {
        background-color: #4caf50;
        color: white;
    }
    .tarea-buttons .btn-editar:hover {
        background-color: #388e3c;
    }
    .tarea-buttons .btn-eliminar {
        background-color: #f44336;
        color: white;
    }
    .tarea-buttons .btn-eliminar:hover {
        background-color: #d32f2f;
    }

    /* Estilos para dispositivos móviles */
    @media screen and (max-width: 768px) {
        .main-container {
            flex-direction: column;
        }
        .container {
            margin-bottom: 20px;
        }
    }
</style>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var tareasRegistradas = []; // Arreglo para almacenar las tareas registradas temporalmente

    var form = document.getElementById("formAgregarTarea");
    form.addEventListener("submit", function(event) {
        event.preventDefault(); // Evitar envío directo del formulario

        var tituloTarea = document.getElementById("titulo_tarea").value;
        var descripcionTarea = document.getElementById("descripcion").value;
        var fechaEntrega = document.getElementById("fecha_entrega").value;
        var criteriosEvaluacion = document.getElementById("criterios_evaluacion").value;
        var puntuacionMaxima = document.getElementById("puntuacion_maxima").value;

        agregarTarea(tituloTarea, descripcionTarea, fechaEntrega, criteriosEvaluacion, puntuacionMaxima);
        form.reset(); // Reinicia el formulario después de agregar la tarea
    });

    function agregarTarea(titulo, descripcion, fechaEntrega, criteriosEvaluacion, puntuacionMaxima) {
        var tarea = {
            titulo: titulo,
            descripcion: descripcion,
            fechaEntrega: fechaEntrega,
            criteriosEvaluacion: criteriosEvaluacion,
            puntuacionMaxima: puntuacionMaxima
        };

        tareasRegistradas.push(tarea); // Agregar la tarea al arreglo

        // Crear una tarjeta de tarea y agregarla al contenedor
        var container2 = document.querySelector(".container2");
        var tareaCard = document.createElement("div");
        tareaCard.className = "tarea";
        tareaCard.innerHTML = `
            <div class="tarea-content">
                <h3>${titulo}</h3>
                <p><strong>Descripción:</strong> ${descripcion}</p>
                <p><strong>Fecha de Entrega:</strong> ${fechaEntrega}</p>
                <p><strong>Criterios de Evaluación:</strong> ${criteriosEvaluacion}</p>
                <p><strong>Puntuación Máxima:</strong> ${puntuacionMaxima}</p>
            </div>
            <div class="tarea-buttons">
                <button class="btn-editar">Editar</button>
                <button class="btn-eliminar">Eliminar</button>
            </div>
        `;
        container2.appendChild(tareaCard);

        // Mostrar el botón "Registrar Tareas" si hay tareas registradas
        var btnRegistrar = document.querySelector(".btn-registrar");
        if (tareasRegistradas.length > 0) {
            btnRegistrar.style.display = "inline-block";
        }
    }

    var btnRegistrar = document.querySelector(".btn-registrar");
    btnRegistrar.addEventListener("click", function() {
        registrarTareas();
    });

    function registrarTareas() {
        console.log("Tareas a registrar:", tareasRegistradas);
        // Aquí puedes implementar la lógica para enviar las tareas a la base de datos utilizando Ajax
        // Ejemplo: enviarTareas(tareasRegistradas);
    }
});
</script>
</head>
<body>
    <div class="main-container">
        <div class="container">
            <h2>Formulario para Agregar Tareas</h2>
            <form id="formAgregarTarea" method="POST">
                <label for="titulo_tarea">Título de la Tarea</label>
                <input type="text" id="titulo_tarea" name="titulo_tarea" required>

                <label for="descripcion">Descripción de la Tarea</label>
                <textarea id="descripcion" name="descripcion" rows="4" required></textarea>

                <label for="fecha_entrega">Fecha de Entrega</label>
                <input type="date" id="fecha_entrega" name="fecha_entrega" required>

                <label for="criterios_evaluacion">Criterios de Evaluación</label>
                <textarea id="criterios_evaluacion" name="criterios_evaluacion" rows="4" required></textarea>

                <label for="puntuacion_maxima">Puntuación Máxima</label>
                <input type="number" id="puntuacion_maxima" name="puntuacion_maxima" required>

                <input type="submit" value="Agregar Tarea">
            </form>
            <button class="btn-registrar">Registrar Tareas</button>
        </div>
        <div class="container container2">
            <h2>Tareas Registradas</h2>
            <!-- Aquí se mostrarán las tareas registradas -->
        </div>
    </div>
</body>
</html>
