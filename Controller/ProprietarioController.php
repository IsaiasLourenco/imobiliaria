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
        if ($_POST) {
            $this->inserir($_POST);
            return; // Evita carregar a view novamente
        }
        require_once 'Views/painel/index.php';
    }

    public function inserir($dados): void
    {
        $retorno = $this->proprietarioService->cadastrarProprietario($dados);
        if ($retorno) {
            echo $this->success('Proprietario', 'Cadastrar', 'listar');
        } else {
            echo $this->error('Proprietario', 'Cadastrar', 'cadastrar');
        }
    }

    function listar(): void
    {
        $proprietario = $this->proprietarioDao->listarTodos();
        require_once 'Views/painel/index.php';
    }

    public function cadastrar(): void
    {
        // Aqui está o ajuste: trata o POST dentro do método correto
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->inserir($_POST);
            return; // Evita carregar a view novamente após o envio
        }

        require_once 'Views/painel/index.php';
    }
}
