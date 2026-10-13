<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_GET['controller'])) {
    $controller = strtolower(str_replace("Controller", "", $_GET['controller']));
    $metodo = strtolower($_GET['metodo']);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imobiliaria - Vetor256.</title>
    <!-- CARREGANDO JS -->
    <script src="lib/js/animacoes.js"></script>
    <script src="lib/js/passaComEnter.js"></script>
    <script src="lib/js/buscaCep.js"></script>
    <script src="lib/js/cadeadoProprietario.js"></script>
    <script src="lib/js/cadeadoUsuario.js"></script>
    <script src="lib/js/verSenha.js"></script>
    <script src="lib/js/carregarImagem.js"></script>
    <script src="lib/js/galeria.js"></script>
    <script src="lib/js/formatarCamposImovel.js"></script>
    <script src="lib/js/selecionar.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="lib/js/mascaras.js"></script>
    <!-- Fontawesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Fontes Externas -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- CSS -->
    <?php require 'Views/shared/css.php'; ?>
    <!-- Ícone -->
    <link rel="icon" href="lib/img/icone.ico" type="image/x-icon">
</head>
<body>
    <header class="header bg-preto-azulado-escuro hg-80 wd-100 pd-t-2">
        <div class="container">

            <!-- Logo e Redes Sociais -->
            <div class="box-6 flex justify-start item-centro header-logo-area">
                <a href="index.php?controller=UsuarioController&metodo=logout" style="text-decoration: none;">
                    <h1 class="fonte36 fnc-branco">Imobiliária
                        <span class="fonte22 fw-300">Vetor256.</span></h1>
                </a>
                <div class="social-icons">
                    <a href="https://www.facebook.com/NewProfileIsaiasLourenco" target="_blank" title="Visite nosso Facebook"><i class="fa-brands fa-facebook-f fonte22 fnc-branco mg-r-3 fnc-vermelho-hover mg-l-14"></i></a>
                    <a href="https://www.linkedin.com/in/isaias-lourenco/" target="_blank" title="Visite nosso Linkedin"><i class="fa-brands fa-linkedin-in fonte22 fnc-branco mg-r-3 fnc-vermelho-hover"></i></a>
                    <a href="https://www.youtube.com/@vetor256.-62" target="_blank" title="Visite nosso canal no Youtube"><i class="fa-brands fa-youtube fonte22 fnc-branco mg-r-3 fnc-vermelho-hover"></i></a>
                </div>
            </div>

            <!-- Botão Hambúrguer (Visível apenas no Mobile) -->
            <button class="menu-hamburguer" id="menuToggle" aria-label="Abrir menu">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <!-- Menu de Navegação -->
            <nav class="box-6 wd-100" id="mainNav">
                <ul class="flex justify-end nav-list">
                    <?php if (!isset($controller)): ?>
                        <li class="mg-l-3 mobile-li"><a href="#home" class="fnc-branco fnc-vermelho-hover espaco-letra fonte12">Home</a></li>
                        <li class="mg-l-3 mobile-li"><a href="#comprar" class="fnc-branco fnc-vermelho-hover espaco-letra fonte12">Compras</a></li>
                        <li class="mg-l-3 mobile-li"><a href="#alugar" class="fnc-branco fnc-vermelho-hover espaco-letra fonte12">Aluguéis</a></li>
                        <li class="mg-l-3 mobile-li"><a href="#favoritos" class="fnc-branco fnc-vermelho-hover espaco-letra fonte12">Favoritos</a></li>
                        <li class="mg-l-3 mobile-li"><a href="#depoimentos" class="fnc-branco fnc-vermelho-hover espaco-letra fonte12">Depoimentos</a></li>
                        <li class="mg-l-3 mobile-li"><a href="#contato" class="fnc-branco fnc-vermelho-hover espaco-letra fonte12">Contato</a></li>
                        <li class="mg-l-3 mobile-li"><a href="index.php" class="fnc-branco fnc-vermelho-hover espaco-letra fonte12">Home</a></li>
                        <li class="mg-l-3 mobile-li"><a href="index.php?controller=UsuarioController&metodo=autenticar" class="fnc-branco fnc-vermelho-hover espaco-letra fonte12">Login</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>

        <div class="limpar"></div>

        <!-- Barra vermelha colada no final do header -->
        <div class="barra bg-vermelho"></div>
    </header>

    <div class="limpar"></div>
    <div class="esconde"></div>

    <!-- Script simples para alternar o menu hambúrguer -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const mainNav = document.getElementById('mainNav');

            if (menuToggle && mainNav) {
                menuToggle.addEventListener('click', function() {
                    menuToggle.classList.toggle('active');
                    mainNav.classList.toggle('active');
                });

                // Fecha o menu ao clicar em qualquer link
                const navLinks = mainNav.querySelectorAll('a');
                navLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        menuToggle.classList.remove('active');
                        mainNav.classList.remove('active');
                    });
                });
            }
        });
    </script>
