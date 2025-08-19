<?php

namespace App\Controller;

use App\Models\Dao\ImovelDao;
use App\Services\ImovelService;
use App\Models\Notifications;
use App\Models\Imovel;
use App\Models\Dao\ImagemImovelDao;
use App\Models\Dao\StatusImovelDao;
use App\Models\Dao\TipoImovelDao;
use App\Models\Dao\FinalidadeImovelDao;
use App\Models\Dao\ProprietarioImovelDao;

class ImovelController extends Notifications
{
    private $imovelService;
    private $imovelDao;
    private $imagemImovelDao;
    private $statusImovelDao;
    private $tipoImovelDao;
    private $finalidadeImovelDao;
    private $proprietarioImovelDao;

    public function __construct()
    {
        $this->proprietarioImovelDao = new ProprietarioImovelDao();
        $this->finalidadeImovelDao = new FinalidadeImovelDao();
        $this->tipoImovelDao = new TipoImovelDao();
        $this->statusImovelDao = new StatusImovelDao();
        $this->imovelDao = new ImovelDao();
        $this->imovelService = new ImovelService($this->imovelDao);
        $this->imagemImovelDao = new ImagemImovelDao();
    }

    function index(): void
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $imovel = $this->imovelDao->usuarioId($id);
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

    public function inserir($dados)
    {
        $dados['valor'] = str_replace(['R$', '.', ','], ['', '', '.'], $dados['valor']);
        $retorno = $this->imovelService->cadastrarImovel($dados);
        if ($retorno) {
            echo $this->success('Imovel', 'Cadastrado', 'listar');
        } else {
            echo $this->error('Imovel', 'Cadastrar', 'cadastrar');
        }
    }

    function listar()
    {
        $imovel = $this->imovelDao->listarTodos();
        require_once 'Views/painel/index.php';
    }

    public function cadastrar()
    {
        $id = $_GET['id'] ?? null;
        $imovel = null;

        if ($id) {
            $imovel = $this->imovelDao->usuarioId($id);
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

    function editar($dados)
    {
        $dados['proprietarioimovel'] = $_POST['proprietario'] ?? null;
        $dados['finalidadeimovel'] = $_POST['finalidade'] ?? null;
        $dados['tipoimovel'] = $_POST['tipo'] ?? null;
        $dados['statusimovel'] = $_POST['status'] ?? null;
        $dados['valor'] = str_replace(['R$', '.', ','], ['', '', '.'], $dados['valor']);
        $retorno = $this->imovelService->editarImovel($dados);
        if ($retorno) {
            echo $this->success('Imovel', 'Editado', 'listar');
        } else {
            echo $this->error('Imovel', 'Editar', 'cadastrar');
        }
    }

    function apagar()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            echo $this->confirm('Excluír', 'Imovel', '', $id);
        }
        require 'Views/shared/header.php';
    }

    function excluir()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->imovelDao->apagar($id);
            echo $this->success('Imovel', 'Excluído', 'listar');
        }
        require 'Views/shared/header.php';
    }
    
    public function detalhes()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $imovel = $this->imovelDao->usuarioId($id);
            $imagens = $this->imagemImovelDao->buscarPorImovel($id);
            $view = 'Views/imovel/detalhes.php';
            require 'Views/painel/index.php';
        } else {
            echo $this->error('Imovel', 'Visualizar', 'listar');
        }
    }

}
