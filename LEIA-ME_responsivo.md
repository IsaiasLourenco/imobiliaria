# Responsivo do painel — o que mudou

Apague os CSS antigos (não são mais usados): lib/css/aurora.css, site.css, detalhes.css, login.css, galeria.css, publico.css

Novo: lib/css/{base,layout,componentes,paginas,responsivo}/, lib/js/menuPainel.js, Views/shared/css.php
Alterados: Views/shared/header.php, header-login.php, painel/index.php, listar.php (5), imovel/cadastrar.php (tag <img> sem fechar), autenticar.php, fotos.php, fotospublico.php, detalhespublico.php, favoritos.php

Breakpoints: 1024px menu vira gaveta (hambúrguer) | 768px tabelas viram cards, formulários em coluna | 480px ajuste fino.
Desktop sem @media; tudo de tela pequena fica em lib/css/responsivo/.
Ordem dos <link> em Views/shared/css.php importa (igual ao CSS original).
