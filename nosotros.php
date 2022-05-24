<?php 
    require 'includes/funciones.php';    
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Conoce Sobre Nosotros</h1>
    </main>

    <div class="contenedor seccion-nosotros">
        <div>
            <picture>
                <source srcset="build/img/nosotros.webp" type="image/webp"> 
                <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                <img loading="lazy" src="build/img/nosotros.jpg" alt="anuncio"> 
            </picture>
        </div>

        <div class="texto-nosotros">
            <h4>25 Años de Experiencia</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non fugiat, modi odit pariatur magni, dolor nam voluptatibus quos illo reiciendis amet delectus, sapiente repellat aspernatur. Asperiores aspernatur enim beatae repellendus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non fugiat, modi odit pariatur magni, dolor nam voluptatibus quos illo reiciendis amet delectus, sapiente repellat aspernatur. Asperiores aspernatur enim beatae repellendus.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non fugiat, modi odit pariatur magni, dolor nam voluptatibus quos illo reiciendis amet delectus, sapiente repellat aspernatur. Asperiores aspernatur enim beatae repellendus.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non fugiat, modi odit pariatur magni, dolor nam voluptatibus quos illo reiciendis amet delectus, sapiente repellat aspernatur. Asperiores aspernatur enim beatae repellendus.</p>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non fugiat, modi odit pariatur magni, dolor nam voluptatibus quos illo reiciendis amet delectus, sapiente repellat aspernatur. Asperiores aspernatur enim beatae repellendtibus quos illo reiciendis amet delectus, sapiente repellat aspernatur. Asperiores aspernatur enim beatae repellendus.</p>
        </div>
    </div>

    <main class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Iconos Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nobis, quisquam sed maxime id accusamus quos minima odit sint esse voluptas dolores pariatur? Repudiandae iste eum itaque possimus voluptatibus odit nam.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Iconos Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nobis, quisquam sed maxime id accusamus quos minima odit sint esse voluptas dolores pariatur? Repudiandae iste eum itaque possimus voluptatibus odit nam.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Iconos Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nobis, quisquam sed maxime id accusamus quos minima odit sint esse voluptas dolores pariatur? Repudiandae iste eum itaque possimus voluptatibus odit nam.</p>
            </div>
        </div>
    </main>

<?php
    incluirTemplate('footer');
?>