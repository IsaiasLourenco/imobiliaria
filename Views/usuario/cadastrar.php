<div class="box-8">
    <?php if (!empty($usuario)): ?>
        <h2 class="fonte20">
            <i class="fa-solid fa-pen-ruler"></i>
            <i class="fa-solid fa-keyboard"></i>
            Editar Usuário
        </h2>
    <?php else: ?>
        <h2 class="fonte20">
            <i class="fa-solid fa-notes-medical"></i>
            <i class="fa-solid fa-keyboard"></i>
            Cadastrar Usuário
        </h2>
    <?php endif; ?>
</div>
<div class="limpar"></div>
<div class="divider mg-b-2 mg-t-2"></div>

<form action="" method="POST" class="box-12" enctype="multipart/form-data">

    <div class="row">
        <div class="box-3" style="background-color: transparent; color: #333;">
            <label for="">Nome</label>
            <input tabindex="1" type="text" name="nome" value="<?= $usuario[0]->NOME ?? '' ?>" autofocus>
        </div>
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="usuario">Usuário</label>
            <input tabindex="2" type="text" name="usuario" id="usuario" value="<?= $usuario[0]->USUARIO ?? '' ?>">
        </div>
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="senha">Senha</label>
            <div style="position: relative;">
                <input tabindex="3" type="password" name="senha" id="senha" value="<?= $usuario[0]->SENHA ?? '' ?>" style="padding-right: 40px;">
                <span id="toggleSenha" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                    👁️
                </span>
            </div>
        </div>
        <div class="box-3" style="background-color: transparent; color: #333;">
            <label for="email">Email</label>
            <input tabindex="4" type="email" name="email" id="email" value="<?= $usuario[0]->EMAIL ?? '' ?>">
        </div>
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="telefone">Telefone</label>
            <input tabindex="5" type="text" name="telefone" id="telefone" value="<?= $usuario[0]->TELEFONE ?? '' ?>">
        </div>
    </div>

    <div class="row">
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="cep">CEP</label>
            <input tabindex="6" type="text" name="cep" id="cep" value="<?= $usuario[0]->CEP ?? '' ?>">
        </div>
        <div class="box-3">
            <label for="logradouro">Rua</label>
            <input tabindex="7" type="text" name="logradouro" id="rua" value="<?= $usuario[0]->LOGRADOURO ?? '' ?>">
        </div>
        <div class="box-1">
            <label for="numero">Numero</label>
            <input tabindex="8" type="text" name="numero" id="numero" value="<?= $usuario[0]->NUMERO ?? '' ?>">
        </div>
        <div class="box-3">
            <label for="bairro">Bairro</label>
            <input tabindex="9" type="text" name="bairro" id="bairro" value="<?= $usuario[0]->BAIRRO ?? '' ?>">
        </div>
        <div class="box-3">
            <label for="cidade">Cidade</label>
            <input tabindex="10" type="text" name="cidade" id="cidade" value="<?= $usuario[0]->CIDADE ?? '' ?>">
        </div>
    </div>

    <div class="row">
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="estado">Estado</label>
            <input tabindex="11" type="text" name="estado" id="estado" value="<?= $usuario[0]->ESTADO ?? '' ?>">
        </div>
        <div class="box-4">
            <label for="perfil">Perfil</label>
            <select tabindex="12" name="perfil" id="perfil">
                <?php if (!isset($id) || $id == ''): ?>
                    <option value="" selected disabled>Selecione um perfil...</option>
                <?php endif; ?>

                <?php if (isset($perfil) && count($perfil) > 0):
                    foreach ($perfil as $valores):
                        $idPerfilUsuario = $usuario[0]->PERFIL ?? ''; // Corrigido: campo em maiúsculas
                        $selected = ($idPerfilUsuario == $valores->ID) ? 'selected' : '';
                        echo "<option value='{$valores->ID}' {$selected}>{$valores->DESCRICAO}</option>";
                    endforeach;
                endif; ?>
            </select>
        </div>
        <div class="box-6">
            <?php
            $imagem = isset($id) && $id != '' ? $usuario[0]->IMAGEM : 'user-padrao.png';
            $dirImagem = 'lib/img/users-imagens/' . $imagem;
            $imagemAlt = $imagem === 'user-padrao.png' ? 'Escolha uma imagem...' : 'Imagem do Usuário.';
            ?>
            <label for="img" class="fonte14 fnc-preto-azulado" style="cursor: pointer;">
                <i class="fa-solid fa-file-image fonte20"></i>
                <?php echo $imagemAlt; ?>
            </label>
            <input tabindex="13" type="file" id="img" name="imagem" value="<?php echo $imagem; ?>" onchange="mostrar(this)">
            <img class="logo-100" id="foto" src="<?php echo $dirImagem ?>" alt="<?php echo $imagemAlt; ?>">
        </div>

    </div>

    <div class="row">
        <div class="btn-centralizado">
            <button type="submit"
                class="btn <?= !empty($usuario) ? 'bg-azul bg-azul-claro-hover' : 'bg-vermelho bg-vermelho-claro-hover' ?> fnc-branco mg-t-2">
                <i class="fas <?= !empty($usuario) ? 'fa-sync-alt' : 'fa-plus' ?>"></i>
                <?= !empty($usuario) ? 'Atualizar' : 'Cadastrar' ?>
            </button>
        </div>
        <?php if (!empty($usuario[0]->ID)): ?>
            <input type="hidden" name="id" value="<?= $usuario[0]->ID ?>">
        <?php endif; ?>
    </div>
</form>