<?php

namespace App\Controller;

use App\Models\Notifications;
use App\Models\Dao\ImovelDao;

class ListarImoveisComFinalidade extends Notifications
{
    private $imovelDao;

    public function __construct()
    {
        $this->imovelDao = new ImovelDao();
    }

    public function index()
    {
        $imovel = $this->imovelDao->listarImoveisComFinalidade();
        $view = 'Views/imovel/listar.php';
        require 'Views/painel/index.php';
    }
}