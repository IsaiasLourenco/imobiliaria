<?php require_once "Views/shared/header.php";
if (!isset($_SESSION['logado'])) {
    header("location:index.php");
}
?>
<section class="painel">
    <div class="container-cem">
        <!-- MENU DE NAVEGAÇÃO -->
        <div class="box-dois bg-preto-azulado-escuro hg-full">
            <div class="saudar bg-branco pd-10">
                <span class="fonte14">
                    <i class="fa-solid fa-handshake"></i>
                    Seja bem vindo(a) <?php echo isset($_SESSION['nome']) ? $_SESSION['nome'] : 'Visitante'; ?>
                </span>
            </div>
            <ul class="pd-10">
                <li class="mg-b-1 pd-b-1">
                    <a href="index.php?controller=ProprietarioController&metodo=listar" class="fonte14 fnc-cinza">
                        <i class="fa-solid fa-users"></i>
                        Proprietários
                    </a>
                </li>
                <li class="mg-b-1 pd-b-1">
                    <a href="index.php?controller=ImovelController&metodo=listar" class="fonte14 fnc-cinza">
                        <i class="fa-solid fa-house-chimney"></i>
                        Imóveis
                    </a>
                </li>
                <li class="mg-b-1 pd-b-1">
                    <a href="index.php?controller=UsuarioController&metodo=listar" class="fonte14 fnc-cinza">
                        <i class="fa-solid fa-user-tie"></i>
                        Usuários
                    </a>
                </li>
                <li class="mg-b-1 pd-b-1">
                    <a href="index.php?controller=TipoImovelController&metodo=listar" class="fonte14 fnc-cinza">
                        <i class="fa-solid fa-building"></i>
                        Tipo dos Imóveis
                    </a>
                </li>
                <li class="mg-b-1 pd-b-1">
                    <a href="index.php?controller=FinalidadeController&metodo=listar" class="fonte14 fnc-cinza">
                        <i class="fa-solid fa-key"></i>
                        Finalidade dos Imóveis
                    </a>
                </li>
                <li class="mg-b-1 pd-b-1">
                    <a href="index.php?controller=UsuarioController&metodo=logout" class="fonte14 fnc-cinza">
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
                    if (isset($view)) {
                        require_once $view;
                    } else {
                        require_once "Views/" . $controller . "/" . $metodo . ".php";
                    }
                endif; ?>
            </div>
        </section>
    </div>
</section>