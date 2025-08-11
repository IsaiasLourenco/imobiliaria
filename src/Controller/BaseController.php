<?php 
    namespace App\Controller;

    class BaseController {
        function index(): void {
            require_once 'Views/home/index.php';
        }
    }
?>