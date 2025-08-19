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
$imovelArray = $imovelDao->buscarImovelPorId($id);

if (!$imovelArray || !isset($imovelArray[0])) {
    echo "<p>Imóvel não encontrado.</p>";
    return;
}

$imovel = $imovelArray[0];

// Busca o proprietário
$proprietarioDao = new ProprietarioDao();
$proprietarioArray = $proprietarioDao->buscarProprietarioPorId($imovel->proprietario);
$proprietario = $proprietarioArray[0];
?>
<div class="limpar"></div>
<div class="box-12">
    <!-- Intro -->
    <section class="intro">
        <h1><?= htmlspecialchars($imovel->codigo) ?></h1>
        <p class="preco">R$ <?= number_format((float)$imovel->valor, 2, ',', '.') ?></p>
        
    </section>

    <div class="row">
        <!-- Proprietário -->
        <div class="box-6">
            <section class="detalhes-bloco">
                <h2>Proprietário</h2>
                <p><strong>Nome:</strong> <?= htmlspecialchars($proprietario->nome ?? '') ?></p>
                <p><strong>Telefone:</strong> <?= htmlspecialchars($proprietario->contato ?? '') ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($proprietario->email ?? '') ?></p>
            </section>
        </div>

        <!-- Localização -->
        <div class="box-6">
            <section class="detalhes-bloco">
                <h2>Localização</h2>
                <p><strong>CEP:</strong> <?= htmlspecialchars($imovel->cep ?? '') ?></p>
                <p><strong>Logradouro:</strong> <?= htmlspecialchars($imovel->logradouro ?? '') ?></p>
                <p><strong>Número:</strong> <?= htmlspecialchars($imovel->numero ?? '') ?></p>
                <p><strong>Complemento:</strong> <?= htmlspecialchars($imovel->complemento ?? '') ?></p>
                <p><strong>Bairro:</strong> <?= htmlspecialchars($imovel->bairro ?? '') ?></p>
                <p><strong>Cidade:</strong> <?= htmlspecialchars($imovel->cidade ?? '') ?></p>
                <p><strong>Estado:</strong> <?= htmlspecialchars($imovel->estado ?? '') ?></p>
            </section>
        </div>
    </div>

    <div class="row">
        <!-- Características -->
        <div class="box-12">
            <section class="detalhes-bloco">
                <h2>Características do Imóvel</h2>
                <ul>
                    <li><strong>Quartos:</strong> <?= htmlspecialchars((string)$imovel->quartos) ?></li>
                    <li><strong>Banheiros:</strong> <?= htmlspecialchars((string)$imovel->banheiros) ?></li>
                    <li><strong>Garagem:</strong> <?= htmlspecialchars((string)$imovel->garagem) ?></li>
                    <li><strong>Área Total:</strong> <?= htmlspecialchars((string)$imovel->areatotal) ?> m²</li>
                    <li><strong>Área Construída:</strong> <?= htmlspecialchars((string)$imovel->areaconstruida) ?> m²</li>
                </ul>
            </section>
        </div>
    </div>

    <!-- Ações -->
    <div class="acoes">
        <a href="index.php?controller=ImovelController&metodo=fotos&id=<?= (int)$imovel->id ?>" class="btn-ver-fotos">📸 Ver galeria de fotos</a>
        <button class="btn-favoritar">❤️ Favoritar</button>
        <button class="btn-compartilhar">🔗 Compartilhar</button>
    </div>
</div>