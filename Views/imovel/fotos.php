<?php if (!$fotos || count($fotos) === 0): ?>
    <p>Nenhuma foto disponível para este imóvel.</p>
<?php else: ?>
    <h2>Galeria de Fotos do Imóvel #<?= htmlspecialchars($imovel->id) ?></h2>
    <div class="galeria">
        <?php foreach ($fotos as $foto): ?>
            <div class="foto-item">
                <img src="<?= htmlspecialchars($foto->imagem) ?>" alt="Foto do imóvel">
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>