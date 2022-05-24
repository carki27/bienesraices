<?php 
    require '../../includes/funciones.php';
    $auth = estaAutenticado();    

    if(!$auth) {
        header('Location: /');
    }

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    // Validar que el id en la url sea correcto
    if(!$id) {
        header('Location: /admin');
    }

    // Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    // Obtener los datos de la propiedad
    $consulta = "SELECT * FROM propiedades WHERE id = ${id}";
    $resultado = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultado);

    // Consultar para obtener los vendedores
    $consulta  = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);
    
    // Arreglar con mensajes de errores
    $errores = [];

    $titulo             = $propiedad['titulo'];
    $precio             = $propiedad['precio'];
    $descripcion        = $propiedad['descripcion'];
    $habitaciones       = $propiedad['habitaciones'];
    $wc                 = $propiedad['wc'];
    $estacionamiento    = $propiedad['estacionamiento'];
    $vendedor_id        = $propiedad['vendedor_id'];
    $imagenPropiedad    = $propiedad['imagen'];

    // Ejecutar el código después de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        echo "<pre>";
        var_dump($_POST);
        echo "</pre>";


        //echo "<pre>";
        //var_dump($_FILES);
        //echo "</pre>";

        $titulo             = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio             = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion        = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones       = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc                 = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento    = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedor_id        = mysqli_real_escape_string($db, $_POST['vendedor']);
        $creado             = date('Y/m/d');

        // Asignar files hacia una variabe
        $imagen = $_FILES['imagen'];

        if(!$titulo) {
            $errores[] = "Debes añadir un titulo";
        }

        if(!$precio) {
            $errores[] = "Debes añadir un precio";
        }

        if(strlen($descripcion) < 50) {
            $errores[] = "La descripción es obligatoria y debe tener mas de 50 caracteres";
        }

        if(!$habitaciones) {
            $errores[] = "Debes añadir el número de habitaciones";
        }

        if(!$wc) {
            $errores[] = "Debes añadir el número de baños";
        }

        if(!$estacionamiento) {
            $errores[] = "Debes añadir el número de lugares de estacionamiento";
        }

        if(!$vendedor_id) {
            $errores[] = "Elige un vendedor";
        }

        // Validar por tamaño (100kb máximo)
        $medida = 1000 * 1000;
        if($imagen['size'] > $medida) {
            $errores[] = "La imagen es muy pesada";
        }

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";


        // Revisar que el arreglo de errores este vacio
        if(empty($errores)) {
            
            //Crear una carpeta
            $carpetaImagenes = '../../imagenes/';
        
            if(!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }
   
            $nombreImagen = '';


            //** SUBIDA DE ARCHIVOS */

            if($imagen['name']) {
                // Eliminar la imagen previa

                unlink($carpetaImagenes . $propiedad['imagen']);

                  //Generar un nombre unico
                $nombreImagen = md5(uniqid(rand(),true)) . ".jpg";

                //Subir la imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
            } else {
                $nombreImagen = $propiedad['imagen'];
            }
       
          

            // Insertar en la base de datos
            $query = "UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}' ,descripcion = '${descripcion}', habitaciones = ${habitaciones}, wc = ${wc}, estacionamiento = ${estacionamiento}, vendedor_id = ${vendedor_id} WHERE id = ${id} ";

            //echo $query;
            

            $resultado = mysqli_query($db, $query);

            if($resultado) {
                // Redireccionar al usuario solo se usa antes de cualquier html
                header('Location: /admin?resultado=2');
            } 
        }
    }

    
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>  
            
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título Propiedad" value="<?php echo $titulo;?>"> 

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio;?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <img src="/imagenes/<?php echo $imagenPropiedad;?>" class="imagen-small">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion;?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información de la Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej. 3" min="1" max="9" value="<?php echo $habitaciones;?>">

                <label for="wc">Baños::</label>
                <input type="number" id="wc" name="wc" placeholder="Ej. 3" min="1" max="9" value="<?php echo $wc;?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej. 3" min="1" max="9" value="<?php echo $estacionamiento;?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor" id="">
                    <option value="">--Seleccione--</option>
                    <?php while($row = mysqli_fetch_assoc($resultado)): ?>
                        <option <?php echo $vendedor_id === $row['id'] ? 'selected' : '';?> value="<?php echo $row['id']; ?>"><?php echo $row['nombre'] . " " . $row['apellido']; ?></option>
                    <?php endwhile ?>
                </select>
            </fieldset>
            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>
