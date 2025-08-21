<?php

namespace App\Controller;

use App\Models\Notifications;
use App\Models\Imovel;
use App\Models\Dao\ImovelDao;
use App\Models\Dao\ProprietarioImovelDao;
use App\Models\Dao\FinalidadeImovelDao;
use App\Models\Dao\TipoImovelDao;
use App\Services\ImovelService;
use App\Services\FileUploadService;
use App\Models\Dao\ImagemImovelDao;
use App\Models\Dao\StatusImovelDao;

class ImovelController extends Notifications
{
    private $imovelService;
    private $imovelDao;
    private $tipoImovelDao;
    private $finalidadeImovelDao;
    private $proprietarioImovelDao;
    private $fileUploadService;
    private $imagemImovelDao;
    private $statusImovelDao;

    public function __construct()
    {
        $this->tipoImovelDao = new TipoImovelDao();
        $this->imovelDao = new ImovelDao();
        $this->finalidadeImovelDao = new FinalidadeImovelDao();
        $this->proprietarioImovelDao = new ProprietarioImovelDao();

        // Use a mesma pasta para capa e galeria (consistência)
        $this->fileUploadService = new FileUploadService('lib/img/imagens');

        // Passe o FileUploadService para o ImovelService
        $this->imovelService = new ImovelService($this->imovelDao, $this->fileUploadService);

        $this->statusImovelDao = new StatusImovelDao();
        $this->imagemImovelDao = new ImagemImovelDao();
    }

    // Página inicial / index
    function index()
    {
        $id = $_GET['id'] ?? null;
        $imovel = null;
        if ($id) {
            $imovel = $this->imovelDao->buscarUnicoImovelPorId($id);
        }

        if ($_POST) {
            if (empty($_POST['id'])):
                $this->inserir($_POST);
                return;
            else:
                $this->editar($_POST);
                return;
            endif;
        }
        require_once 'Views/painel/index.php';
    }

    // Inserir novo imóvel
    public function inserir($dados)
    {
        // Normaliza os dados e trata upload da CAPA
        $dadosNormalizados = $this->imovelService->normalizarEntrada($_POST, $_FILES, 'inserir');

        // Gera código automático do imóvel
        $dadosNormalizados['codigo'] = $this->imovelService->gerarCodigoImovel(
            $dadosNormalizados['cidade'],
            $dadosNormalizados['estado']
        );

        // Chama serviço para cadastrar o imóvel
        $retorno = $this->imovelService->cadastrarImovel($dadosNormalizados);

        if ($retorno) {
            echo $this->success('Imovel', 'Cadastrado', 'listar');
        } else {
            echo $this->error('Imovel', 'Cadastrar', 'cadastrar');
        }
    }


    // Listar todos os imóveis
    function listar()
    {
        $imovel = $this->imovelDao->listarTodos();
        require_once 'Views/painel/index.php';
    }

    // Formulário de cadastro ou edição
    public function cadastrar()
    {
        $id = $_GET['id'] ?? null;
        $imovel = null;

        if ($id) {
            $imovel = $this->imovelDao->buscarUnicoImovelPorId($id);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['id'])) {
                $this->inserir($_POST);
            } else {
                $this->editar($_POST);
            }
            return;
        }

        $proprietarioimovel = $this->proprietarioImovelDao->listarTodos();
        $finalidadeimovel = $this->finalidadeImovelDao->listarTodos();
        $tipoimovel = $this->tipoImovelDao->listarTodos();
        $statusimovel = $this->statusImovelDao->listarTodos();

        $view = 'Views/imovel/cadastrar.php';
        require 'Views/painel/index.php';
    }

    // Editar imóvel existente
    public function editar($dados)
    {
        // Normaliza dados e upload da CAPA
        $dadosNormalizados = $this->imovelService->normalizarEntrada($_POST, $_FILES, 'editar');

        $retorno = $this->imovelService->editarImovel($dadosNormalizados);

        if ($retorno) {
            echo $this->success('Imovel', 'Editado', 'listar');
        } else {
            echo $this->error('Imovel', 'Editar', 'cadastrar');
        }

        // Upload da GALERIA (se houver)
        if (!empty($_FILES['imagem_galeria']['name'])) {
            $tmp = $_FILES['imagem_galeria']['tmp_name'];
            $nomeOriginal = $_FILES['imagem_galeria']['name'];
            $nomeFinal = uniqid() . '-' . basename($nomeOriginal);
            $destino = 'lib/img/imagens/' . $nomeFinal;

            if (move_uploaded_file($tmp, $destino)) {
                $salvou = $this->imagemImovelDao->inserirImagem([
                    'imagem' => $nomeFinal,
                    'imovel' => $dadosNormalizados['id']
                ]);

                if ($salvou) {
                    echo $this->success('Imagem', 'Adicionada à galeria', 'fotos&id=' . $dadosNormalizados['id']);
                } else {
                    echo $this->error('Imagem', 'Erro ao salvar no banco', 'fotos&id=' . $dadosNormalizados['id']);
                }
            } else {
                echo $this->error('Imagem', 'Falha no upload', 'fotos&id=' . $dadosNormalizados['id']);
            }
        }
    }

    // Confirmar exclusão
    function apagar()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            echo $this->confirm('Excluír', 'Imovel', '', $id);
        }
        require 'Views/shared/header.php';
    }

    // Excluir do banco
    function excluir()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->imovelDao->apagar($id);
            echo $this->success('Imovel', 'Excluído', 'listar');
        }
        require 'Views/shared/header.php';
    }

    // Detalhes do imóvel
    public function detalhes()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $imovel = $this->imovelDao->buscarUnicoImovelPorId($id);
            $imagens = $this->imagemImovelDao->buscarPorImovel($id);
            $view = 'Views/imovel/detalhes.php';
            require 'Views/painel/index.php';
        } else {
            echo $this->error('Imovel', 'Visualizar', 'listar');
        }
    }

    // Fotos do imóvel
    public function fotos()
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($id) {
            $imovel = $this->imovelDao->buscarUnicoImovelPorId($id);

            if (!$imovel) {
                echo $this->error('Imovel', 'Não encontrado', 'listar');
                return;
            }

            $fotos = $this->imagemImovelDao->buscarGaleriaPorImovel($id);

            $view = 'Views/imovel/fotos.php';
            require 'Views/painel/index.php';
        } else {
            echo $this->error('Imovel', 'Visualizar Fotos', 'listar');
        }
    }
}
