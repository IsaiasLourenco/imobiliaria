<?php $modoEdicao = !empty($tipoImovel) && $tipoImovel->getId(); ?>

<div class="box-8">
    <h2 class="fonte20">
        <?php if ($modoEdicao): ?>
            <i class="fa-solid fa-pen-ruler"></i>
            <i class="fa-solid fa-building"></i>
            Editar Tipo de Imóveis
        <?php else: ?>
            <i class="fa-solid fa-notes-medical"></i>
            <i class="fa-solid fa-building"></i>
            Cadastrar Tipo de Imóveis
        <?php endif; ?>
    </h2>
</div>

<div class="limpar"></div>
<div class="divider mg-b-2 mg-t-2"></div>

<form action="" method="POST" class="box-12">
    <div class="row">
        <div class="box-12" style="background-color: transparent; color: #333;">
            <label>
                Descrição
                <input tabindex="1" type="text" name="descricao"
                       value="<?= $modoEdicao ? $tipoImovel->getDescricao() : '' ?>"
                       autofocus required>
            </label>
        </div>
    </div>

    <?php if ($modoEdicao): ?>
        <input type="hidden" name="id" value="<?= $tipoImovel->getId() ?>">
    <?php endif; ?>

    <div class="row">
        <div class="btn-centralizado">
            <button type="submit"
                    class="btn <?= $modoEdicao ? 'bg-azul bg-azul-claro-hover' : 'bg-vermelho bg-vermelho-claro-hover' ?> fnc-branco mg-t-2">
                <i class="fas <?= $modoEdicao ? 'fa-sync-alt' : 'fa-plus' ?>"></i>
                <?= $modoEdicao ? 'Atualizar' : 'Cadastrar' ?>
            </button>
        </div>
    </div>
</form>