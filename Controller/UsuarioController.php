<?php

namespace App\Controller;

use App\Models\Dao\UsuarioDao;
use App\Services\UsuarioService;
use App\Models\Notifications;
use App\Models\Usuario;
use App\Models\Dao\PerfilDao;

class UsuarioController extends Notifications
{
    private $usuarioService;
    private $usuarioDao;
    private $perfil;

    public function __construct()
    {
        $this->perfil = new PerfilDao();
        $this->usuarioDao = new UsuarioDao();
        $this->usuarioService = new UsuarioService($this->usuarioDao);
    }

    function index(): void
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $usuario = $this->usuarioDao->usuarioId($id);
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
        $perfil = $this->perfil->listarTodos();
        require_once 'Views/painel/index.php';
    }

    public function inserir($dados): void
    {
        $retorno = $this->usuarioService->cadastrarUsuario($dados);
        if ($retorno) {
            echo $this->success('Usuario', 'Cadastrado', 'listar');
        } else {
            echo $this->error('Usuario', 'Cadastrado', 'cadastrar');
        }
    }

    function listar(): void
    {
        $usuario = $this->usuarioDao->listarTodos();
        require_once 'Views/painel/index.php';
    }

    public function cadastrar(): void
    {
        $id = $_GET['id'] ?? null;
        $usuario = null;

        if ($id) {
            $usuario = $this->usuarioDao->usuarioId($id);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['id'])) {
                $this->inserir($_POST);
            } else {
                $this->editar($_POST);
            }
            return;
        }
        $perfil = $this->perfil->listarTodos();
        $view = 'Views/usuarios/cadastrar.php';
        require 'Views/painel/index.php';
    }

    function editar($dados): void
    {
        $retorno = $this->usuarioService->editarUsuario($dados);
        if ($retorno) {
            echo $this->success('Usuario', 'Editado', 'listar');
        } else {
            echo $this->error('Usuario', 'Cadastrado', 'cadastrar');
        }
    }

    function apagar(): void
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            echo $this->confirm('Excluír', 'Usuario', '', $id);
        }
        require 'Views/shared/header.php';
    }

    function excluir(): void
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->usuarioDao->apagar($id);
            echo $this->success('Usuario', 'Excluído', 'listar');
        }
        require 'Views/shared/header.php';
    }

    public function alterarCadeado(): void
    {
        $id = $_GET['id'] ?? null;
        $ativo = $_GET['ativo'] ?? null;

        if ($id !== null && $ativo !== null) {
            $this->usuarioService->atualizarStatus($id, $ativo);
        }
    }
}
 