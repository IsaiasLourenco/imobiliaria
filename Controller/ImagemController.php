<?php

namespace App\Controller;

use App\Models\Notifications;
use App\Models\Dao\ImagemImovelDao;

class ImagemController extends Notifications
{
    private $imagemImovelDao;

    public function __construct()
    {
        $this->imagemImovelDao = new ImagemImovelDao();
    }

    public function fotos()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo $this->error('Imóvel', 'ID inválido', 'listar');
            return;
        }

        $fotos = $this->imagemImovelDao->buscarGaleriaPorImovel($id);
        $view = 'Views/imovel/fotos.php';
        require 'Views/painel/index.php';
    }
}