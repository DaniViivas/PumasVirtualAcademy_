<?php
session_start(); // Asegúrate de que la sesión esté iniciada


$usuario = $_SESSION['usuario']; // Ajusta esto según cómo almacenes el nombre de usuario
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
                                <a class="btn btn-lg btn-primary" href="/PumasVirtualAcademy/menuprincipal.php">Inicio</a>

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

        
        <!-- Marketing messaging and featurettes -->
        <div class="container marketing">

            <!-- Three columns of text below the carousel -->
          <div class="row">
    <div class="col-lg-4">
        <img class="rounded-circle" src="https://th.bing.com/th/id/R.8fe095d8264e220d46724f2bcebcd7b7?rik=43nKbZUKMVUkCQ&pid=ImgRaw&r=0" alt="Variedad de cursos" width="140" height="140">
        <h2>En nuestra página encontrarás</h2>
        <p>Una gran variedad de cursos para todas las áreas y niveles.</p>
        <p><a class="btn btn-secondary" href="#" role="button">Ver detalles &raquo;</a></p>
    </div><!-- /.col-lg-4 -->
    <div class="col-lg-4">
        <img class="rounded-circle" src="https://th.bing.com/th/id/R.074ce283c8ab311c36425c0b5b104dc2?rik=1lgIbodfVhbU5w&pid=ImgRaw&r=0" alt="Comienza hoy" width="140" height="140">
        <h2>Comienza hoy</h2>
        <p>Y no pierdas más el tiempo. Inscríbete y mejora tus habilidades.</p>
        <p><a class="btn btn-secondary" href="#" role="button">Ver detalles &raquo;</a></p>
    </div><!-- /.col-lg-4 -->
    <div class="col-lg-4">
        <img class="rounded-circle" src="https://th.bing.com/th/id/R.5e4b5e73c1d3b0aae2bf7e834b439a0a?rik=skcEfH7V%2bFojpQ&pid=ImgRaw&r=0" alt="Aprende a tu ritmo" width="140" height="140">
        <h2>Aprende a tu ritmo</h2>
        <p>Disfruta de la flexibilidad de estudiar cuando y donde quieras.</p>
        <p><a class="btn btn-secondary" href="#" role="button">Ver detalles &raquo;</a></p>
    </div><!-- /.col-lg-4 -->
</div><!-- /.row -->

<!-- START THE FEATURETTES -->

<hr class="featurette-divider">

<div class="row featurette">
    <div class="col-md-7">
        <h2 class="featurette-heading">La educación del futuro <span class="text-muted">está aquí</span></h2>
        <p class="lead">Descubre cómo la educación en línea puede transformar tu vida, brindándote acceso a conocimientos sin límites desde cualquier lugar del mundo.</p>
    </div>
    <div class="col-md-5">
        <img class="featurette-image img-fluid mx-auto" src="https://sarrauteducacion.com/wp-content/uploads/2020/09/educacion-online-1600435637333.jpg" alt="Educación en línea">
    </div>
</div>

<hr class="featurette-divider">

<div class="row featurette">
    <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Estudia a tu propio ritmo <span class="text-muted">y en tus propios términos</span></h2>
        <p class="lead">Con nuestros cursos en línea, tú decides cuándo y dónde estudiar. Flexibilidad y comodidad al alcance de tu mano.</p>
    </div>
    <div class="col-md-5 order-md-1">
        <img class="featurette-image img-fluid mx-auto" src="https://th.bing.com/th/id/OIP.t6BM8IZgU_VceSI4lREYVwHaE8?rs=1&pid=ImgDetMain" alt="Estudio flexible">
    </div>
</div>

<hr class="featurette-divider">

<div class="row featurette">
    <div class="col-md-7">
        <h2 class="featurette-heading">Tu éxito comienza aquí <span class="text-muted">¡Inscríbete hoy!</span></h2>
        <p class="lead">No esperes más para dar el siguiente paso en tu carrera. Nuestros cursos están diseñados para ayudarte a alcanzar tus metas.</p>
    </div>
    <div class="col-md-5">
        <img class="featurette-image img-fluid mx-auto" src="https://th.bing.com/th/id/OIP.WLM9JwEGMxirs6DL3Gr5AwHaE8?rs=1&pid=ImgDetMain" alt="Éxito profesional">
    </div>
</div>


            <hr class="featurette-divider">

        </div><!-- /.container -->

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

