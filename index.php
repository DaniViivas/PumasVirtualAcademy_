<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link href="./admins/css/Login.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3a7225da88.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./admins/assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">

                <!-- Formulario de Iniciar Sesión -->
                <form id="loginForm" method="POST" class="sign-in-form">
                    <h2 class="title">Iniciar Sesión</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" class="form-control" id="clave" name="clave" placeholder="Contraseña" required />
                    </div>
                    <button class="btn solid w-100 btn-lg btn-primary" type="button" onclick="loginuser();">Iniciar</button>
                </form>

              <!-- Formulario de Registro -->
<!-- Formulario de Registro -->
<form id="registroForm" class="sign-up-form" onsubmit="registrarUsuarioYDatos(event)" enctype="multipart/form-data">
    <h2 class="signup title">Regístrate</h2>
    
    <!-- Datos Personales -->
    <div class="input-field">
        <i class="fas fa-user"></i>
        <input type="text" id="nombrePersona" name="nombrePersona" placeholder="Nombre" required />
    </div>
    <div class="input-field">
        <i class="fas fa-user"></i>
        <input type="text" id="apellidoPersona" name="apellidoPersona" placeholder="Apellido" required />
    </div>
    <div class="input-field">
        <i class="fas fa-id-card"></i>
        <input type="text" id="dni" name="dni" placeholder="DNI" required />
    </div>
    <div class="input-field">
        <i class="fas fa-calendar"></i>
        <input type="number" id="edad" name="edad" placeholder="Edad" required />
    </div>
    <div class="input-field">
        <i class="fas fa-phone"></i>
        <input type="text" id="telefono" name="telefono" placeholder="Teléfono" required />
    </div>
    <div class="input-field">
        <i class="fas fa-venus-mars"></i>
        <select class="input-field" id="genero" name="genero" required>
            <option value="0">Seleccione</option>
            <option value="1">Masculino</option>
            <option value="2">Femenino</option>
        </select>
    </div>
    <div class="input-field">
        <i class="fas fa-envelope"></i>
        <input type="email" id="correo" name="correo" placeholder="Correo" required />
    </div>
    <input type="hidden" id="tipo_persona" name="tipo_persona" value="3" />
    <div class="input-field">
        <i class="fas fa-camera"></i>
        <input type="file" id="fotoPersona" name="fotoPersona" accept="image/*">
    </div>

    <!-- Datos de Usuario -->
    <div class="input-field">
        <i class="fas fa-user"></i>
        <input type="text" id="usuarioRegistro" name="usuarioRegistro" placeholder="Usuario" required>
    </div>
    <div class="input-field">
        <i class="fas fa-lock"></i>
        <input type="password" id="claveRegistro" name="claveRegistro" placeholder="Password" required>
    </div>

    <button type="submit" class="btn solid">Sign Up</button>
</form>



            </div>
        </div>

        <!-- Paneles de Información -->
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Nuevo por aquí?</h3>
                    <p>Regístrate</p>
                    <button class="btn transparent" id="sign-up-btn">Sign Up</button>
                </div>
                <img src="./admins/img/log.png" class="image" alt="">
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <h3>Ya estás registrado?</h3>
                    <p>Toca aquí para iniciar sesión</p>
                    <button class="btn transparent" id="sign-in-btn">Sign In</button>
                </div>
                <img src="./admins/img/register.svg" class="image" alt="">
            </div>
        </div>
    </div>

    <script src="./admins/js/app.js"></script>
    <script src="./admins/js/jquery-3.6.0.js"></script>
    <script src="./admins/js/funciones.js"></script>
</body>
</html>
