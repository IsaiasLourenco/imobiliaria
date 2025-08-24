<div class="box-8">
    <?php if (!empty($imovel)): ?>
        <h2 class="fonte20">
            <i class="fa-solid fa-pen-ruler"></i>
            <i class="fa-solid fa-house-chimney"></i>
            Editar Imóvel
        </h2>
    <?php else: ?>
        <h2 class="fonte20">
            <i class="fa-solid fa-notes-medical"></i>
            <i class="fa-solid fa-house-chimney"></i>
            Cadastrar Imóvel
        </h2>
    <?php endif; ?>
</div>
<div class="limpar"></div>
<div class="divider mg-b-2 mg-t-2"></div>

<?php
$valorFormatado = isset($imovel) && isset($imovel->valor) ? 'R$ ' . number_format($imovel->valor, 2, ',', '.') : '';
$quartosFormatado = isset($imovel) && isset($imovel->quartos) ? str_pad($imovel->quartos, 3, '0', STR_PAD_LEFT) : '';
$banheirosFormatado = isset($imovel) && isset($imovel->banheiros) ? str_pad($imovel->banheiros, 3, '0', STR_PAD_LEFT) : '';
$garagemFormatado = isset($imovel) && isset($imovel->garagem) ? str_pad($imovel->garagem, 3, '0', STR_PAD_LEFT) : '';
$areaTotalFormatada = isset($imovel) && isset($imovel->areatotal) ? $imovel->areatotal . ' m²' : '';
$areaConstruidaFormatada = isset($imovel) && isset($imovel->areaconstruida) ? $imovel->areaconstruida . ' m²' : '';
?>

<form action="" method="POST" class="box-12" enctype="multipart/form-data">

    <div class="row">
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="valor">Valor</label>
            <input tabindex="2" type="text" name="valor" id="valor" value="<?= $valorFormatado ?>" required autofocus>
        </div>
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="cep">CEP</label>
            <input tabindex="3" type="text" name="cep" id="cep" value="<?= isset($imovel) && isset($imovel->cep) ? $imovel->cep : '' ?>" required>
        </div>
        <div class="box-3">
            <label for="logradouro">Rua</label>
            <input readonly tabindex="4" type="text" name="logradouro" id="rua" value="<?= isset($imovel) && isset($imovel->logradouro) ? $imovel->logradouro : '' ?>" required>
        </div>
        <div class="box-1">
            <label for="numero">Numero</label>
            <input tabindex="6" type="text" name="numero" id="numero" value="<?= isset($imovel) && isset($imovel->numero) ? $imovel->numero : '' ?>" required>
        </div>
        <div class="box-4">
            <label for="complemento">Complemento</label>
            <input tabindex="6" type="text" name="complemento" id="complemento" value="<?= isset($imovel) && isset($imovel->complemento) ? $imovel->complemento : '' ?>">
        </div>
    </div>

    <div class="row">
        <div class="box-3">
            <label for="bairro">Bairro</label>
            <input readonly tabindex="7" type="text" name="bairro" id="bairro" value="<?= isset($imovel) && isset($imovel->bairro) ? $imovel->bairro : '' ?>" required>
        </div>
        <div class="box-3">
            <label for="cidade">Cidade</label>
            <input readonly type="text" name="cidade" id="cidade" value="<?= isset($imovel) && isset($imovel->cidade) ? $imovel->cidade : '' ?>" required>
        </div>
        <div class="box-1">
            <label for="estado">Estado</label>
            <input readonly type="text" name="estado" id="estado" value="<?= isset($imovel) && isset($imovel->estado) ? $imovel->estado : '' ?>" required>
        </div>
        <div class="box-1">
            <label for="quartos">Quartos</label>
            <input tabindex="8" type="text" name="quartos" id="quartos" value="<?= $quartosFormatado ?>" required>
        </div>
        <div class="box-1">
            <label for="banheiros">Banheiros</label>
            <input tabindex="9" type="text" name="banheiros" id="banheiros" value="<?= $banheirosFormatado ?>" required>
        </div>
        <div class="box-1">
            <label for="garagem">Garagem</label>
            <input tabindex="10" type="text" name="garagem" id="garagem" value="<?= $garagemFormatado ?>" required>
        </div>
        <div class="box-1">
            <label for="areatotal">Área Total</label>
            <input tabindex="11" type="text" name="areatotal" id="areatotal" value="<?= $areaTotalFormatada ?>" required>
        </div>
        <div class="box-1">
            <label for="areaconstruida">Área Const</label>
            <input tabindex="12" type="text" name="areaconstruida" id="areaconstruida" value="<?= $areaConstruidaFormatada ?>" required>
        </div>
    </div>

    <div class="row">
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="status">Status</label>
            <select tabindex="13" name="status" id="status" required>
                <option value="" disabled <?= !isset($imovel) ? 'selected' : '' ?>>Selecione status do imóvel...</option>
                <?php if (isset($statusimovel) && count($statusimovel) > 0):
                    foreach ($statusimovel as $status):
                        $selected = (isset($imovel) && $imovel->statusimovel == $status->id) ? 'selected' : '';
                        echo "<option value='{$status->id}' {$selected}>{$status->descricao}</option>";
                    endforeach;
                endif; ?>
            </select>
        </div>
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="tipo">Tipo</label>
            <select tabindex="14" name="tipo" id="tipo" required>
                <option value="" disabled <?= !isset($imovel) ? 'selected' : '' ?>>Selecione tipo do imóvel...</option>
                <?php if (isset($tipoimovel) && count($tipoimovel) > 0):
                    foreach ($tipoimovel as $tipo):
                        $selected = (isset($imovel) && $imovel->tipoimovel == $tipo->id) ? 'selected' : '';
                        echo "<option value='{$tipo->id}' {$selected}>{$tipo->descricao}</option>";
                    endforeach;
                endif; ?>
            </select>
        </div>
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="finalidade">Finalidade</label>
            <select tabindex="15" name="finalidade" id="finalidade" required>
                <option value="" disabled <?= !isset($imovel) ? 'selected' : '' ?>>Selecione finalidade...</option>
                <?php if (isset($finalidadeimovel) && count($finalidadeimovel) > 0):
                    foreach ($finalidadeimovel as $finalidade):
                        $selected = (isset($imovel) && $imovel->finalidade == $finalidade->id) ? 'selected' : '';
                        echo "<option value='{$finalidade->id}' {$selected}>{$finalidade->descricao}</option>";
                    endforeach;
                endif; ?>
            </select>
        </div>
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="proprietario">Proprietário</label>
            <select tabindex="16" name="proprietario" id="proprietario" required>
                <option value="" disabled <?= !isset($imovel) ? 'selected' : '' ?>>Selecione o Proprietário...</option>
                <?php if (isset($proprietarioimovel) && count($proprietarioimovel) > 0):
                    foreach ($proprietarioimovel as $prop):
                        $selected = (isset($imovel) && $imovel->proprietario == $prop->id) ? 'selected' : '';
                        echo "<option value='{$prop->id}' {$selected}>{$prop->nome}</option>";
                    endforeach;
                endif; ?>
            </select>
        </div>
        <div class="box-4">
            <?php
            $imagem = isset($imovel) && isset($imovel->imagemcapa) ? $imovel->imagemcapa : 'sem-foto.jpg';
            $dirImagem = 'lib/img/imagens/' . $imagem;
            $imagemAlt = $imagem === 'sem-foto.jpg' ? 'Escolha uma imagem...' : 'Imagem do Imóvel.';
            ?>
            <label for="img" class="fonte14 fnc-preto-azulado" style="cursor: pointer;">
                <i class="fa-solid fa-file-image fonte20"></i>
                <?= $imagemAlt ?>
            </label>
            <input tabindex="13" type="file" id="img" name="imagem" value="<?= $imagem ?>" onchange="mostrar(this)">
            <img class="logo-100" id="foto" src="<?= $dirImagem ?>" alt="<?= $imagemAlt ?>">
        </div>
    </div>

    <div class="row">
        <div class="box-4">
            <?php if (isset($imovel) && !empty($imovel->id)): ?>
                <a href="index.php?controller=ImovelController&metodo=fotos&id=<?= (int)$imovel->id ?>" class="btn-ver-fotos">
                    📸 Ver galeria de fotos
                </a>
                <div class="limpar" style="margin-bottom: 1rem;"></div>
                <label for="imagem_galeria" class="fonte14 fnc-preto-azulado" style="cursor: pointer;">
                    <i class="fa-solid fa-images fonte20"></i>
                    Adicionar imagens à galeria
                </label>
                <input type="file" name="imagem_galeria" id="imagem_galeria" accept="image/*">
            <?php endif; ?>
        </div>
        <div class="btn-centralizado">
            <button type="submit"
                class="btn <?= isset($imovel) ? 'bg-azul bg-azul-claro-hover' : 'bg-vermelho bg-vermelho-claro-hover' ?> fnc-branco mg-t-2">
                <i class="fas <?= isset($imovel) ? 'fa-sync-alt' : 'fa-plus' ?>"></i>
                <?= isset($imovel) ? 'Atualizar' : 'Cadastrar' ?>
            </button>
        </div>
        <?php if (isset($imovel) && !empty($imovel->id)): ?>
            <input type="hidden" name="id" value="<?= $imovel->id ?>">
        <?php endif; ?>
    </div>
</form>