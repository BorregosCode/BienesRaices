<?php

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /');
    }

    //importar base de datos o conexion
    require 'includes/config/database.php';
// Consultar
    $db = conectarDB();
    $query = "SELECT * FROM propiedades WHERE id = ${id}";
//Obtener resultados
    $resultado = mysqli_query($db, $query);

    if(!$resultado->num_rows === 0){
        header('Location: /');
    }

    $propiedad = mysqli_fetch_assoc($resultado);

    require 'includes/funciones.php';

    
    incluirTemplate('header');
    
?>
    <main class="contenedor seccion contenido-centrado">

        <h1><?php echo $propiedad['titulo']; ?></h1>
        <picture>
            <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="anuncios">
        </picture>

        <div class="Resumen-propiedad">
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
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>
            <p><?php echo $propiedad['descripcion']; ?></p>
        </div>

    </main>
    <?php
        //Cerrar conexion
        mysqli_close($db);
        incluirTemplate('footer');
    ?>