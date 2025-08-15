<div class="box-8">
    <?php if (!empty($proprietario)): ?>
        <h2 class="fonte20">
            <i class="fa-solid fa-pen-ruler"></i>
            <i class="fa-solid fa-user-tie"></i>
            Editar Proprietários
        </h2>
    <?php else: ?>
        <h2 class="fonte20">
            <i class="fa-solid fa-notes-medical"></i>
            <i class="fa-solid fa-user-tie"></i>
            Cadastrar Proprietários
        </h2>
    <?php endif; ?>
</div>
<div class="limpar"></div>
<div class="divider mg-b-2 mg-t-2"></div>
<form action="" method="POST" class="box-12">

    <div class="row">
        <div class="box-3">
            <label>
                Nome
                <input type="text" name="nome" value="<?= $proprietario[0]->NOME ?? '' ?>" autofocus>
            </label>
        </div>
        <div class="box-3">
            <fieldset class="fonte14">
                <legend>Sexo</legend>
                <div class="radio-group">
                    <label class="fonte14">
                        <input type="radio" name="sexo" value="M" <?= (isset($proprietario[0]) && $proprietario[0]->SEXO === 'M') ? 'checked' : '' ?>>
                        Masculino
                    </label>
                    <label class="fonte14">
                        <input type="radio" name="sexo" value="F" <?= (isset($proprietario[0]) && $proprietario[0]->SEXO === 'F') ? 'checked' : '' ?>>
                        Feminino
                    </label>
                </div>
            </fieldset>
        </div>
        <div class="box-3">
            <label for="telefone">Fone</label>
            <input type="text" name="contato" id="telefone" value="<?= $proprietario[0]->CONTATO ?? '' ?>">
        </div>
        <div class="box-3">
            <label for="cep">CEP</label>
            <input type="text" name="cep" id="cep" value="<?= $proprietario[0]->CEP ?? '' ?>">
        </div>
    </div>
    <div class="row">
        <div class="box-3">
            <label for="logradouro">Rua</label>
            <input type="text" name="logradouro" id="rua" value="<?= $proprietario[0]->LOGRADOURO ?? '' ?>">
        </div>
        <div class="box-1">
            <label for="numero">Numero</label>
            <input type="text" name="numero" id="numero" value="<?= $proprietario[0]->NUMERO ?? '' ?>">
        </div>
        <div class="box-3">
            <label for="bairro">Bairro</label>
            <input type="text" name="bairro" id="bairro" value="<?= $proprietario[0]->BAIRRO ?? '' ?>">
        </div>
        <div class="box-3">
            <label for="cidade">Cidade</label>
            <input type="text" name="cidade" id="cidade" value="<?= $proprietario[0]->CIDADE ?? '' ?>">
        </div>
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="estado">Estado</label>
            <input type="text" name="estado" id="estado" value="<?= $proprietario[0]->ESTADO ?? '' ?>">
        </div>
    </div>
    <div class="row">
        <div class="box-3">
            <fieldset class="fonte14">
                <legend>Ativo</legend>
                <div class="radio-group">
                    <label class="fonte14">
                        <input type="radio" name="ativo" value="1" checked <?= (isset($proprietario[0]) && $proprietario[0]->ATIVO == '1') ? 'checked' : '' ?>>
                        Sim
                    </label>
                    <label class="fonte14">
                        <input type="radio" name="ativo" value="0" <?= (isset($proprietario[0]) && $proprietario[0]->ATIVO == '0') ? 'checked' : '' ?>>
                        Não
                    </label>
                </div>
            </fieldset>
        </div>
        <div class="box-3">
            <button type="submit"
                class="btn <?= !empty($proprietario) ? 'bg-azul bg-azul-claro-hover' : 'bg-vermelho bg-vermelho-claro-hover' ?> fnc-branco mg-t-2">
                <i class="fas <?= !empty($proprietario) ? 'fa-sync-alt' : 'fa-plus' ?>"></i>
                <?= !empty($proprietario) ? 'Atualizar' : 'Cadastrar' ?>
            </button>
        </div>
        <?php if (!empty($proprietario[0]->ID)): ?>
            <input type="hidden" name="id" value="<?= $proprietario[0]->ID ?>">
        <?php endif; ?>
    </div>
</form>
<script src=""></script>