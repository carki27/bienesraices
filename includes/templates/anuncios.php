<?php 
    // Importar la base de datos
    require __DIR__ . '/../config/database.php';
    $db = conectarDB();
    
    // Consultar
    $query = "SELECT * FROM propiedades LIMIT ${limite}";

    // Obtener los resultados
    $resultado = mysqli_query($db, $query);
    

    function truncate(string $texto, int $cantidad) : string
    {
        if(strlen($texto) >= $cantidad) {
            return substr($texto, 0, $cantidad) . "...";
        } else {
            return $texto;
        }
    }

    $cantidad = 100;
?>


<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)):?>
    <div class="anuncio">
    
          <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="anuncio"> 
        
        <div class="contenido-anuncio">
            <h3><?php echo $propiedad['titulo']; ?> </h3>
            <p><?php $texto = $propiedad['descripcion'];
                echo truncate($texto, $cantidad); 
            ?></p>
            <p class="precio">$<?php echo number_format($propiedad['precio']); ?></p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy "src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad['wc']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy "src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy "src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>

            <a href="anuncio.php?id=<?php echo $propiedad['id'];?>" class="boton-amarillo-block">
                Ver Propiedad
            </a>
        </div> <!--Contenido Anuncio-->
    </div><!--Anuncio-->
    <?php endwhile; ?>
</div><!--Contenedor de Anuncios-->


<?php
    // Cerrar la conexión
    mysqli_close($db);
?>