<?php

namespace App\Controller;

use App\Models\Dao\ContatoDao;
use App\Models\Contato;
use App\Models\Conexao;
use App\Services\ContatoService;

class PainelController
{
    private $contatoDao;

    public function __construct()
    {
        $this->contatoDao = new ContatoDao();
    }

    public function index(): void
    {
        $mensagens = $this->contatoDao->listarTodos();
        require_once 'Views/painel/index.php';
    }

    public function marcarComoLida()
    {
        $id = $_GET['id'] ?? null;
        $ativo = $_GET['ativo'] ?? null;

        if ($id !== null && $ativo !== null) {
            ContatoService::marcarComoLida($id, $ativo);
        }
    }
}