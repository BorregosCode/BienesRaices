<?php

    require 'includes/funciones.php';

    
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Conoce Sobre Nosotros</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img src="build/img/nosotros.jpg" alt="anuncios">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>25 Años de experiencia</blockquote>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates nihil inventore assumenda est! Minus officia sint dolore, labore obcaecati eum tenetur cumque laudantium dicta, quidem rem odit assumenda eius perferendis.
                Culpa, illum, dolorem autem quia a rem tempore tenetur officiis laudantium, porro nemo cum itaque unde numquam quis! Repudiandae, nesciunt voluptatum adipisci necessitatibus perspiciatis facere ea voluptatibus quidem in cupiditate.
                s rem consequuntur? Ipsam, recusandae.</p>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates nihil inventore assumenda est! Minus officia sint dolore, labore obcaecati eum tenetur cumque laudantium dicta, quidem rem odit assumenda eius perferendis.
                Culpa, illum, dolorem autem quia a rem tempore tenetur officiis laudantium, porro nemo cum itaque unde numquam quis! Repudiandae, nesciunt voluptatum adipisci necessitatibus perspiciatis facere ea voluptatibus quidem in cupiditate.
                s rem consequuntur? Ipsam, recusandae.</p>
                            
            </div>
        </div>
    </main>
    <section class="contenedor seccion">

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
    </section>
    <?php
incluirTemplate('footer');
?>