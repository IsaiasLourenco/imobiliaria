<div class="wd-100">

    <div class="box-8">
        <p class="txt-c fonte20 mg-b-1">
            <i class="fa-solid fa-keyboard"></i>
            Usuários
        </p>
    </div>

    <div class="box-4 flex justify-center item-centro">
        <a href="index.php?controller=UsuarioController&metodo=cadastrar" class="btn-novo">
            <i class="fa-solid fa-user-plus"></i>
            Novo Usuário
        </a>
    </div>

</div>
<div class="limpar"></div>
<table class="grid wd-100">
    <thead>
        <tr>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Data Cadastro</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Nome</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Usuário</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Email</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Telefone</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Perfil</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Ativo</th>
            <th class="fonte16 espaco-letra fw-bold bg-azul-escuro fnc-branco">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($usuario) && count($usuario) > 0):
            foreach ($usuario as $valores):
        ?>
                <tr>
                    <td class="fonte10 espaco-letra fw-300 txt-c">
                        <?= date('d/m/Y H:i:s', strtotime($valores->DATACADASTRO)); ?>
                    </td>
                    <td class="fonte10 espaco-letra fw-300 txt-c"><?= $valores->NOME; ?></td>
                    <td class="fonte10 espaco-letra fw-300 txt-c"><?= $valores->USUARIO; ?></td>
                    <td class="fonte10 espaco-letra fw-300 txt-c"><?= $valores->EMAIL; ?></td>
                    <td class="fonte10 espaco-letra fw-300 txt-c"><?= $valores->TELEFONE; ?></td>
                    <td class="fonte10 espaco-letra fw-300 txt-c"><?= $valores->NOME_PERFIL ?? '—'; ?></td>
                    <td class="fonte10 espaco-letra fw-300 txt-c">
                        <?php if ($valores->ATIVO == '1'): ?>
                            <span class="ativo" data-id="<?= $valores->ID; ?>" data-status="0">
                                <i class="fa-solid fa-lock-open fnc-sucesso fonte14" title="Ativo"></i>
                            </span>
                        <?php else: ?>
                            <span class="ativo" data-id="<?= $valores->ID; ?>" data-status="1">
                                <i class="fa-solid fa-lock fnc-error fonte14" title="Desativado"></i>
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="fonte10 espaco-letra fw-300 txt-c">
                        <a href="index.php?controller=UsuarioController&metodo=apagar&id=<?= $valores->ID; ?>">
                            <i class="fa-solid fa-trash-can fnc-vermelho fonte14" title="Apagar Registro"></i>
                        </a>
                        <a href="index.php?controller=UsuarioController&metodo=cadastrar&id=<?= $valores->ID; ?>">
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