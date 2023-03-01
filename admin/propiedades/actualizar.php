<?php

require '../../includes/funciones.php';
$auth = estadoAutenticado();

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('location: /admin');
}


//Base de datos
require '../../includes/config/database.php';
$db = conectarDB();
//Obtener los datos de la propiedad
$consulta = "SELECT * FROM propiedades WHERE id = ${id}";
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado);



//Consultar para obtener a los vendedores
$consulta = "SELECT * FROM vendedores";
$select = mysqli_query($db, $consulta);

//Arreglo con mensaje de errores
$errores = [];

$titulo = $propiedad['titulo'];
$precio = $propiedad['precio'];
$descripcion = $propiedad['descripcion'];
$habitaciones = $propiedad['habitaciones'];
$wc = $propiedad['wc'];
$estacionamiento = $propiedad['estacionamiento'];
$vendedorId = $propiedad['vendedoresId'];
$imagenPropiedad = $propiedad['imagen'];

//Ejecuta el codigo despues de que el usuario manda el codigo
if($_SERVER['REQUEST_METHOD']=== 'POST'){
        echo "<pre>";
        var_dump($_POST);
        echo "</pre>";

        // echo "<pre>";
        // var_dump($_FILES);
        // echo "</pre>";
        
        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedorId = mysqli_real_escape_string($db, $_POST['vendedorId']);
        $creado = date('y/m/d');
        //Asignar files hacia una variable
        $imagen = $_FILES['imagen'];

       
        if(!$titulo) {
            $errores[] = "Debes agregar un titulo";
        }

        if(!$precio) {
            $errores[] = "El precio es obligatorio";
        }
        
        if( strlen( $descripcion ) <50 ) {
            $errores[] = "La descripcion es obligatorio";
        }
        
        if(!$habitaciones) {
            $errores[] = "Por favor ingresa el numero de habitaciones";
        }
        
        if(!$wc) {
            $errores[] = "Por favor ingresa el numero de WC";
        }
        
        if(!$estacionamiento) {
            $errores[] = "Por favor ingresa el numero de estacionamientos";
        }
        
        if(!$vendedorId) {
            $errores[] = "Selecciona un vendedor";
        }

        //Validar por tamaño (100 Kb  maximo)
        $medida = 1000 * 1000;

        
        if($imagen['size'] > $medida) {
            $errores[] = 'La Imagen es muy pesada';
        }
        
        
        // Revisar que el arreglo de errores este vacio
        if(empty($errores)){
                // //Crear Carpeta
            $carpetaImagenes = '../../imagenes/';
    
            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            $nombreImagen = '';

            // /* SUBIDA DE ARCHIVOS */
            if(($imagen['name']))
            {
                //eliminar imagen previa
                unlink($carpetaImagenes . $propiedad['imagen']);
                
                
                // //Generar un nombre unico
                $nombreImagen = md5( uniqid( rand() , true )  ). ".jpg"; //hash
                // var_dump($nombreImagen);
                // //Subir imagen
                    move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );
            } else {
                $nombreImagen = $propiedad['imagen'];
            }
        
            


            //Insertar en BD
            $query = "UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, wc = ${wc},
            estacionamiento = ${estacionamiento}, vendedoresId = ${vendedorId} WHERE id = ${id}";
    
            echo $query;

            $resultado = mysqli_query($db, $query);

            if($resultado) {
                // echo "Insertado correctamente";

            //Redireccionar al usuario:
            header("Location: /admin?resultado=2");
            }

                }
    }

incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Actualizar propiedad</h1>
        <a href="../index.php" class="boton boton-verde">Volver</a>
        <?php foreach($errores as $error): ?>
            
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
            
        <?php endforeach; ?>


        <form class="formulario" method="POST" enctype="multipart/form-data">

        <fieldset>
            <legend>Informacion general</legend>
            
            <label for="titulo">Titulo</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo de propiedad" value="<?php echo $titulo; ?>">
            
            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" placeholder="precio de propiedad" value="<?php echo $precio; ?>">
            
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png" >

            <img src="/imagenes/<?php echo $imagenPropiedad; ?>" class="imagen-small">

            <label for="descripcion">descripcion</label>
            <textarea id="descripcion" name="descripcion" cols="30" rows="10" ><?php echo $descripcion; ?></textarea>
            
            
        </fieldset>

        <fieldset>
            <legend>Informacion de la propiedad</legend>

            <label for="habitaciones">Habitaciones</label>
            <input 
            type="number" 
            id="habitaciones" 
            name="habitaciones" 
            placeholder="Ej. 3" 
            min="1" 
            max="9" 
            value="<?php echo $habitaciones; ?>">
            
            <label for="wc">Wc</label>
            <input type="number" id="wc" name="wc" placeholder="Ej. 3" min="1" max="9" value="<?php echo $wc; ?>">
            
            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej. 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">

        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedorId">
                <option value="">--Seleccione--</option>
                <?php while($row = mysqli_fetch_assoc($select) ) : ?>
                    <option  <?php echo $vendedorId === $row['id'] ? 'selected' : ''; ?>
                    value="<?php echo $row['id'];?>">
                    <?php echo $row["nombre"] . " " . $row["apellido"]; ?> </option>
                <?php endwhile; ?>
                
            </select>
        </fieldset>
            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
            <input href="../index.php" type="submit" value="Volver" class="boton boton-verde">

    </form>
    
    
</main>


<?php
incluirTemplate('footer');
?>