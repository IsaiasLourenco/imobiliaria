<?php

namespace App\Controller;

use App\Models\Dao\FinalidadeImovelDao;
use App\Services\FinalidadeService;
use App\Models\Notifications;
use App\Models\Finalidade;

class FinalidadeController extends Notifications
{
    private $finalidadeService;
    private $finalidadeDao;

    public function __construct()
    {
        $this->finalidadeDao = new FinalidadeImovelDao();
        $this->finalidadeService = new FinalidadeService($this->finalidadeDao);
    }

    function index()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $finalidade = $this->finalidadeDao->buscarPorId($id);
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
        $retorno = $this->finalidadeService->cadastrarFinalidade($dados);
        if ($retorno) {
            echo $this->success('Finalidade', 'Cadastrada', 'listar');
        } else {
            echo $this->error('Finalidade', 'Cadastrar', 'cadastrar');
        }
    }

    function listar()
    {
        $finalidade = $this->finalidadeDao->listarTodos();
        require_once 'Views/painel/index.php';
    }

    public function cadastrar()
    {
        $id = $_GET['id'] ?? null;
        $finalidade = null;

        if ($id) {
            $finalidade = $this->finalidadeDao->buscarPorId($id);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['id'])) {
                $this->inserir($_POST);
            } else {
                $this->editar($_POST);
            }
            return;
        }

        $view = 'Views/finalidade/cadastrar.php';
        require 'Views/painel/index.php';
    }

    function editar($dados)
    {
        $retorno = $this->finalidadeService->editarFinalidade($dados);
        if ($retorno) {
            echo $this->success('Finalidade', 'Editada', 'listar');
        } else {
            echo $this->error('Finalidade', 'Editar', 'cadastrar');
        }
    }

    function apagar()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            echo $this->confirm('Excluír', 'Finalidade', '', $id);
        }
        require 'Views/shared/header.php';
    }

    function excluir()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->finalidadeDao->apagar($id);
            echo $this->success('Finalidade', 'Excluída', 'listar');
        }
        require 'Views/shared/header.php';
    }

}
