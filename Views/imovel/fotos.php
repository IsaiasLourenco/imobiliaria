<?php if (!$fotos || count($fotos) === 0): ?>
    <p>Nenhuma foto disponível para este imóvel.</p>
<?php else: ?>
    <!-- CSS específico da galeria -->
    <link rel="stylesheet" href="lib/css/galeria.css">

    <h2 class="galeria-titulo">
        Galeria de Fotos do Imóvel
        <?= str_pad((string)$imovel->id, 3, "0", STR_PAD_LEFT) ?>
        (<?= htmlspecialchars($imovel->codigo) ?>)
    </h2>

    <div class="galeria-wrapper">
        <div class="galeria" id="galeria" data-basepath="lib/img/imagens/">
            <?php foreach ($fotos as $idx => $foto):
                $src = 'lib/img/imagens/' . $foto->imagem;
                $alt = 'Foto ' . ($idx + 1) . ' do imóvel ' . htmlspecialchars((string)$imovel->codigo);
            ?>
                <button class="thumb" data-index="<?= (int)$idx ?>" aria-label="Abrir <?= htmlspecialchars($alt) ?>">
                    <img
                        src="<?= htmlspecialchars($src) ?>"
                        alt="<?= htmlspecialchars($alt) ?>"
                        loading="lazy"
                        onerror="this.onerror=null;this.src='lib/img/upload/casa-padrao.png';">
                </button>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Lightbox / Modal -->
    <div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-labelledby="lb-caption" hidden>
        <button class="lb-close" id="lb-close" aria-label="Fechar (Esc)">&times;</button>
        <button class="lb-prev" id="lb-prev" aria-label="Imagem anterior">&#10094;</button>

        <figure class="lb-figure">
            <img id="lb-img" src="" alt="">
            <figcaption id="lb-caption"></figcaption>
        </figure>

        <button class="lb-next" id="lb-next" aria-label="Próxima imagem">&#10095;</button>
    </div>

    <!-- JS específico da galeria -->
    <script defer src="lib/js/galeria.js"></script>
<?php endif; ?>