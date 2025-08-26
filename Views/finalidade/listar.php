<div class="wd-100">

    <div class="box-8">
        <p class="txt-c fonte20 mg-b-1">
            <i class="fa-solid fa-key"></i>
            Finalidades para os Imóveis
        </p>
    </div>

    <div class="box-4 flex justify-center item-centro">
        <a href="index.php?controller=FinalidadeController&metodo=cadastrar" class="btn-novo">
            <i class="fa-solid fa-key"></i>
            <i class="fa-solid fa-plus"></i>
            Novo Tipo de Finalidade
        </a>
    </div>

</div>
<div class="limpar"></div>
<table class="grid wd-100">
    <thead>
        <tr>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Descrição</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($finalidade) && count($finalidade) > 0):
            foreach ($finalidade as $valores):
        ?>
                <tr>
                    <td class="fonte12 espaco-letra fw-300 txt-c"><?= $valores->descricao; ?></td>
                    <td class="fonte10 espaco-letra fw-300 txt-c">
                        <a href="index.php?controller=FinalidadeController&metodo=apagar&id=<?= $valores->id; ?>">
                            <i class="fa-solid fa-trash-can fnc-vermelho fonte14" title="Apagar Registro"></i>
                        </a>
                        <a href="index.php?controller=FinalidadeController&metodo=cadastrar&id=<?= $valores->id; ?>">
                            <i class="fa-solid fa-pen fnc-azul fonte14" title="Editar Registro"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach;
        else: ?>
            <td colspan="7">
                <h6 class="txt-c fonte16 poppins-medium">Nenhum Registro encontrado!</h6>
            </td>
        <?php endif; ?>
    </tbody>
    <tfoot>

    </tfoot>
</table>