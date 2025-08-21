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

        // Verifica se o código já foi atribuído no form, se não, gera um novo código
        if (empty($dadosNormalizados['codigo'])) {
            $dadosNormalizados['codigo'] = $this->imovelService->gerarCodigoImovel(
                $dadosNormalizados['cidade'],
                $dadosNormalizados['estado']
            );
        }

        // Chama o serviço para cadastrar o imóvel
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
        $imovel = $this->imovelDao->listarImoveisComFinalidade();
        $view = 'Views/imovel/listar.php';
        require 'Views/painel/index.php';
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

    public function editar($dados)
    {
        // Normaliza dados e upload da CAPA
        $dadosNormalizados = $this->imovelService->normalizarEntrada($dados, $_FILES, 'editar');

        // Recupera o imóvel do banco para garantir que o código não seja alterado
        $imovel = $this->imovelDao->buscarUnicoImovelPorId($dadosNormalizados['id']);

        // Garantir que o código não seja sobrescrito durante a edição
        if (isset($imovel->codigo) && empty($dadosNormalizados['codigo'])) {
            $dadosNormalizados['codigo'] = $imovel->codigo;
        }

        // Chama o serviço para editar o imóvel
        $retorno = $this->imovelService->editarImovel($dadosNormalizados);

        if ($retorno) {
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
                        echo $this->success('Imovel', 'Adicionada à galeria', 'fotos&id=' . $dadosNormalizados['id']);
                        return;
                    } else {
                        echo $this->error('Imagem', 'Erro ao salvar no banco', 'fotos&id=' . $dadosNormalizados['id']);
                        return;
                    }
                } else {
                    echo $this->error('Imagem', 'Falha no upload', 'fotos&id=' . $dadosNormalizados['id']);
                    return;
                }
            }

            // Se não houve imagem, redireciona para listagem
            echo $this->success('Imovel', 'Editado', 'listar');
        } else {
            echo $this->error('Imovel', 'Editar', 'cadastrar');
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
            // 1. Buscar imagens associadas ao imóvel
            $imagens = $this->imagemImovelDao->buscarPorImovel($id);

            // 2. Excluir as imagens da tabela imagemimovel
            foreach ($imagens as $imagem) {
                // Excluir a imagem fisicamente do servidor, se necessário
                if (file_exists('lib/img/imagens/' . $imagem->imagem)) {
                    unlink('lib/img/imagens/' . $imagem->imagem); // Remove o arquivo da pasta
                }

                // Excluir a imagem do banco de dados
                $this->imagemImovelDao->deletarImagem($imagem->imagem);
            }

            // 3. Excluir o imóvel da tabela imovel
            $retorno = $this->imovelDao->apagar($id);

            if ($retorno) {
                echo $this->success('Imovel', 'Excluído', 'listar');
            } else {
                echo $this->error('Imovel', 'Excluir', 'listar');
            }
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

    // Excluir uma imagem do banco de dados e do servidor
    function excluirImagem($imagemId)
    {
        // Buscar a imagem no banco
        $imagem = $this->imagemImovelDao->buscarImagemPorId($imagemId);

        if ($imagem) {
            // 1. Excluir a imagem fisicamente do servidor
            if (file_exists('lib/img/imagens/' . $imagem->imagem)) {
                unlink('lib/img/imagens/' . $imagem->imagem); // Remove o arquivo da pasta
            }

            // 2. Excluir a imagem do banco de dados
            $deletado = $this->imagemImovelDao->deletarImagem($imagem->imagem);

            if ($deletado) {
                echo $this->success('Imagem', 'Excluída', 'fotos&id=' . $imagem->imovel);
            } else {
                echo $this->error('Imagem', 'Excluir', 'fotos&id=' . $imagem->imovel);
            }
        } else {
            echo $this->error('Imagem', 'Não encontrada', 'fotos&id=' . $imagem->imovel);
        }
    }

    // Listar todos os imóveis com a descrição da finalidade
    function listarComFinalidade()
    {
        // Recupera todos os imóveis com a descrição da finalidade usando JOIN
        $imovel = $this->imovelDao->listarImoveisComFinalidade();

        require_once 'Views/painel/index.php';
    }
}
