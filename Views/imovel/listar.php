<?php
$valorFormatado = isset($imovel[0]->valor)
    ? 'R$ ' . number_format($imovel[0]->valor, 2, ',', '.')
    : '';
?>

<div class="wd-100">

    <div class="box-8">
        <p class="txt-c fonte20 mg-b-1">
            <i class="fa-solid fa-house-chimney"></i>
            Imóveis
        </p>
    </div>

    <div class="box-4 flex justify-center item-centro">
        <a href="index.php?controller=ImovelController&metodo=cadastrar" class="btn-novo">
            <i class="fa-solid fa-user-plus"></i>
            Novo Imóvel
        </a>
    </div>

</div>
<div class="limpar"></div>

<table class="grid wd-100">
    <thead>
        <tr>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Código Imóvel</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Rua</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Número</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Complemento</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Bairro</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Cidade</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Estado</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Valor</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Detalhes</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($imovel) && count($imovel) > 0):
            foreach ($imovel as $valores):
        ?>
                <tr>
                    <td class="fonte12 espaco-letra fw-300 txt-c"><?= $valores->codigo; ?></td>
                    <td class="fonte12 espaco-letra fw-300 txt-c"><?= $valores->logradouro; ?></td>
                    <td class="fonte12 espaco-letra fw-300 txt-c"><?= $valores->numero; ?></td>
                    <td class="fonte12 espaco-letra fw-300 txt-c"><?= $valores->complemento; ?></td>
                    <td class="fonte12 espaco-letra fw-300 txt-c"><?= $valores->bairro; ?></td>
                    <td class="fonte12 espaco-letra fw-300 txt-c"><?= $valores->cidade; ?></td>
                    <td class="fonte12 espaco-letra fw-300 txt-c"><?= $valores->estado; ?></td>
                    <td class="fonte12 espaco-letra fw-300 txt-c"><?= $valorFormatado; ?></td>
                    <td class="fonte12 espaco-letra fw-300 txt-c">
                        Detalhes do Imóvel
                        <a href="index.php?controller=ImovelController&metodo=detalhes&id=<?= $valores->id; ?>" title="Detalhes do Imóvel">
                            <i class="fa-solid fa-circle-info fnc-azul"></i>
                        </a>
                    </td>
                    <td class="fonte10 espaco-letra fw-300 txt-c">
                        <a href="index.php?controller=ImovelController&metodo=apagar&id=<?= $valores->id; ?>">
                            <i class="fa-solid fa-trash-can fnc-vermelho fonte14" title="Apagar Registro"></i>
                        </a>
                        <a href="index.php?controller=ImovelController&metodo=cadastrar&id=<?= $valores->id; ?>">
                            <i class="fa-solid fa-pen fnc-azul fonte14" title="Editar Registro"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach;
        else: ?>
            <td colspan="9">
                <h6 class="txt-c fonte16 poppins-medium">Nenhum Registro encontrado!</h6>
            </td>
        <?php endif; ?>
    </tbody>
    <tfoot>

    </tfoot>
</table>