<?php

namespace App\Services;

use App\Models\Dao\ImovelDao;
use App\Models\Imovel;

class ImovelService
{
    private $imovelDao;
    private $tipoImovelDao;
    private $fileUploadService; // opcional

    public function __construct(ImovelDao $imovelDao, $fileUploadService = null)
    {
        $this->imovelDao = $imovelDao;
        $this->tipoImovelDao = new \App\Models\Dao\TipoImovelDao();
        $this->fileUploadService = $fileUploadService;
    }

    public function normalizarEntrada($post, $files, $modo = 'inserir')
    {
        $dados = [];

        $dados['id']              = isset($post['id']) ? (int)$post['id'] : null;
        $dados['codigo']          = isset($post['codigo_imovel']) ? trim($post['codigo_imovel']) : '';
        $dados['valor']           = isset($post['valor']) ? $this->normalizarValor($post['valor']) : 0;

        $dados['cep']             = isset($post['cep']) ? trim($post['cep']) : '';
        $dados['logradouro']      = isset($post['logradouro']) ? trim($post['logradouro']) : '';
        $dados['numero']          = isset($post['numero']) ? trim($post['numero']) : '';
        $dados['complemento']     = isset($post['complemento']) ? trim($post['complemento']) : '';
        $dados['bairro']          = isset($post['bairro']) ? trim($post['bairro']) : '';
        $dados['cidade']          = isset($post['cidade']) ? trim($post['cidade']) : '';
        $dados['estado']          = isset($post['estado']) ? trim($post['estado']) : '';

        $dados['quartos']         = isset($post['quartos']) ? (int)preg_replace('/\D+/', '', $post['quartos']) : 0;
        $dados['banheiros']       = isset($post['banheiros']) ? (int)preg_replace('/\D+/', '', $post['banheiros']) : 0;
        $dados['garagem']         = isset($post['garagem']) ? (int)preg_replace('/\D+/', '', $post['garagem']) : 0;

        $dados['areatotal']       = isset($post['areatotal']) ? $this->normalizarNumero($post['areatotal']) : 0;
        $dados['areaconstruida']  = isset($post['areaconstruida']) ? $this->normalizarNumero($post['areaconstruida']) : 0;

        $dados['statusimovel']    = isset($post['status']) ? (int)$post['status'] : null;
        $dados['tipoimovel']      = isset($post['tipo']) ? (int)$post['tipo'] : null;
        $dados['finalidade']      = isset($post['finalidade']) ? (int)$post['finalidade'] : null;
        $dados['proprietario']    = isset($post['proprietario']) ? (int)$post['proprietario'] : null;
        $dados['datacadastro']    = date('Y-m-d');
        // Compatibilidade
        $dados['proprietarioimovel'] = $dados['proprietario'];
        $dados['finalidadeimovel']   = $dados['finalidade'];

        // Capa
        $dados['imagemcapa'] = 'sem-foto.jpg';

        if ($modo === 'editar' && !empty($dados['id'])) {
            $atual = $this->imovelDao->buscarUnicoImovelPorId($dados['id']);
            if ($atual) {
                $registro = is_array($atual) ? (isset($atual[0]) ? $atual[0] : $atual) : $atual;
                if (is_array($registro) && isset($registro['imagemcapa'])) {
                    $dados['imagemcapa'] = $registro['imagemcapa'];
                } elseif (is_object($registro) && isset($registro->imagemcapa)) {
                    $dados['imagemcapa'] = $registro->imagemcapa;
                }
            }
        }

        if (isset($files['imagem']) && !empty($files['imagem']['tmp_name'])) {
            if ($this->fileUploadService && method_exists($this->fileUploadService, 'uploadImoveis')) {
                $nome = $this->fileUploadService->uploadImoveis($files['imagem']);
                if ($nome) {
                    $dados['imagemcapa'] = $nome;
                }
            } else {
                @mkdir('lib/img/imagens', 0777, true);
                $nomeFinal = uniqid() . '-' . basename($files['imagem']['name']);
                $destino   = 'lib/img/imagens/' . $nomeFinal;
                if (move_uploaded_file($files['imagem']['tmp_name'], $destino)) {
                    $dados['imagemcapa'] = $nomeFinal;
                }
            }
        }

        return $dados;
    }

    // Helpers -------------------

    private function normalizarValor($valorBruto)
    {
        $v = str_replace(['R$', ' '], '', $valorBruto);
        $v = str_replace('.', '', $v);
        $v = str_replace(',', '.', $v);
        return is_numeric($v) ? $v : 0;
    }

    private function normalizarNumero($texto)
    {
        $t = str_replace(['m²', 'm2', ' '], '', $texto);
        $t = str_replace(',', '.', $t);
        return is_numeric($t) ? $t : 0;
    }

    // Métodos já existentes -------------------

    public function cadastrarImovel($dados)
    {
        $imovel = new Imovel();
        foreach ($dados as $key => $valores) {
            $imovel->__set($key, $valores);
        }
        return $this->imovelDao->adicionar($imovel);
    }

    public function editarImovel($dados)
    {
        $imovel = new Imovel();
        foreach ($dados as $key => $valores) {
            $imovel->__set($key, $valores);
        }
        return $this->imovelDao->editar($imovel);
    }

    public function atualizarStatusImovel($id, $statusId)
    {
        return $this->imovelDao->atualizarStatusImovel($id, $statusId);
    }

    public function gerarCodigoImovel($cidade, $estado, $tipoId)
    {
        // Buscar descrição do tipo
        $tipoObj = $this->tipoImovelDao->buscarPorId($tipoId);
        $tipoDescricao = $tipoObj ? $tipoObj->getDescricao() : null;

        // Verificação de segurança
        if (!$tipoDescricao) {
            throw new \Exception("Tipo de imóvel inválido para geração de código.");
        }

        // Mapeamento de siglas
        $mapaTipo = [
            'Casa' => 'Ca',
            'Apartamento' => 'Ap',
            'Edícula' => 'Ed',
            'Chácara' => 'Ch',
            'Sítio' => 'Si',
            'Fazenda' => 'Fa',
            'Barracão' => 'Ba',
            'Prédio Comercial' => 'Pc',
            'Prédio Residencial' => 'Pr',
            // Adicione mais conforme necessário
        ];

        $siglaTipo = $mapaTipo[$tipoDescricao] ?? 'XX';

        // Gerar prefixo da cidade (igual ao que você já tem)
        $palavras = explode(' ', $cidade);
        if (count($palavras) === 1) {
            $prefixoCidade = ucfirst(substr($cidade, 0, 1)) . strtolower(substr($cidade, 1, 1));
        } else {
            $prefixoCidade = '';
            foreach ($palavras as $p) {
                $prefixoCidade .= substr($p, 0, 1);
            }
            $prefixoCidade = ucfirst(substr($prefixoCidade, 0, 1)) . strtolower(substr($prefixoCidade, 1));
        }

        $prefixo = $prefixoCidade . strtoupper($estado) . $siglaTipo;

        $ultimoCodigo = $this->imovelDao->buscarUltimoCodigoPorPrefixo($prefixo);
        $numero = $ultimoCodigo ? (int)substr($ultimoCodigo, -3) + 1 : 1;
        $numeroFormatado = str_pad($numero, 3, '0', STR_PAD_LEFT);

        return $prefixo . $numeroFormatado;
    }
}
