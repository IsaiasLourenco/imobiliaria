<div class="box-8">
    <?php if (!empty($proprietario)): ?>
        <h2 class="fonte20">
            <i class="fa-solid fa-pen-ruler"></i>
            <i class="fa-solid fa-users"></i>
            Editar Proprietário
        </h2>
    <?php else: ?>
        <h2 class="fonte20">
            <i class="fa-solid fa-notes-medical"></i>
            <i class="fa-solid fa-users"></i>
            Cadastrar Proprietário
        </h2>
    <?php endif; ?>
</div>
<div class="limpar"></div>
<div class="divider mg-b-2 mg-t-2"></div>
<form method="POST" class="box-12">

    <div class="row">
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label>
                Nome
                <input tabindex="1" type="text" name="nome" value="<?= $proprietario->nome ?? '' ?>" autofocus required>
            </label>
        </div>
        <div class="box-3">
            <fieldset class="fonte14">
                <legend>Sexo</legend>
                <div class="radio-group">
                    <label class="fonte14">
                        <input type="radio" name="sexo" value="M" <?= (isset($proprietario) && $proprietario->sexo === 'M') ? 'checked' : '' ?> required>
                        Masculino
                    </label>
                    <label class="fonte14">
                        <input type="radio" name="sexo" value="F" <?= (isset($proprietario) && $proprietario->sexo === 'F') ? 'checked' : '' ?> required>
                        Feminino
                    </label>
                </div>
            </fieldset>
        </div>
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="telefone">Fone</label>
            <input tabindex="2" type="text" name="contato" id="telefone" value="<?= $proprietario->contato ?? '' ?>" required>
        </div>
        <div class="box-3">
            <label for="email">Email</label>
            <input tabindex="3" type="email" name="email" id="email" value="<?= $proprietario->email ?? '' ?>" required>
        </div>
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="cep">CEP</label>
            <input tabindex="4" type="text" name="cep" id="cep" value="<?= $proprietario->cep ?? '' ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="logradouro">Rua</label>
            <input readonly type="text" name="logradouro" id="rua" value="<?= $proprietario->logradouro ?? '' ?>" required>
        </div>
        <div class="box-1">
            <label for="numero">Numero</label>
            <input tabindex="5" type="text" name="numero" id="numero" value="<?= $proprietario->numero ?? '' ?>" required>
        </div>
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="complemento">Complemento</label>
            <input tabindex="6" type="text" name="complemento" id="complemento" value="<?= $proprietario->complemento ?? '' ?>">
        </div>
        <div class="box-3">
            <label for="bairro">Bairro</label>
            <input readonly type="text" name="bairro" id="bairro" value="<?= $proprietario->bairro ?? '' ?>" required>
        </div>
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="cidade">Cidade</label>
            <input readonly type="text" name="cidade" id="cidade" value="<?= $proprietario->cidade ?? '' ?>" required>
        </div>
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="estado">Estado</label>
            <input readonly type="text" name="estado" id="estado" value="<?= $proprietario->estado ?? '' ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="btn-centralizado">
            <button type="submit"
                class="btn <?= !empty($proprietario) ? 'bg-azul bg-azul-claro-hover' : 'bg-vermelho bg-vermelho-claro-hover' ?> fnc-branco mg-t-2">
                <i class="fas <?= !empty($proprietario) ? 'fa-sync-alt' : 'fa-plus' ?>"></i>
                <?= !empty($proprietario) ? 'Atualizar' : 'Cadastrar' ?>
            </button>
        </div>
        <?php if (!empty($proprietario->id)): ?>
            <input type="hidden" name="id" value="<?= $proprietario->id ?>">
        <?php endif; ?>
    </div>
</form>