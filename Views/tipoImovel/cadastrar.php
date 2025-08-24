<div class="box-8">
    <?php if (!empty($proprietario)): ?>
        <h2 class="fonte20">
            <i class="fa-solid fa-pen-ruler"></i>
            <i class="fa-solid fa-building"></i>
            Editar Tipo de Imóveis
        </h2>
    <?php else: ?>
        <h2 class="fonte20">
            <i class="fa-solid fa-notes-medical"></i>
            <i class="fa-solid fa-building"></i>
            Cadastrar Tipo de Imóveis
        </h2>
    <?php endif; ?>
</div>
<div class="limpar"></div>
<div class="divider mg-b-2 mg-t-2"></div>
<form action="" method="POST" class="box-12">

    <div class="row">
        <div class="box-12" style="background-color: transparent; color: #333;">
            <label>
                Descrição
                <input tabindex="1" type="text" name="descricao" value="<?= $tipoImovel->descriao ?? '' ?>" autofocus required>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="btn-centralizado">
            <button type="submit"
                class="btn <?= !empty($tipoImovel) ? 'bg-azul bg-azul-claro-hover' : 'bg-vermelho bg-vermelho-claro-hover' ?> fnc-branco mg-t-2">
                <i class="fas <?= !empty($tipoImovel) ? 'fa-sync-alt' : 'fa-plus' ?>"></i>
                <?= !empty($tipoImovel) ? 'Atualizar' : 'Cadastrar' ?>
            </button>
        </div>
        <?php if (!empty($tipoImovel->id)): ?>
            <input type="text" name="id" value="<?= $tipoImovel->id ?>">
        <?php endif; ?>
    </div>
</form>