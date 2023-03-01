<?php
    require '../includes/funciones.php';
    $auth = estadoAutenticado();

    //Importar la conexion
    require '../includes/config/database.php';
    $db = conectarDB();
    //Escribir el Query
    $query = "SELECT * FROM propiedades";
    //Consultar base de datos
    $resultadoConsulta = mysqli_query($db, $query);



//Muestra mensaje condicional
$resultado = $_GET['resultado'] ?? null;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if($id) {
        //Eliminar el archivo
        $query = "SELECT imagen FROM propiedades WHERE id = ${id}";
        
        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);

        unlink('../imagenes/' . $propiedad['imagen']);

        //Elimina la propiedad
        $query = "DELETE FROM propiedades WHERE id = ${id}";
        $resultado = mysqli_query($db, $query);

        if($resultado) {
            header('location: /admin?resultado=3');
        }
    }
}

//Incluye un template
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if( intval( $resultado ) === 1): ?>
            <p class="alerta exito">Anuncio creado correctamente</P>
        <?php elseif( intval( $resultado ) === 2): ?>
            <p class="alerta exito">Anuncio Actualizado correctamente</P>
        <?php elseif( intval( $resultado ) === 3): ?>
            <p class="alerta exito">Anuncio Eliminado correctamente</P>
        <?php endif; ?>
            <a href="propiedades/crear.php" class="boton boton-verde">Crear Nueva propiedad</a>
            <!-- <a href="propiedades/crear.php" class="boton boton-verde">Mostrar todas las propiedades</a>
            <a href="propiedades/actualizar.php" class="boton boton-verde">Modificar propiedad</a>
            <a href="propiedades/borrar.php" class="boton boton-verde">Eliminar propiedad</a> -->
            
            <table class="propiedades">  
                <thead>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </thead>

                <tbody>
                    <?php while( $propiedad = mysqli_fetch_assoc($resultadoConsulta)): ?>
                    <tr>
                        <td><?php echo $propiedad['id'];  ?></td>
                        <td><?php echo $propiedad['titulo'];  ?></td>
                        <td> <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="imagen tabla" class="imagen-tabla imagen-small">  </td>
                        <td><?php echo $propiedad['precio'];  ?></td>
                        <td>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $propiedad['id'];?>">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                            <a href="propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>

                </tbody>

            </table>
 

    </main>

    <?php
    //Cerrar conexion
    mysqli_close($db);
    incluirTemplate('footer');
?>