<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistema de Información de Cursos y Foros</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
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
    input[type="file"] {
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
    .foro {
        margin-bottom: 10px;
        padding: 10px;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        border-radius: 4px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .foro-content {
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    .foro h3 {
        margin-top: 0;
        color: #81007f;
    }
    .foro p {
        color: #555;
    }
    .foro-buttons {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-left: 20px;
    }
    .foro-buttons button {
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
    }
    .foro-buttons .btn-editar {
        background-color: #4caf50;
        color: white;
    }
    .foro-buttons .btn-editar:hover {
        background-color: #388e3c;
    }
    .foro-buttons .btn-eliminar {
        background-color: #f44336;
        color: white;
    }
    .foro-buttons .btn-eliminar:hover {
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
    var forosRegistrados = []; // Arreglo para almacenar los foros registrados temporalmente

    var formForo = document.getElementById("formAgregarForo");
    formForo.addEventListener("submit", function(event) {
        event.preventDefault(); // Evitar envío directo del formulario

        var cursoId = document.getElementById("curso_id").value;
        var tituloForo = document.getElementById("titulo_foro").value;
        var descripcionForo = document.getElementById("descripcion_foro").value;

        agregarForo(cursoId, tituloForo, descripcionForo);
        formForo.reset(); // Reinicia el formulario después de agregar el foro
    });

    function agregarForo(cursoId, titulo, descripcion) {
        var foro = {
            id: Date.now(), // Generar un ID único basado en la fecha y hora actual
            cursoId: cursoId,
            titulo: titulo,
            descripcion: descripcion
        };

        forosRegistrados.push(foro); // Agregar el foro al arreglo

        // Crear una tarjeta de foro y agregarla al contenedor
        var containerForo = document.querySelector(".container-foro");
        var foroCard = document.createElement("div");
        foroCard.className = "foro";
        foroCard.setAttribute("data-id", foro.id);
        foroCard.innerHTML = `
            <div class="foro-content">
                <h3>${titulo}</h3>
                <p><strong>Curso ID:</strong> ${cursoId}</p>
                <p><strong>Descripción:</strong> ${descripcion}</p>
            </div>
            <div class="foro-buttons">
                <button class="btn-editar">Editar</button>
                <button class="btn-eliminar">Eliminar</button>
            </div>
        `;
        containerForo.appendChild(foroCard);

        // Mostrar el botón "Registrar Foro" si hay foros registrados
        var btnRegistrarForo = document.querySelector(".btn-registrar-foro");
        if (forosRegistrados.length > 0) {
            btnRegistrarForo.style.display = "block";
        }

        // Añadir eventos a los botones de editar y eliminar
        foroCard.querySelector(".btn-editar").addEventListener("click", function() {
            editarForo(foro.id);
        });
        foroCard.querySelector(".btn-eliminar").addEventListener("click", function() {
            eliminarForo(foro.id);
        });
    }

    function eliminarForo(id) {
        forosRegistrados = forosRegistrados.filter(foro => foro.id !== id);
        document.querySelector(`.foro[data-id="${id}"]`).remove();
    }

    function editarForo(id) {
        var foro = forosRegistrados.find(foro => foro.id === id);
        if (foro) {
            document.getElementById("curso_id").value = foro.cursoId;
            document.getElementById("titulo_foro").value = foro.titulo;
            document.getElementById("descripcion_foro").value = foro.descripcion;

            eliminarForo(id); // Eliminar el foro antiguo después de cargar los datos en el formulario
        }
    }

    var btnRegistrarForo = document.querySelector(".btn-registrar-foro");
    btnRegistrarForo.addEventListener("click", function() {
        registrarForos();
    });

    function registrarForos() {
        console.log("Foros a registrar:", forosRegistrados);
        // Aquí puedes implementar la lógica para enviar los foros a la base de datos
        // Ejemplo: enviarForos(forosRegistrados);
    }
});
</script>
</head>
<body>
    <div class="main-container">
        <div class="container">
            <h2>Formulario para Agregar Foros</h2>
            <form id="formAgregarForo" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="curso_id">ID del Curso</label>
                <input type="text" id="curso_id" name="curso_id" required>

                <label for="titulo_foro">Título del Foro</label>
                <input type="text" id="titulo_foro" name="titulo_foro" required>

                <label for="descripcion_foro">Descripción</label>
                <textarea id="descripcion_foro" name="descripcion_foro" rows="4" required></textarea>

                <input type="submit" value="Agregar Foro">
            </form>
        </div>
        <div class="container">
            <h2>Foros Registrados</h2>
            <div class="container-foro">
                <!-- Aquí se mostrarán los foros registrados -->
            </div>
            <button class="btn-registrar-foro">Registrar Foros</button>
        </div>
    </div>
</body>
</html>
