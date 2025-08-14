<?php 
    if ($_GET) {
        $controller = strtolower(string: str_replace(search: "Controller", replace: "", subject: $_GET['controller']));
        $metodo = strtolower(string: $_GET['metodo']);
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
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
     <script src="lib/js/mascaras.js"></script>
    <!-- Fontawesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" rel="stylesheet">
    <!-- Fontes Externas -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="lib/css/site.css">
    <link rel="stylesheet" href="lib/css/aurora.css">
    <!-- Ícone -->
    <link rel="icon" href="lib/img/icone.ico" type="image/x-icon">
</head>

<body>
    <header class="header bg-preto-azulado-escuro hg-80 wd-100 pd-t-2">
        <div class="container">

            <div class="box-6 flex justify-start item-centro">
                <a href="index.php">
                    <h1 class="fonte36 fnc-branco">Imobiliária<span class="fonte22 fw-300"> - Vetor256.</span></h1>
                </a>
                <a href="https://www.facebook.com/NewProfileIsaiasLourenco" target="_blank" title="Visite nosso Facebook"><i class="fa-brands fa-facebook-f  fonte22 fnc-branco mg-r-3 fnc-vermelho-hover mg-l-14"></i></a>
                <a href="https://www.linkedin.com/in/isaias-lourenco/" target="_blank" title="Visite nosso Linkedin"><i class="fa-brands fa-linkedin-in fonte22 fnc-branco mg-r-3 fnc-vermelho-hover"></i></a>
                <a href="https://www.youtube.com/@vetor256.-62" target="_blank" title="Visite nosso canal no Youtube"><i class="fa-brands fa-youtube fonte22 fnc-branco mg-r-3 fnc-vermelho-hover"></i></a>
            </div>

            <div class="box-6">
                <nav class="wd-100 mg-t-1">
                    <ul class="flex justify-end">
                        <li class="mg-l-3"><a href="#home" class="fnc-branco fnc-vermelho-hover espaco-letra fonte16">Home</a></li>
                        <li class="mg-l-3"><a href="#comprar" class="fnc-branco fnc-vermelho-hover espaco-letra fonte16">Compras</a></li>
                        <li class="mg-l-3"><a href="#alugar" class="fnc-branco fnc-vermelho-hover espaco-letra fonte16">Aluguéis</a></li>
                        <li class="mg-l-3"><a href="#depoimentos" class="fnc-branco fnc-vermelho-hover espaco-letra fonte16">Depoimentos</a></li>
                        <li class="mg-l-3"><a href="#contato" class="fnc-branco fnc-vermelho-hover espaco-letra fonte16">Contato</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="limpar"></div>
        <div class="barra bg-vermelho"></div>
    </header>
    <div class="limpar"></div>
    <div class="esconde"></div>