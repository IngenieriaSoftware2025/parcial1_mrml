<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="build/js/app.js"></script>
    <link rel="shortcut icon" href="<?= asset('images/cit.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= asset('build/styles.css') ?>">
    <title>DemoApp</title>
</head>

    <style>
    /* Estilos para la página de bienvenida */
    
    .text-pink { color:rgb(94, 1, 1); }
    .text-purple { color:rgb(255, 255, 255); }
    .border-pink { border-color:rgb(0, 0, 0) !important; }
    .border-purple { border-color:rgb(0, 0, 0) !important; }

    .btn-pink {
        background-color:rgb(0, 0, 0);
        color: white;
    }
    .btn-pink:hover {
        background-color:rgb(0, 0, 0);
    }

    .btn-lavender {
        background-color:rgb(0, 0, 0);
        color: white;
    }
    .btn-lavender:hover {
        background-color:rgb(0, 0, 0);
    }

    
    body {
        background: linear-gradient(135deg,rgb(0, 0, 0)rgb(255, 255, 255)bbd0 100%);
        font-family: 'Poppins', sans-serif;
        color: #4a4a4a;
        min-height: 100vh;
    }

    /* Título principal */
    h1, .title {
        color:rgb(0, 0, 0);
        font-size: 3.2rem;
        font-weight: 600;
        text-align: center;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        margin-bottom: 0.5rem;
    }

    /* Subtítulo */
    .subtitle {
        color:rgb(0, 0, 0);
        font-size: 1.2rem;
        margin-bottom: 1.8rem;
    }

    /* Mensaje de bienvenida */
    .welcome-message {
        background-color: #fff;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border-left: 5px solid #ec407a;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    /* Contenedor de características */
    .features-container {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin: 2rem 0;
    }

    /* Tarjetas de características */
    .feature-card {
        background-color: rgba(201, 21, 21, 0.8);
        border-radius: 15px;
        padding: 1.5rem;
        flex: 1 1 250px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        margin-bottom: 1rem;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    /* Iconos de características */
    .feature-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .icon-organization {
        background-color:rgb(255, 255, 255);
    }
    .icon-organization i {
        color:rgb(0, 0, 0);
    }

    .icon-priorities {
        background-color:rgb(255, 255, 255);
    }
    .icon-priorities i {
        color:rgb(0, 0, 0);
    }

    .icon-reminders {
        background-color:rgb(255, 255, 255);
    }
    .icon-reminders i {
        color:rgb(0, 0, 0);
    }

    .icon-time {
        background-color:rgb(255, 255, 255);
    }
    .icon-time i {
        color:rgb(0, 0, 0);
    }

    .feature-icon i {
        font-size: 1.5rem;
    }

    /* Títulos de características */
    .feature-title {
        color:rgb(0, 0, 0);
        font-weight: 600;
        margin-bottom: 0.8rem;
    }

    /* Botón principal */
    .btn-primary, .btn-comenzar {
        background: linear-gradient(to right,rgb(0, 0, 0),rgb(255, 0, 0));
        border: none;
        border-radius: 50px;
        padding: 12px 30px;
        font-weight: 500;
        color: white;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 5px 15px rgba(236, 64, 122, 0.3);
        transition: all 0.3s ease;
    }

    .btn-primary:hover, .btn-comenzar:hover {
        background: linear-gradient(to right,rgb(0, 0, 0), #ad1457);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(236, 64, 122, 0.4);
        color: white;
    }

    /* Imagen */
    .img-shopping {
        max-width: 100%;
        filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));
        transition: all 0.5s ease;
        margin: 1.5rem 0;
    }

    .img-shopping:hover {
        transform: scale(1.05);
    }

    /* Footer */
    .welcome-footer {
        margin-top: 3rem;
        font-size: 0.9rem;
        color:rgb(255, 255, 255);
        text-align: center;
        padding: 1rem;
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 10px;
    }

    /* Para mantener la barra de navegación oscura */
    .navbar-dark {
        background-color:rgb(0, 0, 0) !important;
    }

    /* Para asegurar que el contenido principal tenga espacio */
    .main-content {
        padding-top: 2rem;
        padding-bottom: 2rem;
    }

    /* Estilos para la clase container */
    .container {
        background-color: rgba(252, 64, 89, 0.7);
        border-radius: 20px;
        padding: 2rem;
        margin-top: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
    }

    /* Estilos para ajustar mejor las características existentes */
    [class*="bi-"] {
        color:rgb(255, 255, 255);
        font-size: 1.5rem;
        margin-right: 0.5rem;
    }

    /* Estilo para títulos de secciones */
    h2, h3, h4, h5 {
        color:rgb(0, 0, 0);
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }

    /* Estilo para links */
    a {
        color:rgb(0, 0, 0);
        transition: color 0.3s ease;
    }

    a:hover {
        color:rgb(0, 0, 0);
        text-decoration: none;
    }

    /* Ajustes responsivos */
    @media (max-width: 768px) {
        h1, .title {
            font-size: 2.5rem;
        }
        
        .container {
            padding: 1.5rem;
        }
    }
</style>
<body>
<nav class="navbar navbar-expand-lg navbar-dark  bg-dark">
        
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/ejemplo/">
                <img src="<?= asset('./images/cit.png') ?>" width="35px'" alt="cit" >
                Aplicaciones
            </a>
            <div class="collapse navbar-collapse" id="navbarToggler">
                
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin: 0;">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/ejemplo/"><i class="bi bi-house-fill me-2"></i>Inicio</a>
                    </li>
  
                    <div class="nav-item dropdown " >
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-gear me-2"></i>Actividades
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-dark "id="dropwdownRevision" style="margin: 0;">
                            <!-- <h6 class="dropdown-header">Información</h6> -->
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/parcial1_mrml/actividades"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Registrar</a>
                            </li>
                        
                    
                        
                        </ul>
                    </div> 

                </ul> 
                <div class="col-lg-1 d-grid mb-lg-0 mb-2">
                    <!-- Ruta relativa desde el archivo donde se incluye menu.php -->
                    <a href="/menu/" class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>MENÚ</a>
                </div>

            
            </div>
        </div>
        
    </nav>
    <div class="progress fixed-bottom" style="height: 6px;">
        <div class="progress-bar progress-bar-animated bg-danger" id="bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="container-fluid pt-5 mb-4" style="min-height: 85vh">
        
        <?php echo $contenido; ?>
        
    </div>
    <div class="container-fluid " >
        <div class="row justify-content-center text-center">
            <div class="col-12">
                <p style="font-size:xx-small; font-weight: bold;">
                        Comando de Informática y Tecnología, <?= date('Y') ?> &copy;
                </p>
            </div>
        </div>
    </div>
</body>
</html>