<?php require_once "Views/shared/header-login.php";
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
                        <i class="fa-solid fa-users"></i> Proprietários
                    </a>
                </li>
                <li class="mg-b-1 pd-b-1">
                    <a href="index.php?controller=ImovelController&metodo=listar" class="fonte14 fnc-cinza">
                        <i class="fa-solid fa-house-chimney"></i> Imóveis
                    </a>
                </li>
                <li class="mg-b-1 pd-b-1">
                    <a href="index.php?controller=UsuarioController&metodo=listar" class="fonte14 fnc-cinza">
                        <i class="fa-solid fa-user-tie"></i> Usuários
                    </a>
                </li>
                <li class="mg-b-1 pd-b-1">
                    <a href="index.php?controller=TipoImovelController&metodo=listar" class="fonte14 fnc-cinza">
                        <i class="fa-solid fa-building"></i> Tipo dos Imóveis
                    </a>
                </li>
                <li class="mg-b-1 pd-b-1">
                    <a href="index.php?controller=FinalidadeController&metodo=listar" class="fonte14 fnc-cinza">
                        <i class="fa-solid fa-key"></i> Finalidade dos Imóveis
                    </a>
                </li>
                <li class="mg-b-1 pd-b-1">
                    <a href="index.php?controller=UsuarioController&metodo=logout" class="fonte14 fnc-cinza">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Sair
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
                            <i class="fa-solid fa-house-chimney"></i> Home Painel
                        </a>
                    </li>
                </ul>

                <div class="divider mg-t-1 mg-b-1"></div>

                <?php if ($_GET['controller'] == 'PainelController' && $_GET['metodo'] == 'index'): ?>
                    <?php if (isset($mensagens) && count($mensagens) > 0): ?>
                        <?php
                        $qtdMsg = 0;
                        foreach ($mensagens as $m) {
                            if ($m->ativo === '1') {
                                $qtdMsg++;
                            }
                        }
                        ?>

                        <div class="box-12 flex justify-end">
                            <div class="total-msg flex justify-center item-centro">
                                <span class="fnc-vermelho fw-bold"><?php echo $qtdMsg ?></span>
                            </div>
                            <div class="icon-msg" style="cursor: pointer;" title="Mostrar mensagens">
                                <i class="fa-solid fa-envelope fonte20 fnc-vermelho"></i>
                            </div>
                        </div>

                        <!-- Listando as mensagens -->
                        <div class="limpar">
                            <?php foreach ($mensagens as $mensagem): ?>
                                <?php if ($mensagem->ativo === '1'): ?>
                                    <div id="mensagens" class="box-4 mod shadow-down mg-b-2" style="padding-left: 10px">
                                        <p class="fonte14 poppins-medium fw-bold fnc-preto-azulado">
                                            <i class="fa-solid fa-user fnc-vermelho"></i>
                                            Nome: <?php echo $mensagem->nome; ?>
                                        </p>

                                        <p class="fonte12 fnc-preto-azulado">
                                            <i class="fa-solid fa-envelope fnc-vermelho"></i>
                                            <span class="fw-bold">Email:</span>
                                            <span class="fw-normal"><?php echo $mensagem->email; ?></span><br>

                                            <i class="fa-solid fa-phone fnc-vermelho"></i>
                                            <span class="fw-bold">Telefone:</span>
                                            <span class="fw-normal"><?php echo $mensagem->telefone; ?></span><br>

                                            <i class="fa-solid fa-question fnc-vermelho"></i>
                                            <span class="fw-bold">Motivo:</span>
                                            <span class="fw-normal"><?php echo $mensagem->motivo; ?></span><br>

                                            <i class="fa-solid fa-calendar-days fnc-vermelho"></i>
                                            <span class="fw-bold">Data da Mensagem:</span>
                                            <span class="fw-normal"><?php echo date('d/m/Y', strtotime($mensagem->datamensagem)); ?></span>
                                        </p>

                                        <div class="msg-cli fonte12 fnc-preto-azulado bg-cinza overflow-scroll" style="height: 100px; padding: 5px; word-break: break-word; white-space: normal;">
                                            <i class="fa-solid fa-message fnc-vermelho"></i>
                                            <span class="fw-bold">Mensagem:</span><br>
                                            <span class="fw-normal"><?php echo $mensagem->mensagem; ?></span>
                                        </div>
                                        <label class="checkbox-lida">
                                            <input type="checkbox" class="check-lida" data-id="<?php echo $mensagem->id; ?>" <?php echo $mensagem->ativo === '0' ? 'checked' : ''; ?>>
                                            <span class="fonte12">Lida</span>
                                        </label>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <?php
                    if (isset($view)) {
                        require_once $view;
                    } else {
                        require_once "Views/" . $controller . "/" . $metodo . ".php";
                    }
                    ?>
                <?php endif; ?>
                <script src="lib/js/mostrar-mensagem.js"></script>
                <script src="lib/js/status-mensagem-lida.js"></script>
            </div>
        </section>
    </div>
</section>