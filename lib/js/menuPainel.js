// Menu lateral do painel vira "gaveta" em telas até 1024px (ver responsivo/layout_responsivo.css)
document.addEventListener('DOMContentLoaded', function () {
    var toggle = document.getElementById('painelToggle');
    var menu = document.getElementById('menuPainel');
    var overlay = document.getElementById('painelOverlay');
    var fechar = document.getElementById('menuPainelFechar');
    if (!toggle || !menu) return;

    function abrir() {
        document.body.classList.add('menu-painel-aberto');
        toggle.setAttribute('aria-expanded', 'true');
        var primeiro = menu.querySelector('a');
        if (primeiro) primeiro.focus();
    }
    function fecharMenu() {
        document.body.classList.remove('menu-painel-aberto');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.focus();
    }
    toggle.addEventListener('click', abrir);
    if (fechar) fechar.addEventListener('click', fecharMenu);
    if (overlay) overlay.addEventListener('click', fecharMenu);
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && document.body.classList.contains('menu-painel-aberto')) fecharMenu();
    });
    window.addEventListener('resize', function () {
        if (window.innerWidth > 1024) document.body.classList.remove('menu-painel-aberto');
    });
});
