<?php 
    namespace App\Models;

use PDOException;
use PDO;

    class Conexao {
        private static $conexao;
        protected static function getConexao(): mixed {
            if (self::$conexao === null) {
                $info = "mysql:host=localhost; dbname=imobiliaria";
                try {
                    self::$conexao = new PDO($info, "root", "", [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf-8"]);
                    self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch(PDOException $e) {
                    die('Erro de conexão com Banco de Dados.'.$e->getMessage());
                }
            }
            return self::$conexao; 
        }
        protected static function closeConexao(): void {
            self::$conexao = null;
        }
    }
?>