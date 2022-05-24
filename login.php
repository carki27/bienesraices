<?php
    require 'includes/config/database.php';
    $db = conectarDB();

    $errores = [];

    // Autenticar el usuario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $email      = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password   = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email) {
            $errores[] = "El email es obligatorio o no es válido";
        }

        if(!$password) {
            $errores[] = "El password es obligatorio";
        }

        if(empty($errores)) {

            // Revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '${email}' ";
            $resultado = mysqli_query($db, $query);

            if($resultado->num_rows) {
                // Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                // Verificar si el password es correcto o no
                $auth = password_verify($password, $usuario['password']);
                
                
                if($auth) {
                    // El Usuario esta autenticado
                    session_start();

                    // LLenar el arreglo de la sesión
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('Location: /admin');

                    // echo "<pre>";
                    // var_dump($_SESSION);
                    // echo "</pre>";

                } else {
                    $errores[] = "El password es incorrecto";
                }
            
            } else {
                $errores[] = "El Usuario no existe";
            }
        }

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";
    }

    // Incluye el header
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Inicar Sesión</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach ?>


        <form method="POST" class="formulario">
            <fieldset> <!-- Grupo de Campos-->
                <legend>Email y Password</legend>
                
                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Email" id="email" required>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu Password" id="password" required>

            </fieldset>

            <input type="submit" value="Inicar Sesión" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>