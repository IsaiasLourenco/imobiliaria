<?php 
    namespace App\Controller;

    use App\Models\Dao\ContatoDao;
    use App\Models\Contato;

    class PainelController {

        private $contatoDao;

        public function __construct() {
            $this->contatoDao = new ContatoDao();
        }

        function index(): void {
            $mensagens = $this->contatoDao->listarTodos();
            require_once 'Views/painel/index.php';
        }
    }
?>