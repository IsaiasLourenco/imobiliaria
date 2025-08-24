<?php
require_once 'vendor/autoload.php';

use App\Models\Dao\ImovelDao;
use App\Models\Dao\ProprietarioDao;

// Valida o ID vindo da URL
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    echo "<p>ID do imóvel não informado ou inválido.</p>";
    return;
}

// Busca o imóvel
$imovelDao = new ImovelDao();
$imovel = $imovelDao->buscarUnicoImovelPorId($id);
if (!$imovel) {
    echo "<p>Imóvel não encontrado.</p>";
    return;
}

// Busca o proprietário
$proprietarioDao = new ProprietarioDao();
$proprietario = $proprietarioDao->buscarProprietarioPorId($imovel->proprietario);

if (!$proprietario) {
    echo "<p>Proprietário não encontrado.</p>";
    return;
}
?>

<div class="limpar"></div>
<div class="box-12">

    <!-- Código e valor -->
    <section class="intro" style="text-align:center; margin-bottom:20px;">
        <h1><?= htmlspecialchars($imovel->codigo) ?></h1>
        <p class="preco">R$ <?= number_format((float)$imovel->valor, 2, ',', '.') ?></p>
    </section>

    <div class="detalhes-topo">
        <!-- Proprietário -->
        <section class="detalhes-bloco proprietario">
            <h2>Proprietário</h2>
            <p><strong>Nome:</strong> <?= htmlspecialchars($proprietario->nome ?? 'Não informado') ?></p>
            <p><strong>Telefone:</strong> <?= htmlspecialchars($proprietario->contato ?? 'Não informado') ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($proprietario->email ?? 'Não informado') ?></p>
        </section>

        <!-- Imagem de capa -->
        <div class="imagem-capa">
            <img src="lib/img/imagens/<?= htmlspecialchars($imovel->imagemcapa ?? 'sem-foto.jpg') ?>"
                alt="Imagem do Imóvel" class="capa">
        </div>

        <!-- Características do Imóvel -->
        <section class="detalhes-bloco caracteristicas">
            <h2>Características do Imóvel</h2>
            <div class="finalidade-info" style="margin-top: 10px; margin-bottom: 10px; ">
                <p class="titulo-fin-tipo"><strong>Finalidade:</strong> <?= htmlspecialchars($imovel->getFinalidadeDescricao() ?? 'Não informado') ?></p>
            </div>
            <div class="finalidade-info" style="margin-top: 10px; margin-bottom: 10px; ">
                <p class="titulo-fin-tipo"><strong>Tipo:</strong> <?= htmlspecialchars($imovel->getFinalidadeDescricao() ?? 'Não informado') ?></p>
            </div>
            <ul>
                <li><strong>Quartos:</strong> <?= str_pad((string)$imovel->quartos, 2, '0', STR_PAD_LEFT) ?></li>
                <li><strong>Banheiros:</strong> <?= str_pad((string)$imovel->banheiros, 2, '0', STR_PAD_LEFT) ?></li>
                <li><strong>Garagem:</strong> <?= str_pad((string)$imovel->garagem, 2, '0', STR_PAD_LEFT) ?></li>
                <li><strong>Área Total:</strong> <?= htmlspecialchars((string)$imovel->areatotal) ?> m²</li>
                <li><strong>Área Construída:</strong> <?= htmlspecialchars((string)$imovel->areaconstruida) ?> m²</li>
            </ul>
        </section>
    </div>

    <!-- Localização -->
    <section class="detalhes-bloco localizacao">
        <h2>Localização</h2>
        <p><strong>CEP:</strong> <?= htmlspecialchars($imovel->cep ?? '') ?></p>
        <p><strong>Logradouro:</strong> <?= htmlspecialchars($imovel->logradouro ?? '') ?></p>
        <p><strong>Número:</strong> <?= htmlspecialchars($imovel->numero ?? '') ?></p>
        <p><strong>Complemento:</strong> <?= htmlspecialchars($imovel->complemento ?? '') ?></p>
        <p><strong>Bairro:</strong> <?= htmlspecialchars($imovel->bairro ?? '') ?></p>
        <p><strong>Cidade:</strong> <?= htmlspecialchars($imovel->cidade ?? '') ?></p>
        <p><strong>Estado:</strong> <?= htmlspecialchars($imovel->estado ?? '') ?></p>
    </section>

    <!-- Ações -->
    <div class="acoes">
        <a href="index.php?controller=ImovelController&metodo=listar" class="btn-listar-todos">✅ Listar todos os imóveis</a>
        <a href="index.php?controller=ImovelController&metodo=fotos&id=<?= (int)$imovel->id ?>" class="btn-ver-fotos">📸 Ver galeria de fotos</a>
        <button class="btn-favoritar">❤️ Favoritar</button>
        <button class="btn-compartilhar">🔗 Compartilhar</button>
    </div>
</div>