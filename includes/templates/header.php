<?php
if(!isset($_SESSION)){
    session_start();
}

$auth = $_SESSION['login'] ?? null;



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra ">
                <a href="/index.php">
                    <img src="/build/img/logo.svg" alt="Logotipo bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Icono menu responsive">
                </div>
                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg">
                    <nav class="navegacion">
                        <a href="/../../nosotros.php">Nosotros</a>
                        <a href="/../../anuncios.php">Anuncios</a>
                        <a href="/../../blog.php">Blog</a>
                        <a href="/../../contacto.php">contacto</a>
                        <?php if(!$auth): ?>
                            <a href="login.php">iniciar Sesion</a>
                           <?php else: ?>
                                <a href="/admin">Administracion</a>
                                <a href="cerrar-sesion.php">Cerrar sesion</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div> <!--CIERRE BARRA-->

            <?php if ($inicio) { ?>
            <h1>Venta de casas y departamentos Exclusivos de lujo</h1>
            <?php } ?>        
        </div>
    </header>