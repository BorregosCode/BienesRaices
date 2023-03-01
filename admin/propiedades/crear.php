<?php
require '../../includes/funciones.php';

$auth = estadoAutenticado();
//Base de datos
require '../../includes/config/database.php';
$db = conectarDB();

//Consultar para obtener a los vendedores
$consulta = "SELECT * FROM vendedores";
$select = mysqli_query($db, $consulta);

//Arreglo con mensaje de errores
$errores = [];

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';

//Ejecuta el codigo despues de que el usuario manda el codigo
if($_SERVER['REQUEST_METHOD']=== 'POST'){
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
        
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
        
        if(!$imagen['name'] || $imagen['error']) {
            $errores[] = "La imagen es obligatoria";
        }

        //Validar por tamaño (100 Kb  maximo)
        $medida = 1000 * 1000;

        if($imagen['size'] > $medida) {
            $errores[] = 'La Imagen es muy pesada';
        }

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        // Revisar que el arreglo de errores este vacio
        if(empty($errores)){
            /* SUBIDA DE ARCHIVOS */
            
            //Crear Carpeta
            $carpetaImagenes = '../../imagenes/';
  
            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            //Generar un nombre unico
            $nombreImagen = md5( uniqid( rand() , true )  ). ".jpg"; //hash
            var_dump($nombreImagen);
            //Subir imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );

            //Insertar en BD
            $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedoresId )
            VALUES ('$titulo', '$precio','$nombreImagen','$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId')";
    
            //echo $query;
            $resultado = mysqli_query($db, $query);

            if($resultado) {
                // echo "Insertado correctamente";

            //Redireccionar al usuario:
            header("Location: /admin?resultado=1");
            }

        }




}


incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Crear</h1>
        
        <?php foreach($errores as $error): ?>
            
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
            
        <?php endforeach; ?>


        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">

        <fieldset>
            <legend>Informacion general</legend>
            
            <label for="titulo">Titulo</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo de propiedad" value="<?php echo $titulo; ?>">
            
            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" placeholder="precio de propiedad" value="<?php echo $precio; ?>">
            
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png" >

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
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
            <a href="../index.php" class="boton boton-verde">Volver</a>
    </form>
    
    
</main>


<?php
incluirTemplate('footer');
?>