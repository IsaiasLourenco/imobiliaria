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
                    <a href="index.php?controller=ProprietarioController&metodo=index" class="fonte14 fnc-cinza">
                        <i class="fa-solid fa-user-tie"></i>
                        Proprietário
                    </a>
                </li>
                <li class="mg-b-1 pd-b-1">
                    <a href="index.php?controller=ImovelController&metodo=index" class="fonte14 fnc-cinza">
                        <i class="fa-solid fa-house-chimney"></i>
                        Imóvel
                    </a>
                </li>
                <li class="mg-b-1 pd-b-1">
                    <a href="index.php?controller=UsuarioController&metodo=index" class="fonte14 fnc-cinza">
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
        <section>
            <div class="box-10">
                <?php if ($_GET['controller'] == 'PainelController' && $_GET['metodo'] == 'index'): ?>
                    Olá!
                <?php else:
                    require_once "Views/".$controller."/".$metodo.".php";
                endif; ?>
            </div>
        </section>
    </div>
</section>