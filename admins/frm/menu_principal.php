<?php
session_start();
if (isset($_SESSION['usuario']) === TRUE && isset($_SESSION['tiempo']) === TRUE && $_SESSION['usuario'] != "" && $_SESSION['tiempo'] != "") {
    if (!((time() - $_SESSION['tiempo']) > 3000)) {
        include_once '../funciones/funciones.php';
        encabezado("Menu Principal");
        menuPrincipal();
        ?>

    <style>
        .col-12 {
    flex:0 0 100%;
    max-width: 100%;
    /* background-image: linear-gradient(180deg, #741f78 10%, #2f3037 100%); */
    /* background: #741f78; */
    text-align: center;
    }


    </style>
</head>
<body>
    <div class="col-12">
        <div class="row">
            <!-- Contenedor Padre -->
            <div class="col-12" id="col-12">
                <div class="row">
                    <!-- Contenedor Combinado -->
                    <div class="col-12">
                        <div class="col-12">
                            <h2>¡Bienvenido a Pumas Virtual Academy!</h2>
                            <p>En Pumas Virtual Academy, nos enorgullece ofrecerte una experiencia educativa excepcional en el mundo digital. Como líderes en educación online, nuestra misión es proporcionar acceso equitativo a conocimientos de alta calidad, independientemente de tu ubicación o circunstancias personales.</p>
                            <p>Imagina un entorno donde puedes aprender a tu propio ritmo, explorar temas apasionantes y obtener habilidades que impulsarán tu carrera profesional. Desde cursos fundamentales hasta especializaciones avanzadas, nuestra plataforma te ofrece una amplia gama de opciones académicas diseñadas para adaptarse a tus intereses y objetivos.</p>
                            <p>Nuestro equipo de educadores expertos y mentores dedicados está aquí para apoyarte en cada paso del proceso de aprendizaje. Con tecnología de vanguardia y herramientas interactivas, te sumergirás en un entorno educativo dinámico que fomenta la colaboración, la creatividad y el descubrimiento.</p>
                            <p>En Pumas Virtual Academy, no solo te ofrecemos conocimientos; te ofrecemos una comunidad global de estudiantes comprometidos que comparten tu pasión por el aprendizaje. Conéctate con compañeros de todo el mundo, participa en debates enriquecedores y forma parte de una red de contactos que te acompañará durante toda tu vida académica y profesional.</p>
                            <p>Estamos aquí para ayudarte a alcanzar tus sueños y aspiraciones educativas. Únete a nosotros en Pumas Virtual Academy y comienza tu viaje hacia un futuro lleno de posibilidades ilimitadas.</p>
                            
                            
                        </div>
                    </div>
                     <div class="col-12 mb-4">
                        <div class="card shadow container-background">
                            <!-- Puedes agregar más contenido aquí si es necesario -->
                            <img src="../img/logo.jpg" width="width" height="height" alt="alt"/>
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <?php
        piePagina();
    } else {
        session_destroy();
        header('Location: ../login.php');
        exit;
    }
} else {
    session_destroy();
    header('Location: ../login.php');
    exit;
}
?>
