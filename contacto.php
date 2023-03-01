<?php

    require 'includes/funciones.php';

    
    incluirTemplate('header');
?>

    <main class="contenedor seccion">

        <h1>Contacto</h1>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen de Contacto">
        </picture>
        <h2>Llene el formulario de contacto</h2>

        <form class="formulario" action="">
            <fieldset>
                <legend>Informacion Personal</legend>
                <label for="nombre">Nombre:</label>
                <input type="text" placeholder="Tu nombre" id="nombre">

                <label for="email">E-mail:</label>
                <input type="email" placeholder="Tu E-mail" id="email">

                <label for="telefono">telefono:</label>
                <input type="tel" placeholder="(+52) 666 666 6666" id="telefono">
                
                <label for="mensaje">mensaje:</label>
                <textarea placeholder="Escribenos tus comentarios" id="mensaje"></textarea>

            </fieldset>

            <fieldset>
                <legend>Informacion sobre la propiedad</legend>

                <label for="opciones">Vende o Compra</label>
                <select id="opciones">
                    <option value="" disabled selected>--Seleccione--</option>
                    <option value="compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" placeholder="$" id="presupuesto">
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>
                <p>Como desea ser contactado?</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">telefono</label>
                    <input name="contacto" type="radio" value="telefono" id="contactar-telefono">
                    
                    <label for="contactar-email">E-mail</label>
                    <input name="contacto" type="radio" value="email" id="contactar-email">
                </div>

                <p>Si eligio telefono, Elija fecha y hora para ser contactado.</p>

                <label for="fecha">Fecha</label>
                <input type="date" id="fecha">

                <label for="hora">Hora: </label>
                <input type="time" id="hora" min="09:00" max="18:00">

            </fieldset>
            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>

    <?php
incluirTemplate('footer');
?>