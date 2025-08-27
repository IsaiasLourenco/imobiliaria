<link rel="stylesheet" href="lib/css/publico.css">
<div class="conteudo">
    <?php if (!$fotos || count($fotos) === 0): ?>
        <p style="margin-left: 20px; margin-bottom: 20px;">Nenhuma foto disponível para este imóvel.</p>
    <?php else: ?>
        <link rel="stylesheet" href="lib/css/galeria.css">

        <div class="mg-t-4">
            <h2 class="galeria-titulo-publico txt-c">
                Galeria de Fotos do Imóvel
                <?= str_pad((string)$imovel->id, 3, "0", STR_PAD_LEFT) ?>
                (<?= htmlspecialchars($imovel->codigo) ?>)
            </h2>

            <div class="galeria-wrapper-publico">
                <div class="galeria" id="galeria" data-basepath="lib/img/imagens/">
                    <?php foreach ($fotos as $idx => $foto):
                        $src = 'lib/img/imagens/' . $foto->imagem;
                        $alt = 'Foto ' . ($idx + 1) . ' do imóvel ' . htmlspecialchars((string)$imovel->codigo);
                    ?>
                        <div class="thumb-wrapper">
                            <button class="thumb" data-index="<?= (int)$idx ?>" aria-label="Abrir <?= htmlspecialchars($alt) ?>">
                                <img
                                    src="<?= htmlspecialchars($src) ?>"
                                    alt="<?= htmlspecialchars($alt) ?>"
                                    loading="lazy"
                                    onerror="this.onerror=null;this.src='lib/img/upload/casa-padrao.png';">
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($imovel) && !empty($imovel->id)): ?>
        <form action="index.php?controller=ImovelController&metodo=adicionarImagemGaleria"
            method="POST" enctype="multipart/form-data"
            class="box-12"
            style="display: flex; flex-direction: column; align-items: center; gap: 1rem;">

            <a href="index.php?controller=ImovelController&metodo=detalhespublico&id=<?= $imovel->id ?>"
                class="btn bg-vermelho bg-vermelho-claro-hover fnc-branco mg-t-2"
                style="border: 2px solid black; margin-bottom: 210px;">
                <i class="fa-solid fa-backward"></i>
                Voltar para detalhes
            </a>

            <input type="hidden" name="id" value="<?= (int)$imovel->id ?>">
        </form>

    <?php endif; ?>

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

    <script defer src="lib/js/galeria.js"></script>
</div>