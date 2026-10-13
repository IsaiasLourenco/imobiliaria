<div class="wd-100">

    <div class="box-8">
        <p class="txt-c fonte20 mg-b-1">
            <i class="fa-solid fa-house-chimney"></i>
            Imóveis
        </p>
    </div>

    <div class="box-4 flex justify-center item-centro">
        <a href="index.php?controller=ImovelController&metodo=cadastrar" class="btn-novo">
            <i class="fa-solid fa-house-chimney"></i>
            <i class="fa-solid fa-plus"></i>
            Novo Imóvel
        </a>
    </div>

</div>
<div class="limpar"></div>

<table class="grid grid-imoveis wd-100">
    <thead>
        <tr>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Código Imóvel</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Rua</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Número</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Bairro</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Cidade</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Estado</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Finalidade</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Valor</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Detalhes</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($imovel) && count($imovel) > 0):
            foreach ($imovel as $valores):
                $valorFormatado = isset($valores->valor)
                    ? 'R$ ' . number_format($valores->valor, 2, ',', '.')
                    : '';

        ?>
                <tr>
                    <td data-label="Código Imóvel" class="cel-codigo fonte10 espaco-letra fw-300 txt-c"><?= $valores->codigo; ?></td>
                    <td data-label="Rua" class="cel-rua fonte10 espaco-letra fw-300 txt-c"><?= $valores->logradouro; ?></td>
                    <td data-label="Número" class="cel-numero fonte10 espaco-letra fw-300 txt-c"><?= $valores->numero; ?></td>
                    <td data-label="Bairro" class="cel-bairro fonte10 espaco-letra fw-300 txt-c"><?= $valores->bairro; ?></td>
                    <td data-label="Cidade" class="cel-cidade fonte10 espaco-letra fw-300 txt-c"><?= $valores->cidade; ?></td>
                    <td data-label="Estado" class="cel-estado fonte10 espaco-letra fw-300 txt-c"><?= $valores->estado; ?></td>
                    <td data-label="Finalidade" class="cel-finalidade fonte10 espaco-letra fw-300 txt-c"><?= $valores->getFinalidadeDescricao(); ?></td>
                    <td data-label="Valor" class="cel-valor fonte10 espaco-letra fw-300 txt-c"><?= $valorFormatado; ?></td>
                    <td data-label="Detalhes" class="cel-detalhes fonte10 espaco-letra fw-300 txt-c">
                        Detalhes do Imóvel
                        <a href="index.php?controller=ImovelController&metodo=detalhes&id=<?= $valores->id; ?>" title="Detalhes do Imóvel">
                            <i class="fa-solid fa-circle-info fnc-azul"></i>
                        </a>
                    </td>
                    <td data-label="Ações" class="cel-acoes fonte10 espaco-letra fw-300 txt-c">
                        <a href="index.php?controller=ImovelController&metodo=apagar&id=<?= $valores->id; ?>">
                            <i class="fa-solid fa-trash-can fnc-vermelho fonte14" title="Apagar Registro"></i>
                        </a>
                        <a href="index.php?controller=ImovelController&metodo=cadastrar&id=<?= $valores->id; ?>">
                            <i class="fa-solid fa-pen fnc-azul fonte10" title="Editar Registro"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach;
        else: ?>
            <tr class="sem-registro"><td colspan="9">
                <h6 class="txt-c fonte16 poppins-medium">Nenhum Registro encontrado!</h6>
            </td></tr>
        <?php endif; ?>
    </tbody>
    <tfoot>

    </tfoot>
</table>