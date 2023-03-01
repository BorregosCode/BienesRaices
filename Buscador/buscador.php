<?php

require '../includes/funciones.php';

$auth = estadoAutenticado();
//Base de datos
require '../includes/config/database.php';
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buscador múltiples campos - JS Moderno </title>
    <link href="https://fonts.googleapis.com/css?family=Staatliches" rel="stylesheet">  
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <link rel="stylesheet" href="css/app.css">
</head>
<body>

    <h1>Buscador de Autos</h1>

    <div class="contenedor">

        

        <form id="buscador">
            <div class="row">
                    
                <div class="three columns">
                <legend>Vendedor</legend>

                    <select name="vendedorId" id="vendedor">
                        <option value="">--Seleccione--</option>
                        <?php while($row = mysqli_fetch_assoc($select) ) : ?>
                            <option  <?php echo $vendedorId === $row['id'] ? 'selected' : ''; ?>
                            value="<?php echo $row['id'];?>">
                            <?php echo $row["nombre"] . " " . $row["apellido"]; ?> </option>
                        <?php endwhile; ?>
                    </select>

                    <label for="marca">Marca</label>
                    <select class="u-full-width" id="marca">
                        <option value="">Seleccione</option>
                        <option value="Audi">Audi</option>
                        <option value="BMW">BMW</option>
                        <option value="Mercedes Benz">Mercedes Benz</option>
                        <option value="Chevrolet">Chevrolet</option>
                        <option value="Ford">Ford</option>
                        <option value="Dodge">Dodge</option>
                    </select>
                </div>
                <div class="three columns">
                    <label for="year">Año</label>
                    <select class="u-full-width" id="year">
                        <option value="">Seleccione</option>
                    </select>
                </div>
                <div class="three columns">
                    <label for="minimo">Precio Min</label>
                    <select class="u-full-width" id="minimo">
                            <option value="">Seleccione</option>
                            <option value="20000">20,000</option>
                            <option value="30000">30,000</option>
                            <option value="40000">40,000</option>
                            <option value="50000">50,000</option>
                            <option value="60000">60,000</option>
                            <option value="70000">70,000</option>
                            <option value="80000">80,000</option>
                            <option value="90000">90,000</option>
                    </select>
                </div>
                <div class="three columns">
                    <label for="maximo">Precio Max</label>
                    <select class="u-full-width" id="maximo">
                            <option value="">Seleccione</option>
                            <option value="20000">20,000</option>
                            <option value="30000">30,000</option>
                            <option value="40000">40,000</option>
                            <option value="50000">50,000</option>
                            <option value="60000">60,000</option>
                            <option value="70000">70,000</option>
                            <option value="80000">80,000</option>
                            <option value="90000">90,000</option>
                    </select>
                </div>
                <div class="row">
                    <div class="four columns">
                        <label for="puertas">Puertas</label>
                        <select class="u-full-width" id="puertas">
                                <option value="">Seleccione</option>
                                <option value="2">2</option>
                                <option value="4">4</option>
                        </select>
                    </div>
                    <div class="four columns">
                        <label for="transmision">Transmisión</label>
                        <select class="u-full-width" id="transmision">
                                <option value="">Seleccione</option>
                                <option value="automatico">Automática</option>
                                <option value="manual">Manual</option>
                        </select>
                    </div>
                    <div class="four columns">
                        <label for="color">Color</label>
                        <select class="u-full-width" id="color">
                                <option value="">Seleccione</option>
                                <option value="Negro">Negro</option>
                                <option value="Azul">Azul</option>
                                <option value="Blanco">Blanco</option>
                                <option value="Rojo">Rojo</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>


        <h1>Resultados</h1>
        <div id="resultado"></div>
    </div>

    <a class="sitio-web" href="https://www.codigoconjuan.com" rel="nofollow noopener noreferrer" >Código Con Juan</a>

    <script src="js/db.js"></script>
    <script src="js/app.js"></script>
    
</body>
</html>