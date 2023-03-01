<?php
    //Conectar BD
    require 'includes/config/database.php';
    $db = conectarDB();

    //Autenticar el usuario
    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // echo '<pre>';
        // var_dump($_POST);
        // echo '</pre>';

        $email =mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password =mysqli_real_escape_string($db, $_POST['password']);

        if(!$email) {
            $errores[]= "El email es obligatorio o no es valido";
        }
        
        if(!$password){
            $errores[]= "El password es obligatorio";
        }

        if(empty($errores)) {
            $query = "SELECT * FROM usuarios WHERE email = '${email}' ";
            $resultado = mysqli_query($db, $query);

            if( $resultado->num_rows){
                 //Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);
                $auth = password_verify($password, $usuario['password']);

                if($auth) {
                    //Usuario esta autenticado
                    session_start();

                    //Llenar arreglo de la sesion
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header ('Location: /admin');
                } else {
                    //usuario no auntenticado
                    $errores[] = "El password es incorrecto";
                }
                
            } else {
                $errores[] = "El usuario no existe";
            }
        }
    }


    //Incluye Header
    require 'includes/funciones.php';
    incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario" novalidate>
        
            <fieldset>
                <legend>Email y password</legend>
                
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="Tu email" >
                
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" >
            </fieldset>

        <input type="submit" value="Iniciar Sesion" class="boton boton-verde ">
        </form>
    </main>


<?php
    incluirTemplate('footer');
?>