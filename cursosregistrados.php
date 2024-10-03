<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    echo 'ID de usuario no encontrado en la sesión.';
    exit;
}
$usuario = $_SESSION['usuario']; // Ajusta esto según cómo almacenes el nombre de usuario
$id_usuario = $_SESSION['id_usuario'];
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Menu Principal</title>

    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="/PumasVirtualAcademy/admins/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="/PumasVirtualAcademy/admins/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/PumasVirtualAcademy/admins/css/carousel.css" rel="stylesheet">
</head>
<body>

    <!-- Main Content -->
    <main role="main">
          <header>
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlspecialchars($usuario); ?></span>
                        <img class="img-profile rounded-circle" src="/PumasVirtualAcademy/admins/img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Cerrar Sesión
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

        <!-- Carousel -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="first-slide" src="/PumasVirtualAcademy/admins/imagenes/1_bg.jpg" alt="First slide">
                    <div class="container">
                        <div class="carousel-caption text-left">
                            <h1>Bienvenido</h1>
                            <p>Gestiona y accede a tus cursos en línea de manera sencilla. Comienza tu experiencia ahora.</p>
                            <a class="btn btn-lg btn-primary" href="/PumasVirtualAcademy/menuprincipal.php">Iniciar</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="second-slide" src="https://th.bing.com/th/id/R.d7078f8f67fa750fab9704f1e7984ae7?rik=C1T%2bSAoFe0ZYBg&pid=ImgRaw&r=0" alt="Second slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Cursos Disponibles</h1>
                            <p>Explora y descubre los cursos disponibles para mejorar tus habilidades y conocimientos. ¡Comienza hoy mismo!</p>
                            <a href="cursosdisponible.php" class="btn btn-lg btn-primary">Ver Cursos Disponibles</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="first-slide" src="https://th.bing.com/th/id/R.a6d03b5e5f5c7cdd147ff3bbd106f47b?rik=LCeeBizVzFhTaw&riu=http%3a%2f%2frevistavive.com%2fwp-content%2fuploads%2f2018%2f03%2fcursos-online-e1521655311215.jpg&ehk=JkL2PtSy%2fgERgXjGB3naPQMXvlESsAc2G%2fTjercKFy8%3d&risl=&pid=ImgRaw&r=0" alt="Cursos Disponibles">
                    <div class="container">
                        <div class="carousel-caption text-center">
                            <h1>Cursos Registrados</h1>
                            <p>Revisa y gestiona los cursos en los que ya estás inscrito. ¡Mantén tu progreso al día!</p>
                           <a href="cursosregistrados.php" class="btn btn-lg btn-primary">Ver Cursos Registrados</a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        
        
        
  <?php
include_once './admins/clases/clase_cursos.php';


// Puedes obtener el ID del usuario de sesión o de alguna otra fuente
$id_usuario == 0;

$cursos = new clase_cursos();
$lista_cursos = $cursos->getCursosPorUsuario($id_usuario);
?>

<div class="container mt-4">
    <?php foreach ($lista_cursos as $curso): ?>
        <div class="row mb-4 align-items-center">
            <!-- Imagen del curso -->
            <div class="col-md-4">
                <?php if (!empty($curso['foto_curso'])): ?>
                    <img src="./admins/imagenes_cursos/<?php echo htmlspecialchars($curso['foto_curso']); ?>" alt="Imagen del Curso" class="img-fluid rounded" style="width: 100%; object-fit: cover;">
                <?php else: ?>
                    <div class="d-flex justify-content-center align-items-center bg-light" style="height: 200px;">
                        <i class="fas fa-book-open fa-3x text-primary"></i>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Información del curso -->
            <div class="col-md-8 d-flex flex-column">
                <h5 class="text-primary font-weight-bold"><?php echo htmlspecialchars($curso['nombre_curso']); ?></h5>
                <p><strong>Tema:</strong> <?php echo htmlspecialchars($curso['tema']); ?></p>
                <p><strong>Nivel:</strong> <?php echo htmlspecialchars($curso['nivel_curso']); ?></p>
                <p><strong>Descripción:</strong> <?php echo htmlspecialchars($curso['descripcion_curso']); ?></p>
                <p><strong>Fecha de Inicio:</strong> <?php echo htmlspecialchars($curso['fecha_inicio']); ?></p>
                <p><strong>Fecha de Finalización:</strong> <?php echo htmlspecialchars($curso['fecha_finalizacion']); ?></p>
                
                <!-- Botón para registrar el curso -->
                 <a href="contenido.php?id_curso=<?php echo htmlspecialchars($curso['id_curso']); ?>" class="btn btn-lg btn-primary">Ver Lecciones</a>
                <a href="tareas.php?id_curso=<?php echo htmlspecialchars($curso['id_curso']); ?>" class="btn btn-lg btn-primary">Ver Tareas</a>
            </div>
        </div>
        <hr class="featurette-divider">
    <?php endforeach; ?>
</div>


        <!-- FOOTER -->
        <footer class="footer">
            <div class="container">
                <p class="text-center">© 2024 Pumas Virtual Academy. Todos los derechos reservados.</p>
            </div>
        </footer>

    </main>

    <!-- Aviso de cierre de sesión -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listo para cerrar sesión?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está list@ para finalizar su sesión actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="button" onclick="cerrarSesionUsuario()">Cerrar Sesión</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="/PumasVirtualAcademy/admins/js/jquery-3.6.0.js"></script>
    <script src="/PumasVirtualAcademy/admins/js/funciones.js"></script>
    <script src="/PumasVirtualAcademy/admins/assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/PumasVirtualAcademy/admins/vendor/jquery/jquery.min.js"></script>
    <script src="/PumasVirtualAcademy/admins/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/PumasVirtualAcademy/admins/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="/PumasVirtualAcademy/admins/js/sb-admin-2.min.js"></script>
    <script src="/PumasVirtualAcademy/admins/vendor/chart.js/Chart.min.js"></script>
</body>
</html>
