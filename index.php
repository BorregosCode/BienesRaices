<?php

    require 'includes/funciones.php';

    
    incluirTemplate('header',$inicio = true);
?>

    <main class="contenedor seccion">

        <h1>Mas Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis solutaLorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis soluta</p>
            </div> <!--Cierre icono-->
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis solutaLorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis soluta</p>
            </div> <!--Cierre icono-->
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis solutaLorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis soluta</p>
            </div> <!--Cierre icono-->
        </div>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y depas en Venta</h2>
        
        <?php 
        
        
        $limite = 3;
        include 'includes/templates/anuncios.php' 
        
        ?>

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver Todas</a>
        </div>
    </section>
    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondra en contacto contigo a la brevedad.</p>
        <a href="contacto.php" class="boton-amarillo">Contactanos</a>
    </section>


    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>
            <article class="entrada-blog">
                <div class="imagen">
               
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Texto entrada blog">

                </div>

                <div class="texto-entrada  informacion-meta"> 
                    <a href="entrada.php">
                        <h4>
                            Terraza en el techo de tu Casa
                        </h4>
                        <p>
                            Escrito el: <span>20/10/2022</span> por <span>Admin</span>
                        </p>

                        <p>
                            Consejos para contruir una terraza en tu casa con los mejores materiales y ahorrando dinero
                        </p>
                    </a>
                </div>
            </article>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="imege/webp">
                        <source srcset="build/img/blog2.jpg" type="imege/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Texto entrada blog">
                    </picture>
                </div>

                <div class="texto-entrada  informacion-meta"> 
                    <a href="entrada.php">
                        <h4>
                            Guia para la decoracion de tu hogar
                        </h4>
                        <p>
                            Escrito el: <span>20/10/2022</span> por <span>Admin</span>
                        </p>

                        <p>
                            Maximiza el espacio de tu hogar con esta guia, aprende a combinar muebles y colores
                            para darle vida a tu espacio.
                        </p>
                    </a>
                </div>
            </article>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    El personal se comporto de una excelente forma, muy buena atencion y la casa que me ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p> - Omar Chegue</p>
            </div>
        </section>
    </div>

    <?php
        incluirTemplate('footer');
    ?>

    