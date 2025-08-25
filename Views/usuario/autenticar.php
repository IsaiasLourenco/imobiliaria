<?php
require_once "Views/shared/header.php";
?>
<link rel="stylesheet" href="lib/css/login.css">
<section class="login">
    <div class="container">
        <div class="box-12 mg-t-2 flex justify-center">
            <div class="box-8 shadow-down">
                <div class="box-4 radius-start pd-20 esquerda flex justify-center item-centro flex-colum bg-preto-azulado-claro">
                    <h2 class="fw-300 espaco-letra fonte18 fnc-cinza txt-c">Acesse o sistema com seu usuário e senha.</h2>
                    <h1 class="txt-c mg-t-2 fonte36 fnc-vermelho">Imobiliária<span class="fonte22 fw-300"><br> Vetor256.</span></h1>
                </div>
                <div class="box-4 direita">
                    <form action="" method="POST">
                        <label class="fnc-preto-azulado" for="usuario">Usuário</label>
                        <input tabindex="1" type="text" name="usuario" id="usuario" autofocus required>

                        <label class="fnc-preto-azulado" for="senha">Senha</label>
                        <div style="position: relative;">
                            <input tabindex="2" type="password" name="senha" id="senha" required style="padding-right: 40px;">
                            <span id="toggleSenha" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                👁️
                            </span>
                        </div>

                        <input type="submit" value="Login" class="mg-t-2 btn fnc-branco bg-vermelho bg-vermelho-claro-hover">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>