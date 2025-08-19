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
$valorFormatado = isset($imovel[0]->valor)
    ? 'R$ ' . number_format($imovel[0]->valor, 2, ',', '.')
    : '';
$quartosFormatado = isset($imovel[0]->quartos) ? str_pad($imovel[0]->quartos, 3, '0', STR_PAD_LEFT) : '';
$banheirosFormatado = isset($imovel[0]->banheiros) ? str_pad($imovel[0]->banheiros, 3, '0', STR_PAD_LEFT) : '';
$garagemFormatado = isset($imovel[0]->garagem) ? str_pad($imovel[0]->garagem, 3, '0', STR_PAD_LEFT) : '';
$areaTotalFormatada = isset($imovel[0]->areatotal) ? $imovel[0]->areatotal . ' m²' : '';
$areaConstruidaFormatada = isset($imovel[0]->areaconstruida) ? $imovel[0]->areaconstruida . ' m²' : '';
?>
<form action="" method="POST" class="box-12" enctype="multipart/form-data">

    <div class="row">
        <div class="box-1">
            <label for="codigo_imovel">Código</label>
            <input tabindex="1" type="text" name="codigo_imovel" value="<?= $imovel[0]->codigo ?? '' ?>" autofocus required>
        </div>
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="valor">Valor</label>
            <input tabindex="2" type="text" name="valor" id="valor" value="<?php echo $valorFormatado ?>" required>
        </div>
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="cep">CEP</label>
            <input tabindex="3" type="text" name="cep" id="cep" value="<?= $imovel[0]->cep ?? '' ?>" required>
        </div>
        <div class="box-3">
            <label for="logradouro">Rua</label>
            <input readonly type="text" name="logradouro" id="rua" value="<?= $imovel[0]->logradouro ?? '' ?>" required>
        </div>
        <div class="box-1">
            <label for="numero">Numero</label>
            <input tabindex="4" type="text" name="numero" id="numero" value="<?= $imovel[0]->numero ?? '' ?>" required>
        </div>
        <div class="box-3">
            <label for="complemento">Complemento</label>
            <input tabindex="5" type="text" name="complemento" id="complemento" value="<?= $imovel[0]->complemento ?? '' ?>">
        </div>
    </div>

    <div class="row">
        <div class="box-3">
            <label for="bairro">Bairro</label>
            <input readonly type="text" name="bairro" id="bairro" value="<?= $imovel[0]->bairro ?? '' ?>" required>
        </div>
        <div class="box-3">
            <label for="cidade">Cidade</label>
            <input readonly type="text" name="cidade" id="cidade" value="<?= $imovel[0]->cidade ?? '' ?>" required>
        </div>
        <div class="box-1">
            <label for="estado">Estado</label>
            <input readyonly type="text" name="estado" id="estado" value="<?= $imovel[0]->estado ?? '' ?>" required>
        </div>
        <div class="box-1">
            <label for="quartos">Quartos</label>
            <input tabindex="6" type="text" name="quartos" id="quartos" value="<?= $quartosFormatado ?>" required>
        </div>
        <div class="box-1">
            <label for="banheiros">Banheiros</label>
            <input tabindex="7" type="text" name="banheiros" id="banheiros" value="<?= $banheirosFormatado ?>" required>
        </div>
        <div class="box-1">
            <label for="garagem">Garagem</label>
            <input tabindex="8" type="text" name="garagem" id="garagem" value="<?= $garagemFormatado ?>" required>
        </div>
        <div class="box-1">
            <label for="areatotal">Área → Total</label>
            <input tabindex="9" type="text" name="areatotal" id="areatotal" value="<?= $areaTotalFormatada ?>" required>
        </div>
        <div class="box-1">
            <label for="areaconstruida">Construída</label>
            <input tabindex="10" type="text" name="areaconstruida" id="areaconstruida" value="<?= $areaConstruidaFormatada ?>" required>
        </div>
    </div>

    <div class="row">
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="status">Status</label>
            <select tabindex="11" name="status" id="status" required>
                <?php if (!isset($id) || $id == ''): ?>
                    <option value="" selected disabled>Selecione status do imóvel...</option>
                <?php endif; ?>

                <?php if (isset($statusimovel) && count($statusimovel) > 0):
                    foreach ($statusimovel as $status):
                        $idStatus = $imovel[0]->statusimovel ?? '';
                        $selected = ($idStatus == $status->id) ? 'selected' : '';
                        echo "<option value='{$status->id}' {$selected}>{$status->descricao}</option>";
                    endforeach;
                endif; ?>
            </select>
        </div>
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="tipo">Tipo</label>
            <select tabindex="12" name="tipo" id="tipo" required>
                <?php if (!isset($id) || $id == ''): ?>
                    <option value="" selected disabled>Selecione tipo do imóvel...</option>
                <?php endif; ?>

                <?php if (isset($tipoimovel) && count($tipoimovel) > 0):
                    foreach ($tipoimovel as $tipo):
                        $idTipo = $imovel[0]->tipoimovel ?? '';
                        $selected = ($idTipo == $tipo->id) ? 'selected' : '';
                        echo "<option value='{$tipo->id}' {$selected}>{$tipo->descricao}</option>";
                    endforeach;
                endif; ?>
            </select>
        </div>
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="finalidade">Finalidade</label>
            <select tabindex="13" name="finalidade" id="finalidade" required>
                <?php if (!isset($id) || $id == ''): ?>
                    <option value="" selected disabled>Selecione finalidade...</option>
                <?php endif; ?>

                <?php if (isset($finalidadeimovel) && count($finalidadeimovel) > 0):
                    foreach ($finalidadeimovel as $finalidade):
                        $idFinalidade = $imovel[0]->finalidade ?? '';
                        $selected = ($idFinalidade == $finalidade->id) ? 'selected' : '';
                        echo "<option value='{$finalidade->id}' {$selected}>{$finalidade->descricao}</option>";
                    endforeach;
                endif; ?>
            </select>
        </div>
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="proprietario">Proprietário</label>
            <select tabindex="14" name="proprietario" id="proprietario" required>
                <?php if (!isset($id) || $id == ''): ?>
                    <option value="" selected disabled>Selecione o Proprietário...</option>
                <?php endif; ?>

                <?php if (isset($proprietarioimovel) && count($proprietarioimovel) > 0):
                    foreach ($proprietarioimovel as $proprietario):
                        $idProprietario = $imovel[0]->proprietario ?? '';
                        $selected = ($idProprietario == $proprietario->id) ? 'selected' : '';
                        echo "<option value='{$proprietario->id}' {$selected}>{$proprietario->nome}</option>";
                    endforeach;
                endif; ?>
            </select>
        </div>
        <div class="box-4">
            <?php
            $imagem = isset($id) && $id != '' ? $imovel[0]->imagemcapa : 'sem-foto.jpg';
            $dirImagem = 'lib/img/imagens/' . $imagem;
            $imagemAlt = $imagem === 'sem-foto.jpg' ? 'Escolha uma imagem...' : 'Imagem do Imóvel.';
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
        <?php if (!empty($usuario[0]->id)): ?>
            <input type="hidden" name="id" value="<?= $usuario[0]->id ?>">
        <?php endif; ?>
    </div>
</form>