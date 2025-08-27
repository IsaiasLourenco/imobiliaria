<?php
require_once 'Views/shared/header.php';
?>
<section class="baner" id="home">
    <div class="mascara">
        <div class="container">
            <div class="box-12">
                <h2 class="fonte46 espaco-letra txt-c">A casa dos seus sonhos a um clique!</h2>
                <span class="block txt-c fonte22 fw-300">Oportunidade de casas online.</span>
                <a href="index.php?controller=UsuarioController&metodo=autenticar" class="btn bg-vermelho fnc-branco mg-auto mg-t-2 bg-vermelho-claro-hover">
                    Painel de Operação
                </a>
            </div>
        </div>
    </div>
</section>
<div class="limpar"></div>
<div class="divider mg-t-2"></div>
<!-- SEÇÃO DE COMPRAS -->
<section class="produtos" id="comprar">
    <div class="container">
        <div class="box-12">
            <h3 class="fonte22 fnc-preto-azulado fw-300 espaco-letra txt-c mg-t-2">Oportunidades para</h3>
            <h4 class="fonte46 fnc-preto-azulado espaco-letra txt-c mg-t-2">Compra</h4>
        </div>
        <div class="box-12 flex justify-start flex-wrap mg-t-2">
            <?php
            if (isset($imoveis) && count($imoveis) > 0):
                foreach ($imoveis as $dados):
                    if ($dados->finalidade == 1):
            ?>
                        <div class="box-4 shadow-down pd-b-2 mg-b-2">
                            <!-- IMAGEM DO IMÓVEL -->
                            <div class="box-12 imagemcapa">
                                <img src="lib/img/imagens/<?php echo $dados->imagemcapa; ?>" alt="Imagem do Imóvel">
                            </div>
                            <!-- ENDEREÇO DO IMÓVEL -->
                            <div class="box-12 endereco">
                                <p class=" txt-c fnc-vermelho-hover pd-l-2 mg-t-2 roboto-condensed fonte14 espaco-letra fw-bold fnc-preto-azulado">
                                    <?php echo $dados->logradouro ?>, <?php echo $dados->numero ?> <?php echo $dados->complemento ?> - <?php echo $dados->bairro ?> <br>
                                    <span><?php echo $dados->cidade ?> - <?php echo $dados->estado ?></span>
                                </p>
                            </div>
                            <!-- VALOR DO IMÓVEL -->
                            <div class="box-12">
                                <p class="fnc-azul-hover txt-c mg-t-2 roboto-condensed fonte16 fw-300 fnc-preto-azulado">
                                    <?php echo 'R$ ' . number_format($dados->valor, 2, ',', '.'); ?>
                                </p>
                                <div class="divider"></div>
                            </div>
                            <!-- DETALHES DO IMÓVEL -->
                            <div class="box-12 mg-t-2">
                                <div class="box-3 txt-c">
                                    <i class="fa-solid fa-bed fonte20 fnc-vermelho-hover" title="Cômodos"></i>
                                </div>
                                <div class="box-3 txt-c">
                                    <i class="fa-solid fa-shower fonte20 fnc-vermelho-hover" title="Banheiros"></i>
                                </div>
                                <div class="box-3 txt-c">
                                    <i class="fa-regular fa-square fonte20 fnc-vermelho-hover" title="Área Total"></i>
                                </div>
                                <div class="box-3 txt-c">
                                    <i class="fa-solid fa-square-check fonte20 fnc-vermelho-hover" title="Área Construída"></i>
                                </div>
                            </div>
                            <div class="box-12 mg-t-2">
                                <div class="box-3 txt-c"><?php echo str_pad($dados->quartos, 3, '0', STR_PAD_LEFT); ?></div>
                                <div class="box-3 txt-c"><?php echo str_pad($dados->banheiros, 3, '0', STR_PAD_LEFT); ?></div>
                                <div class="box-3 txt-c">
                                    <?php echo $dados->areatotal . ' m²'; ?>
                                </div>
                                <div class="box-3 txt-c">
                                    <?php echo $dados->areaconstruida . ' m²'; ?>
                                </div>
                            </div>
                        </div>
            <?php endif;
                endforeach;
            endif; ?>
        </div>
    </div>
</section>
<div class="limpar"></div>
<div class="divider mg-t-2"></div>
<!-- SEÇÃO DE LOCAÇÃO -->
<section class="produtos" id="alugar">
    <div class="container">
        <div class="box-12">
            <h3 class="fonte22 fnc-preto-azulado fw-300 espaco-letra txt-c mg-t-2">Oportunidades para</h3>
            <h4 class="fonte46 fnc-preto-azulado espaco-letra txt-c mg-t-2">Alugar</h4>
        </div>
        <div class="box-12 flex justify-start flex-wrap mg-t-2">
            <?php
            if (isset($imoveis) && count($imoveis) > 0):
                foreach ($imoveis as $dados):
                    if ($dados->finalidade == 2):
            ?>
                        <div class="box-4 shadow-down pd-b-2 mg-b-2">
                            <!-- IMAGEM DO IMÓVEL -->
                            <div class="box-12 imagemcapa">
                                <img src="lib/img/imagens/<?php echo $dados->imagemcapa; ?>" alt="Imagem do Imóvel">
                            </div>
                            <!-- ENDEREÇO DO IMÓVEL -->
                            <div class="box-12 endereco">
                                <p class=" txt-c fnc-vermelho-hover pd-l-2 mg-t-2 roboto-condensed fonte14 espaco-letra fw-bold fnc-preto-azulado">
                                    <?php echo $dados->logradouro ?>, <?php echo $dados->numero ?> <?php echo $dados->complemento ?> - <?php echo $dados->bairro ?> <br>
                                    <span><?php echo $dados->cidade ?> - <?php echo $dados->estado ?></span>
                                </p>
                            </div>
                            <!-- VALOR DO IMÓVEL -->
                            <div class="box-12">
                                <p class="fnc-azul-hover txt-c mg-t-2 roboto-condensed fonte16 fw-300 fnc-preto-azulado">
                                    <?php echo 'R$ ' . number_format($dados->valor, 2, ',', '.'); ?> por mês
                                </p>
                                <div class="divider"></div>
                            </div>
                            <!-- DETALHES DO IMÓVEL -->
                            <div class="box-12 mg-t-2">
                                <div class="box-3 txt-c">
                                    <i class="fa-solid fa-bed fonte20 fnc-vermelho-hover" title="Cômodos"></i>
                                </div>
                                <div class="box-3 txt-c">
                                    <i class="fa-solid fa-shower fonte20 fnc-vermelho-hover" title="Banheiros"></i>
                                </div>
                                <div class="box-3 txt-c">
                                    <i class="fa-regular fa-square fonte20 fnc-vermelho-hover" title="Área Total"></i>
                                </div>
                                <div class="box-3 txt-c">
                                    <i class="fa-solid fa-square-check fonte20 fnc-vermelho-hover" title="Área Construída"></i>
                                </div>
                            </div>
                            <div class="box-12 mg-t-2">
                                <div class="box-3 txt-c"><?php echo str_pad($dados->quartos, 3, '0', STR_PAD_LEFT); ?></div>
                                <div class="box-3 txt-c"><?php echo str_pad($dados->banheiros, 3, '0', STR_PAD_LEFT); ?></div>
                                <div class="box-3 txt-c">
                                    <?php echo $dados->areatotal . ' m²'; ?>
                                </div>
                                <div class="box-3 txt-c">
                                    <?php echo $dados->areaconstruida . ' m²'; ?>
                                </div>
                            </div>
                        </div>
            <?php endif;
                endforeach;
            endif; ?>
        </div>
    </div>
</section>
<div class="limpar"></div>
<div class="divider mg-t-2"></div>
<!-- DEPOIMENTOS -->
<section class="depoimentos mg-t-2" id="depoimentos">
    <div class="container">
        <h2 class="txt-c mg-b-2">DEPOIMENTOS</h2>
        <div class="box-12 bg-preto-azulado-claro flex justify-center item-centro pd-20">
            <div class="carrossel">
                <div class="slides">
                    <!-- SLIDE 1 -->
                    <div class="slide">
                        <p class="box-4 fonte16 fnc-branco txt-c">
                            Desde o primeiro contato, fiquei impressionado com a atenção e o profissionalismo da equipe.
                            Eles entenderam exatamente o que eu procurava e me acompanharam em cada etapa do processo, sempre tirando
                            minhas dúvidas e oferecendo as melhores opções. Graças a eles, encontrei o imóvel perfeito para minha
                            família, em uma localização incrível e com condições que superaram minhas expectativas. Recomendo de olhos
                            fechados!
                        </p>
                        <cite class="fonte22 fnc-vermelho fw-600 mg-t-2">Isaias Lourenço - Mogi Guaçu - SP</cite>
                    </div>
                    <!-- SLIDE 2 -->
                    <div class="slide">
                        <p class="box-4 fonte16 fnc-branco txt-c">
                            Fui muito bem atendida desde o primeiro contato. A equipe mostrou um cuidado genuíno em entender minhas
                            necessidades e apresentou opções que se encaixavam perfeitamente no meu orçamento e estilo de vida. Todo
                            o processo foi rápido, transparente e sem complicações. Hoje moro em um lugar que sempre sonhei e devo isso
                            ao trabalho excepcional dessa imobiliária.
                        </p>
                        <cite class="fonte22 fnc-vermelho fw-600 mg-t-2">Éviliny Lourenço - Mogi Mirim - SP</cite>
                    </div>
                    <!-- SLIDE 3 -->
                    <div class="slide">
                        <p class="box-4 fonte16 fnc-branco txt-c">
                            Nunca imaginei que encontrar o imóvel ideal pudesse ser tão tranquilo. Desde a primeira ligação até a entrega
                            das chaves, fui tratado com respeito e atenção. A equipe demonstrou conhecimento do mercado e conseguiu
                            negociar condições muito vantajosas. Recomendo fortemente para quem busca segurança e confiança na compra ou
                            aluguel de um imóvel.
                        </p>
                        <cite class="fonte22 fnc-vermelho fw-600 mg-t-2">Moacyr Cussolim - Mogi Guaçu - SP</cite>
                    </div>
                    <!-- SLIDE 4 -->
                    <div class="slide">
                        <p class="box-4 fonte16 fnc-branco txt-c">
                            A experiência foi incrível! Eu já havia visitado outras imobiliárias, mas nenhuma me ofereceu tanta atenção
                            e suporte como esta. Tiraram todas as minhas dúvidas, mostraram opções variadas e me ajudaram a fechar negócio
                            com total segurança. Sem dúvida, quando eu ou alguém da minha família precisar novamente, sei exatamente a quem
                            recorrer.
                        </p>
                        <cite class="fonte22 fnc-vermelho fw-600 mg-t-2">João da Silva - Itapira - SP</cite>
                    </div>
                </div>
                <button title="Anterior" class="prev">←</button>
                <button title="Próximo" class="next">→</button>
            </div>
        </div>
    </div>
</section>
<div class="limpar"></div>
<section class="paralax">
    <div class="container">
        <div class="box-12 hg-20 pd-20 bg-preto-azulado-claro"></div>
    </div>
</section>
<div class="limpar"></div>
<div class="divider mg-t-2"></div>
<!-- SEÇÃO DE CONTATO -->
<section class="contato bg-gradiente-azul-roxo" id="contato">
    <div class="container">
        <div class="box-12">
            <h3 class="fonte22 fnc-preto-azulado fw-bold espaco-letra txt-c mg-t-2 mg-b-2">
                Conte com nosso time para comprar seu sonho!
            </h3>
        </div>
        <div class="box-12 justify-center item-centro">
            <div class="box-4 txt-c">
                <i class="fa-brands fa-square-whatsapp fonte20"></i>
                <span class="fonte20 espaco-letra fnc-preto-azulado fw-bold">Whatsapp</span>
                <p class="fonte12 espaco-letra">
                    <a href="https://wa.me/5519996745466?text=Contato%20referente%20a%20um%20im%C3%B3vel%20para%20negocia%C3%A7%C3%A3o."
                        target="_blank"
                        title="Clique para nos mandar um Whastsapp"
                        rel="noopener noreferrer">
                        (19) 99674-5466
                    </a>
                </p>
            </div>
            <div class="box-4 txt-c">
                <i class="fa-solid fa-map-location-dot fonte20"></i>
                <span class="fonte20 espaco-letra fnc-preto-azulado fw-bold">Localização</span>
                <p class="fonte12 espaco-letra mg-b-2">
                    <a href="https://www.google.com/maps?q=Rua+Mococa,+880+-+Jardim+Itacolomi,+Mogi+Guaçu+-+SP"
                        target="_blank"
                        title="Clique aqui para nos localizar no mapa."
                        rel="noopener noreferrer">
                        Rua Mococa, 880 - Jardim Itacolomi <br> Mogi Guaçu - SP
                    </a>
                </p>
            </div>
            <div class="box-4 txt-c">
                <i class="fa-solid fa-at fonte20"></i>
                <span class="fonte20 espaco-letra fnc-preto-azulado fw-bold">E-mail</span>
                <p class="fonte12 espaco-letra">Contate-nos via e-mail <br> isaias@vetor256.com</p>
            </div>
        </div>
    </div>
</section>
<div class="limpar mg-t-2"></div>
<!-- ENVIO -->
<section class="contato-form bg-preto-azulado-claro ">
    <div class="container">
        <div class="box-6">
            <div class="box-6">
                <h3 class="fonte22 fnc-branco espaco-letra txt-c mg-t-2">Fale conosco!</h3>
                <p class="fonte20 fw-300 fnc-branco mg-t-2 mg-b-2">
                    Estamos prontos para ajudar você a encontrar o imóvel dos seus sonhos! Não perca tempo, envie sua mensagem agora mesmo
                    e dê o primeiro passo rumo à sua nova casa.
                </p>
            </div>
        </div>
        <!-- FORMULÁRIO PARA ENVIO -->
        <div class="box-6">
            <h3 class="fonte22 fnc-branco espaco-letra txt-c mg-t-2 mg-b-2">Entre em contato!</h3>
            <form method="POST">
                <div class="box-12 mg-b-2">
                    <label class="fnc-branco" for="nome">Nome</label>
                    <input tabindex="1" type="text" name="nome" id="nome" required>
                </div>
                <div class="box-12 mg-b-2">
                    <label class="fnc-branco" for="email">E-mail</label>
                    <input tabindex="2" type="email" name="email" id="email" required>
                </div>
                <div class="box-12 mg-b-2">
                    <label class="fnc-branco" for="telefone">Telefone</label>
                    <input tabindex="3" type="text" name="telefone" id="telefone" required>
                </div>
                <div class="box-12 flex mg-b-2">
                    <div class="box-3 flex justify-start">
                        <label class="fnc-branco" for="motivo">Motivo</label>
                    </div>
                    <div class="box-4 flex" style="align-items: center;">
                        <span class="fnc-branco">Comprar</span><input type="radio" name="motivo" value="Comprar">
                    </div>
                    <div class="box-4 flex" style="align-items: center;">
                        <span class="fnc-branco">Alugar</span><input type="radio" name="motivo" value="Alugar">
                    </div>
                </div>
                <div class="box-12 mg-b-2">
                    <label class="fnc-branco" for="mensagem">Mensagem</label>
                    <textarea name="mensagem" id="mensagem" rows="5" placeholder="Digite sua mensagem aqui..."></textarea>
                </div>
                <div class="box-12 mg-b-2">
                    <input type="submit" class="btn bg-vermelho bg-vermelho-claro-hover fnc-branco mg-b-2">
                </div>
            </form>
        </div>
    </div>
</section>
<?php
require_once 'Views/shared/footer.php';
?>