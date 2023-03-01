<?php

require '../../includes/funciones.php';

$auth = estadoAutenticado();
//Base de datos
require '../../includes/config/database.php';
$db = conectarDB();

//Consultar para obtener informacion de base de datos
$consulta = "SELECT * FROM vendedores";
$consulta2 = "SELECT * FROM vendedores";
$select = mysqli_query($db, $consulta);
$select2 = mysqli_query($db, $consulta2);

//Arreglo con mensaje de errores
$errores = [];


//Inicializar variables en cero
$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';
$vendedorId2 = '';

//Ejecuta el codigo despues de que el usuario manda el codigo
if($_SERVER['REQUEST_METHOD']=== 'POST'){

        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedorId = mysqli_real_escape_string($db, $_POST['vendedorId']);
        $vendedorId2 = mysqli_real_escape_string($db, $_POST['vendedorId']);
        $creado = date('y/m/d');
       
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

        if($imagen['size'] > $medida) {
            $errores[] = 'La Imagen es muy pesada';
        }

        // Revisar que el arreglo de errores este vacio
        if(empty($errores)){
            /* SUBIDA DE ARCHIVOS */
   

            //Insertar en BD
            $query = "INSERT INTO tabla (campos )
            VALUES ('')";
    
            //echo $query;
            $resultado = mysqli_query($db, $query);

            if($resultado) {
                // echo "Insertado correctamente";

            //Redireccionar al usuario:
            header("Location: /admin?resultado=1");
            }

        }




}

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
            <legend>Vendedor</legend>

            <select name="vendedorId">
                <option value="">--Seleccione--</option>
                <?php while($row = mysqli_fetch_assoc($select) ) : ?>
                    <option  <?php echo $vendedorId === $row['id'] ? 'selected' : ''; ?>
                    value="<?php echo $row['id'];?>">
                    <?php echo $row["nombre"] . " " . $row["apellido"]; ?> </option>
                <?php endwhile; ?>
                
            </select>

            <legend>Vendedor</legend>

            <select name="vendedorId2">
                <option value="">--Seleccione--</option>
                <?php while($row2 = mysqli_fetch_assoc($select2) ) : ?>
                    <option  <?php echo $vendedorId2 === $row2['id'] ? 'selected' : ''; ?>
                    value="<?php echo $row2['id'];?>">
                    <?php echo $row2["nombre"] . " " . $row2["apellido"]; ?> </option>
                <?php endwhile; ?>
                
            </select>
        </fieldset>
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
            <a href="../index.php" class="boton boton-verde">Volver</a>
    </form>
    
    
</main>
