<?php

namespace App\Controller;

use App\Models\Dao\ProprietarioDao;
use App\Services\ProprietarioService;
use App\Models\Notifications;

class ProprietarioController extends Notifications
{
    private $proprietarioService;
    private $proprietarioDao;

    public function __construct()
    {
        $this->proprietarioDao = new ProprietarioDao();
        $this->proprietarioService = new ProprietarioService($this->proprietarioDao);
    }

    function index(): void
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

    public function inserir($dados): void
    {
        $retorno = $this->proprietarioService->cadastrarProprietario($dados);
        if ($retorno) {
            echo $this->success('Proprietario', 'Cadastrado', 'listar');
        } else {
            echo $this->error('Proprietario', 'Cadastrado', 'cadastrar');
        }
    }

    function listar(): void
    {
        $proprietario = $this->proprietarioDao->listarTodos();
        require_once 'Views/painel/index.php';
    }

    public function cadastrar(): void
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

    function editar($dados): void
    {
        $retorno = $this->proprietarioService->editarProprietario($dados);
        if ($retorno) {
            echo $this->success('Proprietario', 'Editado', 'listar');
        } else {
            echo $this->error('Proprietario', 'Cadastrado', 'cadastrar');
        }
    }
}
