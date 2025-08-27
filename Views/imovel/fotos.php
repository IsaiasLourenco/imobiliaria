<?php if (!$fotos || count($fotos) === 0): ?>
    <p style="margin-left: 20px; margin-bottom: 20px;">Nenhuma foto disponível para este imóvel.</p>
<?php else: ?>
    <link rel="stylesheet" href="lib/css/galeria.css">

    <h2 class="galeria-titulo txt-c">
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
                <div class="thumb-wrapper">
                    <form class="form-excluir" method="POST" action="index.php?controller=ImovelController&metodo=excluirImagem">
                        <input type="hidden" name="imagemId" value="<?= (int)$foto->id ?>">
                        <input type="hidden" name="imovelId" value="<?= (int)$imovel->id ?>">
                        <button type="submit" class="btn-excluir" title="Excluir imagem">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>

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
<?php endif; ?>

<?php if (isset($imovel) && !empty($imovel->id)): ?>
    <form action="index.php?controller=ImovelController&metodo=adicionarImagemGaleria"
        method="POST" enctype="multipart/form-data"
        class="box-12"
        style="display: flex; flex-direction: column; align-items: center; gap: 1rem;">

        <label for="imagem_galeria" class="fonte14 fnc-preto-azulado" style="cursor: pointer;">
            <i class="fa-solid fa-images fonte20"></i>
            Adicionar imagens à galeria
        </label>

        <input type="file" name="imagem_galeria[]" id="imagem_galeria" accept="image/*" multiple>

        <button type="submit" class="btn bg-azul bg-azul-claro-hover fnc-branco mg-t-2">
            <i class="fas fa-plus"></i>
            Adicionar imagens
        </button>

        <a href="index.php?controller=ImovelController&metodo=detalhes&id=<?= $imovel->id ?>"
            class="btn bg-vermelho bg-vermelho-claro-hover fnc-branco mg-t-2"
            style="border: 2px solid black;">
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