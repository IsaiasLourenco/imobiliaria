<?php

namespace App\Controller;

use App\Models\Dao\ProprietarioDao;
use App\Services\ProprietarioService;
use App\Models\Notifications;
use App\Models\Proprietario;

class ProprietarioController extends Notifications
{
    private $proprietarioService;
    private $proprietarioDao;

    public function __construct()
    {
        $this->proprietarioDao = new ProprietarioDao();
        $this->proprietarioService = new ProprietarioService($this->proprietarioDao);
    }

    function index()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $proprietario = $this->proprietarioDao->usuarioId($id);
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
        $retorno = $this->proprietarioService->cadastrarProprietario($dados);
        if ($retorno) {
            echo $this->success('Proprietario', 'Cadastrado', 'listar');
        } else {
            echo $this->error('Proprietario', 'Cadastrar', 'cadastrar');
        }
    }

    function listar()
    {
        $proprietario = $this->proprietarioDao->listarTodos();
        require_once 'Views/painel/index.php';
    }

    public function cadastrar()
    {
        $id = $_GET['id'] ?? null;
        $proprietario = null;

        if ($id) {
            $proprietario = $this->proprietarioDao->usuarioId($id);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['id'])) {
                $this->inserir($_POST);
            } else {
                $this->editar($_POST);
            }
            return;
        }

        $view = 'Views/proprietario/cadastrar.php';
        require 'Views/painel/index.php';
    }

    function editar($dados)
    {
        $retorno = $this->proprietarioService->editarProprietario($dados);
        if ($retorno) {
            echo $this->success('Proprietario', 'Editado', 'listar');
        } else {
            echo $this->error('Proprietario', 'Editar', 'cadastrar');
        }
    }

    function apagar()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            echo $this->confirm('Excluír', 'Proprietario', '', $id);
        }
        require 'Views/shared/header.php';
    }

    function excluir()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->proprietarioDao->apagar($id);
            echo $this->success('Proprietario', 'Excluído', 'listar');
        }
        require 'Views/shared/header.php';
    }

    public function alterarCadeado()
    {
        $id = $_GET['id'] ?? null;
        $ativo = $_GET['ativo'] ?? null;

        if ($id !== null && $ativo !== null) {
            $this->proprietarioService->atualizarStatus($id, $ativo);
        }
    }
}
