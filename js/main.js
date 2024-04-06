const menuItems = document.querySelectorAll('.menu-item');
const theme = document.querySelector('#theme');
const themeModal = document.querySelector('.customize-theme');
const root = document.querySelector(':root');
const bg1 = document.querySelector('.bg-1');
const bg2 = document.querySelector('.bg-2');
const bg3 = document.querySelector('.bg-3');

const changeActiveItem = () => menuItems.forEach(item => item.classList.remove('active'));

// Attaches click event listeners to menu items
menuItems.forEach(item => item.addEventListener('click', () => {
    // Change active menu item
    changeActiveItem();
    item.classList.add('active');
    
    // Show or hide notification pop-up based on clicked item
    if (item.id != 'notification') {
        document.querySelector('.notifications-popup').style.display = 'none';
    } else {
        document.querySelector('.notifications-popup').style.display = 'block';
        document.querySelector('#notification .notification-count').style.display = 'none';
    }
}));

// Opens the theme modal
const openThemeModal = () => themeModal.style.display = 'grid';

// Closes the theme modal if clicked outside of it
const closeThemeModal = e => {
    if (e.target.classList.contains('customize-theme')) themeModal.style.display = 'none';
};

// Listens for clicks to close the theme modal
themeModal.addEventListener('click', closeThemeModal);
theme.addEventListener('click', openThemeModal);

// Função para obter o valor de um cookie
const getCookie = name => {
    const cookieString = document.cookie.split('; ');
    for (let i = 0; i < cookieString.length; i++) {
        const cookie = cookieString[i].split('=');
        if (cookie[0] === name) {
            return cookie[1];
        }
    }
    return null;
};

// Cookies set
const setCookie = (name, value, days) => {
    let expires = '';
    if (days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = '; expires=' + date.toUTCString();
    }
    document.cookie = name + '=' + value + expires + '; path=/';
};

// Variables for background color lightness
let darkcolorLightness = getCookie('darkColor') || '17%';
let whiteColorLightness = getCookie('whiteColor') || '100%';
let lightColorLightness = getCookie('lightColor') || '95%';

// Changes the background color
const changeBackground = () => {
    root.style.setProperty('--dark-color-lightness', darkcolorLightness);
    root.style.setProperty('--white-color-lightness', whiteColorLightness);
    root.style.setProperty('--light-color-lightness', lightColorLightness);
};

// Sets the background color based on clicked background option
const setBackground = (dark, white, light, activeBG, inactiveBG) => {
    darkcolorLightness = dark;
    whiteColorLightness = white;
    lightColorLightness = light;
    setCookie('darkColor', darkcolorLightness, 360); // Salva o valor do cookie com expiração de 30 dias
    setCookie('whiteColor', whiteColorLightness, 360);
    setCookie('lightColor', lightColorLightness, 360);
    activeBG.classList.add('active');
    inactiveBG.classList.remove('active');
    changeBackground();
};

// Listens for clicks on background options to set the background color
bg1.addEventListener('click', () => setBackground('17%', '100%', '95%', bg1, bg2));
bg2.addEventListener('click', () => setBackground('95%', '20%', '15%', bg2, bg1));

// Cokkie aplicative realod page
changeBackground();



document.addEventListener('DOMContentLoaded', function() {
    var preloadDiv = document.getElementById('preload');

    // Desativar scroll da página enquanto o preload está visível
    function disableScroll() {
        document.body.style.overflow = 'hidden';
        document.documentElement.style.overflow = 'hidden';
    }

    // Reativar scroll da página quando o preload for ocultado
    function enableScroll() {
        document.body.style.overflow = '';
        document.documentElement.style.overflow = '';
    }

    // Esconder o pré-carregamento com um pequeno atraso após a página estar completamente carregada
    window.addEventListener('load', function() {
        setTimeout(function() {
            preloadDiv.style.display = 'none';
            enableScroll(); // Reativar o scroll da página
            contentDiv.classList.add('show-content'); // Mostrar o conteúdo com a animação
            contentDiv.classList.remove('content');

        }, 1000); // Atraso de 1 segundo (1000 milissegundos)
    });

    // Desativar o scroll da página quando o preload estiver visível
    disableScroll();
});