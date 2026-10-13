<div class="wd-100">

    <div class="box-8">
        <p class="txt-c fonte20 mg-b-1">
            <i class="fa-solid fa-users"></i>
            Proprietários
        </p>
    </div>

    <div class="box-4 flex justify-center item-centro">
        <a href="index.php?controller=ProprietarioController&metodo=cadastrar" class="btn-novo">
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
                    <td data-label="Nome" class="cel-x fonte12 espaco-letra fw-300 txt-c"><?= $valores->nome; ?></td>
                    <td data-label="Contato" class="cel-x fonte12 espaco-letra fw-300 txt-c"><?= $valores->contato; ?></td>
                    <td data-label="Ativo" class="cel-ativo fonte12 espaco-letra fw-300 txt-c">
                        <?php if ($valores->ativo == '1'): ?>
                            <span class="ativo" data-id="<?= $valores->id; ?>" data-status="0">
                                <i class="fa-solid fa-lock-open fnc-sucesso fonte14" title="Ativo"></i>
                            </span>
                        <?php else: ?>
                            <span class="ativo" data-id="<?= $valores->id; ?>" data-status="1">
                                <i class="fa-solid fa-lock fnc-error fonte14" title="Desativado"></i>
                            </span>
                        <?php endif; ?>
                    </td>
                    <td data-label="Ações" class="cel-acoes fonte10 espaco-letra fw-300 txt-c">
                        <a href="index.php?controller=ProprietarioController&metodo=apagar&id=<?= $valores->id; ?>">
                            <i class="fa-solid fa-trash-can fnc-vermelho fonte14" title="Apagar Registro"></i>
                        </a>
                        <a href="index.php?controller=ProprietarioController&metodo=cadastrar&id=<?= $valores->id; ?>">
                            <i class="fa-solid fa-pen fnc-azul fonte14" title="Editar Registro"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach;
        else: ?>
            <tr class="sem-registro"><td colspan="7">
                <h6 class="txt-c fonte16 poppins-medium">Nenhum Registro encontrado!</h6>
            </td></tr>
        <?php endif; ?>
    </tbody>
    <tfoot>

    </tfoot>
</table>