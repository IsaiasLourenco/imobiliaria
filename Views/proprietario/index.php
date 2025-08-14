<div class="wd-100">

    <div class="box-8">
        <p class="txt-c fonte20 mg-b-1">
            <i class="fa-solid fa-user-tie"></i>
            Proprietários
        </p>
    </div>

    <div class="box-4 flex justify-center item-centro">
        <button class="btn-novo-proprietario">
            <i class="fa-solid fa-user-plus"></i>
            Novo Proprietário
        </button>
    </div>

</div>
<div class="limpar"></div>
<table class="grid wd-100">
    <thead>
        <tr>
            <th class="fonte14 espaco-letra fw-bold bg-azul-escuro fnc-branco">Nome</th>
            <th class="fonte14 espaco-letra fw-bold bg-azul-escuro fnc-branco">Contato</th>
            <th class="fonte14 espaco-letra fw-bold bg-azul-escuro fnc-branco">Ativo</th>
            <th class="fonte14 espaco-letra fw-bold bg-azul-escuro fnc-branco   ">Ações</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="fonte10 espaco-letra fw-300 txt-c">Isaias Lourenço</td>
            <td class="fonte10 espaco-letra fw-300 txt-c">(19)99674-5466</td>
            <td class="fonte10 espaco-letra fw-300 txt-c">
                <?php if (1 == 2): ?>
                    <i class="fa-solid fa-lock fnc-error fonte14" title="Desativado"></i>
                <?php endif; ?>
                <i class="fa-solid fa-lock-open fnc-sucesso fonte14" title="Ativo"></i>
            </td>
            <td class="fonte10 espaco-letra fw-300 txt-c">
                <a href=""><i class="fa-solid fa-trash-can fnc-vermelho fonte14" title="Apagar Registro"></i></a>
                <a href=""><i class="fa-solid fa-pen fnc-azul fonte14" title="Editar Registro"></i></a>
            </td>
        </tr>
        <tr class="zebra">
            <td class="fonte10 espaco-letra fw-300 txt-c">João Custódio</td>
            <td class="fonte10 espaco-letra fw-300 txt-c">(19)990799-0265</td>
            <td class="fonte10 espaco-letra fw-300 txt-c">
                <?php if (1 == 2): ?>
                    <i class="fa-solid fa-lock fnc-error fonte14" title="Desativado"></i>
                <?php endif; ?>
                <i class="fa-solid fa-lock-open fnc-sucesso fonte14" title="Ativo"></i>
            </td>
            <td class="fonte10 espaco-letra fw-300 txt-c">
                <a href=""><i class="fa-solid fa-trash-can fnc-vermelho fonte14" title="Apagar Registro"></i></a>
                <a href=""><i class="fa-solid fa-pen fnc-azul fonte14" title="Editar Registro"></i></a>
            </td>
        </tr>
    </tbody>
    <tfoot>

    </tfoot>
</table>