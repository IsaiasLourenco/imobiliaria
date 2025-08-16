<?php require_once "Views/shared/header.php"; ?>
<section class="painel">
    <div class="container-cem">
        <!-- MENU DE NAVEGAÇÃO -->
        <div class="box-dois bg-preto-azulado-escuro hg-full">
            <div class="saudar bg-branco pd-10">
                <span class="fonte14">
                    <i class="fa-solid fa-handshake"></i>
                    Seja bem vindo Usuário!
                </span>
            </div>
            <ul class="pd-10">
                <li class="mg-b-1 pd-b-1">
                    <a href="index.php?controller=ProprietarioController&metodo=listar" class="fonte14 fnc-cinza">
                        <i class="fa-solid fa-user-tie"></i>
                        Proprietário
                    </a>
                </li>
                <li class="mg-b-1 pd-b-1">
                    <a href="index.php?controller=ImovelController&metodo=listar" class="fonte14 fnc-cinza">
                        <i class="fa-solid fa-house-chimney"></i>
                        Imóvel
                    </a>
                </li>
                <li class="mg-b-1 pd-b-1">
                    <a href="index.php?controller=UsuarioController&metodo=listar" class="fonte14 fnc-cinza">
                        <i class="fa-solid fa-keyboard"></i>
                        Usuário
                    </a>
                </li>
                <li class="mg-b-1 pd-b-1">
                    <a href="" class="fonte14 fnc-cinza">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        Sair
                    </a>
                </li>
            </ul>
        </div>
        <!-- FIM MENU DE NAVEGAÇÃO -->
        <section class="wd-100">
            <div class="wd-100 coluna bg-branco pd-b-2">
                <ul class="wd-100 flex justify-end mg-t-1 mg-b-1">
                    <li style="margin-left: auto;">
                        <a href="index.php?controller=PainelController&metodo=index" class="fnc-vermelho-hover fonte14 fnc-preto-azulado mg-r-1">
                            <i class="fa-solid fa-house-chimney"></i>
                            Home Painel
                        </a>
                    </li>
                </ul>
                <div class="divider mg-t-1 mg-b-1"></div>
                <?php if ($_GET['controller'] == 'PainelController' && $_GET['metodo'] == 'index'): ?>
                <?php else:
                    require_once "Views/" . $controller . "/" . $metodo . ".php";
                endif; ?>
            </div>
        </section>
    </div>
</section>