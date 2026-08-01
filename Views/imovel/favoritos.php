<link rel="stylesheet" href="lib/css/publico.css">

<div class="conteudo box-12">
    <h2 class="txt-c fonte24 mg-t-1 mg-b-2">Meus Imóveis Favoritos</h2>

    <div id="favoritos-container" class="box-12"></div>

    <!-- Botão Voltar para Home -->
    <div class="txt-c mg-t-3 mg-b-2">
        <a href="index.php" class="btn bg-vermelho fnc-branco" style="width: auto; display: inline-flex; padding: 0 2rem;">
            <i class="fa-solid fa-house mg-r-1"></i> Voltar para Home
        </a>
    </div>
</div>

<script>
    const favoritos = JSON.parse(localStorage.getItem('favoritos')) || [];
    const container = document.getElementById('favoritos-container');

    if (favoritos.length === 0) {
        container.innerHTML = "<p class='txt-c fonte16 mg-t-2'>Você ainda não favoritou nenhum imóvel.</p>";
    } else {
        favoritos.forEach(id => {
            fetch(`index.php?controller=ImovelController&metodo=apiBuscar&id=${id}`)
                .then(res => res.json())
                .then(imovel => {
                    const html = `
                    <div class="card-imovel mg-t-2 pd-5">
                        <h3>${imovel.codigo}</h3>
                        <p>${imovel.logradouro}, ${imovel.numero} - ${imovel.cidade}</p>
                        <p>Valor: R$ ${parseFloat(imovel.valor).toLocaleString('pt-BR', {minimumFractionDigits: 2})}</p>
                        <div class="flex justify-start item-centro mg-t-1" style="gap: 1rem;">
                            <div class="butijao">
                                <a href="index.php?controller=ImovelController&metodo=detalhespublico&id=${imovel.id}"
                                    class="btn-detalhes">
                                        <i class="fa-solid fa-circle-info"></i>
                                        Detalhes
                                </a>
                            </div>
                            <div class="butijao">
                                <button class="btn-remover" onclick="removerFavorito(${imovel.id})">
                                    <i class="fa-solid fa-square-minus"></i>
                                    Remover
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                    container.innerHTML += html;
                })
                .catch(err => console.error('Erro ao buscar imóvel:', err));
        });
    }

    function removerFavorito(id) {
        let favoritos = JSON.parse(localStorage.getItem('favoritos')) || [];
        favoritos = favoritos.filter(fav => fav !== id);
        localStorage.setItem('favoritos', JSON.stringify(favoritos));
        location.reload();
    }
</script>
