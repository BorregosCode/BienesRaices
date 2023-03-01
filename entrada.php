<?php

    require 'includes/funciones.php';

    
    incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">

        <h1>Casa en venta frente al bosque</h1>
        <p class="informacion-meta"> Escrito el <span> 08/11/22 </span> Por: <span>Admin</span> </p>
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="anuncios">
        </picture>
        
        <div class="Resumen-propiedad">
            
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa, dolores ea! Dolorum repellendus earum harum ex! Magni nesciunt praesentium, enim corporis est atque temporibus doloremque repellat. Error aut laboriosam adipisci?
            Quas tenetur eius magni animi necessitatibus quod earum labore, similique explicabo error! Error exercitationem dolorum magnam maxime facilis nihil et quas reprehenderit fugiat molestiae rerum, deserunt dolor quod cupiditate possimus?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa, dolores ea! Dolorum repellendus earum harum ex! Magni nesciunt praesentium, enim corporis est atque temporibus doloremque repellat. Error aut laboriosam adipisci?
            Quas tenetur eius magni animi necessitatibus quod earum labore, similique explicabo error! Error exercitationem dolorum magnam maxime facilis nihil et quas reprehenderit fugiat molestiae rerum, deserunt dolor quod cupiditate possimus?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa, dolores ea! Dolorum repellendus earum harum ex! Magni nesciunt praesentium, enim corporis est atque temporibus doloremque repellat. Error aut laboriosam adipisci?
            Quas tenetur eius magni animi necessitatibus quod earum labore, similique explicabo error! Error exercitationem dolorum magnam maxime facilis nihil et quas reprehenderit fugiat molestiae rerum, deserunt dolor quod cupiditate possimus?</p>
        </div>

    </main>
    <?php
incluirTemplate('footer');
?>