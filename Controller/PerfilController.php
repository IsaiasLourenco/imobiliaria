<?php

namespace App\Controller;

use App\Models\Dao\PerfilDao;
use App\Services\PerfilService;
use App\Models\Notifications;
use App\Models\Perfil;

class PerfilController extends Notifications
{
    private $perfilService;
    private $perfilDao;

    public function __construct()
    {
        $this->perfilDao = new PerfilDao();
        $this->perfilService = new PerfilService($this->perfilDao);
    }

    function index(): void
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $perfil = $this->perfilDao->usuarioId($id);
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
        $retorno = $this->perfilService->cadastrarPerfil($dados);
        if ($retorno) {
            echo $this->success('Perfil', 'Cadastrado', 'listar');
        } else {
            echo $this->error('Perfil', 'Cadastrado', 'cadastrar');
        }
    }

    function listar(): void
    {
        $proprietario = $this->perfilDao->listarTodos();
        require_once 'Views/painel/index.php';
    }

    public function cadastrar(): void
    {
        $id = $_GET['id'] ?? null;
        $perefil = null;

        if ($id) {
            $perfil = $this->perfilDao->usuarioId($id);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['id'])) {
                $this->inserir($_POST);
            } else {
                $this->editar($_POST);
            }
            return;
        }

        // $view = 'Views/proprietario/cadastrar.php';
        require 'Views/painel/index.php';
    }

    function editar($dados): void
    {
        $retorno = $this->perfilService->editarPerfil($dados);
        if ($retorno) {
            echo $this->success('Perfil', 'Editado', 'listar');
        } else {
            echo $this->error('Perfil', 'Cadastrado', 'cadastrar');
        }
    }

    function apagar(): void
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            echo $this->confirm('Excluír', 'Perfil', '', $id);
        }
        require 'Views/shared/header.php';
    }

    function excluir(): void
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->perfilDao->apagar($id);
            echo $this->success('Perfil', 'Excluído', 'listar');
        }
        require 'Views/shared/header.php';
    }
}
