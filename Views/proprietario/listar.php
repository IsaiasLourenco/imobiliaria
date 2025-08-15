<div class="wd-100">

    <div class="box-8">
        <p class="txt-c fonte20 mg-b-1">
            <i class="fa-solid fa-user-tie"></i>
            Proprietários
        </p>
    </div>

    <div class="box-4 flex justify-center item-centro">
        <a href="index.php?controller=ProprietarioController&metodo=cadastrar" class="btn-novo-proprietario">
            <i class="fa-solid fa-user-plus"></i>
            Novo Proprietário
        </a>
    </div>

</div>
<div class="limpar"></div>
<table class="grid wd-100">
    <thead>
        <tr>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Nome</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Contato</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Ativo</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($proprietario) && count($proprietario) > 0):
            foreach ($proprietario as $valores):
        ?>
                <tr>
                    <td class="fonte12 espaco-letra fw-300 txt-c"><?= $valores->NOME; ?></td>
                    <td class="fonte12 espaco-letra fw-300 txt-c"><?= $valores->CONTATO; ?></td>
                    <td class="fonte12 espaco-letra fw-300 txt-c">
                        <?php if ($valores->ATIVO == '1'): ?>
                            <i class="fa-solid fa-lock-open fnc-sucesso fonte14" title="Ativo"></i>
                        <?php else: ?>
                            <i class="fa-solid fa-lock fnc-error fonte14" title="Desativado"></i>
                        <?php endif; ?>
                    </td>
                    <td class="fonte10 espaco-letra fw-300 txt-c">
                        <a href="">
                            <i class="fa-solid fa-trash-can fnc-vermelho fonte14" title="Apagar Registro"></i>
                        </a>
                        <a href="index.php?controller=ProprietarioController&metodo=cadastrar&id=<?= $valores->ID; ?>">
                            <i class="fa-solid fa-pen fnc-azul fonte14" title="Editar Registro"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach;
        else: ?>
            <h6>Nenhum Registro encontrado!</h6>
        <?php endif; ?>
    </tbody>
    <tfoot>

    </tfoot>
</table>