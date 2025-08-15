<div class="box-8">
    <h2 class="fonte20">
        <i class="fa-solid fa-notes-medical"></i>
        <i class="fa-solid fa-user-tie"></i>
        Cadastrar Proprietários
    </h2>
</div>
<div class="limpar"></div>
<div class="divider mg-b-2 mg-t-2"></div>
<form action="" method="POST" class="box-12">

    <div class="row">
        <div class="box-3">
            <label>
                Nome
                <input type="text" name="nome" autofocus>
            </label>
        </div>
        <div class="box-3">
            <fieldset class="fonte14">
                <legend>Sexo</legend>
                <div class="radio-group">
                    <label class="fonte14">
                        <input type="radio" name="sexo" value="M">
                        Masculino
                    </label>
                    <label class="fonte14">
                        <input type="radio" name="sexo" value="F">
                        Feminino
                    </label>
                </div>
            </fieldset>
        </div>
        <div class="box-3">
            <label for="telefone">Fone</label>
            <input type="text" name="contato" id="telefone">
        </div>
        <div class="box-3">
            <label for="cep">CEP</label>
            <input type="text" name="cep" id="cep">
        </div>
    </div>
    <div class="row">
        <div class="box-3">
            <label for="logradouro">Rua</label>
            <input type="text" name="logradouro" id="rua">
        </div>
        <div class="box-1">
            <label for="numero">Numero</label>
            <input type="text" name="numero" id="numero">
        </div>
        <div class="box-3">
            <label for="bairro">Bairro</label>
            <input type="text" name="bairro" id="bairro">
        </div>
        <div class="box-3">
            <label for="cidade">Cidade</label>
            <input type="text" name="cidade" id="cidade">
        </div>
        <div class="box-2" style="background-color: transparent; color: #333;">
            <label for="estado">Estado</label>
            <input type="text" name="estado" id="estado">
        </div>
    </div>
    <div class="row">
        <div class="box-3">
            <fieldset class="fonte14">
                <legend>Ativo</legend>
                <div class="radio-group">
                    <label class="fonte14">
                        <input type="radio" name="ativo" value="1" checked>
                        Sim
                    </label>
                    <label class="fonte14">
                        <input type="radio" name="ativo" value="0">
                        Não
                    </label>
                </div>
            </fieldset>
        </div>
        <div class="box-3">
            <input type="submit" value="Cadastrar" class="btn bg-vermelho bg-vermelho-claro-hover fnc-branco mg-t-2">
        </div>
            <div class="box-3">
                <input name="id" type="hidden" value="0">
                <!-- <?php echo @$id ?> -->
            </div>
    </div>
</form>
<script src=""></script>