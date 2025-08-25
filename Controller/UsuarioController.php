<?php

namespace App\Controller;

use App\Models\Dao\UsuarioDao;
use App\Services\UsuarioService;
use App\Models\Notifications;
use App\Models\Usuario;
use App\Models\Dao\PerfilDao;
use App\Services\FileUploadService;

class UsuarioController extends Notifications
{
    private $usuarioService;
    private $usuarioDao;
    private $perfil;
    private $fileUploadServiceUsuarios;
    private $fileUploadServiceImoveis;



    public function __construct()
    {
        $this->perfil = new PerfilDao();
        $this->usuarioDao = new UsuarioDao();
        $this->usuarioService = new UsuarioService($this->usuarioDao);
        $this->fileUploadServiceUsuarios = new FileUploadService('lib/img/users-imagens');
        $this->fileUploadServiceImoveis = new FileUploadService('lib/img/imagens');
    }

    function index()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $usuario = $this->usuarioDao->buscarUsuarioPorId($id);
        }

        if ($_POST) {
            if (empty($_POST['id'])):
                $this->inserir($_POST, $_FILES);
                return;
            else:
                $this->editar($_POST, $_FILES);
                return;
            endif;
        }
        $perfil = $this->perfil->listarTodos();
        require_once 'Views/painel/index.php';
    }

    public function inserir($dados, $file)
    {
        $imagem = $this->fileUploadServiceUsuarios->uploadUsers($file['imagem']);
        $retorno = $this->usuarioService->cadastrarUsuario($dados, $imagem);
        if ($retorno) {
            echo $this->success('Usuario', 'Cadastrado', 'listar');
        } else {
            echo $this->error('Usuario', 'Cadastrar', 'cadastrar');
        }
    }

    function listar()
    {
        $usuario = $this->usuarioDao->listarTodos();
        require_once 'Views/painel/index.php';
    }

    public function cadastrar()
    {
        $id = $_GET['id'] ?? null;
        $usuario = null;

        if ($id) {
            $usuario = $this->usuarioDao->buscarUsuarioPorId($id);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['id'])) {
                $this->inserir($_POST, $_FILES);
            } else {
                $this->editar($_POST, $_FILES);
            }
            return;
        }
        $perfil = $this->perfil->listarTodos();
        $view = 'Views/usuario/cadastrar.php';
        require 'Views/painel/index.php';
    }

    function editar($dados, $file)
    {
        $usuarioAntigo = $this->usuarioDao->buscarUsuarioPorId($dados['id']);

        if (!$usuarioAntigo) {
            echo $this->error('Usuario', 'Não encontrado para edição', 'listar');
            return;
        }

        $imagem = $this->fileUploadServiceUsuarios->uploadUsers($file['imagem']);

        if ($imagem === null || $imagem === '') {
            $dados['imagem'] = $usuarioAntigo->getImagem();
        } else {
            $dados['imagem'] = $imagem;
        }

        $retorno = $this->usuarioService->editarUsuario($dados, $dados['imagem']);

        if ($retorno) {
            echo $this->success('Usuario', 'Editado', 'listar');
        } else {
            echo $this->error('Usuario', 'Editar', 'cadastrar&id=' . $dados['id']);
        }
    }

    function apagar()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            echo $this->confirm('Excluír', 'Usuario', '', $id);
        }
        require 'Views/shared/header.php';
    }

    function excluir()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->usuarioDao->apagar($id);
            echo $this->success('Usuario', 'Excluído', 'listar');
        }
        require 'Views/shared/header.php';
    }

    public function alterarCadeado()
    {
        $id = $_GET['id'] ?? null;
        $ativo = $_GET['ativo'] ?? null;

        if ($id !== null && $ativo !== null) {
            $this->usuarioService->atualizarStatus($id, $ativo);
        }
    }

    public function autenticar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        }
        require_once 'Views/usuario/autenticar.php';
    }

}
