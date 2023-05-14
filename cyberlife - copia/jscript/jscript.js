const contenedor = document.querySelector('#contenedor');
document.querySelector('#boton-menu').addEventListener('click', () => {
    contenedor.classList.toggle('active');
})

const comprobarAncho = () => {
    if (window.innerWidth <= 768) {
        contenedor.classList.remove('active');
    } else {
        contenedor.classList.add('active');
    }
}

comprobarAncho();

window.addEventListener('resize', () => {
    comprobarAncho();
})

var abrirSara = document.getElementById('abrir-s'),
    abrirM11 = document.getElementById('abrir-m11'),
    overlay = document.getElementById('overlay'),
    popup = document.getElementById('popup'),
    cerrar = document.getElementById('cerrar');

abrirM11.addEventListener('click', () => {
    abrirPopUp("images/Mensaje 11.jpg");
})

abrirSara.addEventListener('click', () => {
    abrirPopUp("images/S.jpg");
})

cerrar.addEventListener('click', () => {
    cerrarPopUp();
})

function abrirPopUp(src) {
    document.getElementById('imagen').src = src;
    overlay.classList.add('active');
};

function cerrarPopUp(){
    overlay.classList.remove('active');
}

var campana = document.getElementById('bell'),
    audio = document.getElementById('loveYou'),
    gato = document.getElementById('gato'),
    meow = document.getElementById('meow'),
    avatar = document.getElementById('avatar'),
    stitch = document.getElementById('stitch');

campana.addEventListener('click', () => { reproducir(audio) });
gato.addEventListener('click', () => { reproducir(meow) });
avatar.addEventListener('click', () => { reproducir(stitch) });

function reproducir(cancion) {
    cancion.play();
};