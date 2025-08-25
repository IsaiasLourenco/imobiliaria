<?php

namespace App\Controller;

use App\Models\Dao\TipoImovelDao;
use App\Services\TipoImovelService;
use App\Models\Notifications;
use App\Models\TipoImovel;

class TipoImovelController extends Notifications
{
    private $tipoImovelService;
    private $tipoImovelDao;

    public function __construct()
    {
        $this->tipoImovelDao = new TipoImovelDao();
        $this->tipoImovelService = new TipoImovelService($this->tipoImovelDao);
    }

    function index()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $tipoImovel = $this->tipoImovelDao->buscarPorId($id);
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
        $retorno = $this->tipoImovelService->cadastrarTipoImovel($dados);
        if ($retorno) {
            echo $this->success('tipoimovel', 'Cadastrado', 'listar');
        } else {
            echo $this->error('tipoimovel', 'Cadastrar', 'cadastrar');
        }
    }

    function listar()
    {
        $tipoImovel = $this->tipoImovelDao->listarTodos();
        require_once 'Views/painel/index.php';
    }

    public function cadastrar()
    {
        global $tipoImovel;

        $id = $_GET['id'] ?? null;

        if ($id) {
            $tipoImovel = $this->tipoImovelDao->buscarPorId($id);
        } else {
            $tipoImovel = new \App\Models\TipoImovel(); // garante que não seja null
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['id'])) {
                $this->inserir($_POST);
            } else {
                $this->editar($_POST);
            }
            return;
        }

        $view = 'Views/tipoimovel/cadastrar.php';
        require 'Views/painel/index.php';
    }

    function editar($dados)
    {
        $retorno = $this->tipoImovelService->editarTipoImovel($dados);
        if ($retorno) {
            echo $this->success('tipoimovel', 'Editado', 'listar');
        } else {
            echo $this->error('tipoimovel', 'Editar', 'cadastrar');
        }
    }

    function apagar()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            echo $this->confirm('Excluír', 'tipoimovel', '', $id);
        }
        require 'Views/shared/header.php';
    }

    function excluir()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->tipoImovelDao->apagar($id);
            echo $this->success('tipoimovel', 'Excluído', 'listar');
        }
        require 'Views/shared/header.php';
    }
}
