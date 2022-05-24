document.addEventListener('DOMContentLoaded', function() {
    eventListeners();
    darkMode();
    desaparecerMensaje();
});

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    // if(navegacion.classList.contains('mostrar')) {
    //     navegacion.classList.remove('mostrar');
    // } else {
    //     navegacion.classList.add('mostrar');
    // } o

    navegacion.classList.toggle('mostrar');
}

function darkMode() {
    const preferenciaDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    if(preferenciaDarkMode.matches) {
        document.body.classList.add('.dark-mode');
    } else {
        document.body.classList.remove('.dark-mode');
    }

    preferenciaDarkMode.addEventListener('change', function() {
        if(preferenciaDarkMode.matches) {
            document.body.classList.add('.dark-mode');
        } else {
            document.body.classList.remove('.dark-mode');
        }
    })

    const darkModeBoton = document.querySelector('.dark-mode-boton');
    
    darkModeBoton.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        
        //Para que el modo elegido se quede guardado en local-storage
        if (document.body.classList.contains('dark-mode')) {
            localStorage.setItem('modo-oscuro','true');
        } else {
            localStorage.setItem('modo-oscuro','false');
        }
    });
    
    if (localStorage.getItem('modo-oscuro') === 'true') {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }
}

function desaparecerMensaje() {
    //Eliminar texto de confirmación de CRUD en admin/index.php
    setTimeout(function(){
        const alerta = document.querySelector('.alerta.exito');

            if(alerta.classList.contains('alerta')) {
                const padre = alerta.parentElement;
                padre.removeChild(alerta);
            } 
    }, 3500);

}