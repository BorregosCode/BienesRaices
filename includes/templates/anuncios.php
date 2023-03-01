<?php
//importar base de datos o conexion
    require 'includes/config/database.php';
// Consultar
    $db = conectarDB();
    $query = "SELECT * FROM propiedades LIMIT ${limite}";
//Obtener resultados
    $resultado = mysqli_query($db, $query);


?>
<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
    <div class="anuncios">
            
                <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="anuncios">

        <div class="contenido-anuncio">
            <h3><?php echo $propiedad['titulo']; ?></h3>
            <p><?php echo $propiedad['descripcion']; ?></p>
            <p class="precio">$<?php echo $propiedad['precio']; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="Icono wc">
                    <p><?php echo $propiedad['wc']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono dormitorio">
                    <p>$<?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>
            <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton boton-amarillo"> Ver propiedad</a>
        </div> <!--Cierre contenido-anuncio-->
    </div><!--Cierre anuncios-->
    <?php endwhile; ?>
</div><!--Cierre anuncios-->

<?php
    //Cerrar conexion
    mysqli_close($db);
?>