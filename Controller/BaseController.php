<?php 
    namespace App\Controller;

use App\Models\Dao\ImovelDao;

    class BaseController {
        function index() {
            $imoveis = (new ImovelDao())->listarTodos();
            require_once 'Views/home/index.php';
        }
    }
?>