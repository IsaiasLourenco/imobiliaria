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
        protected function executarConsulta($sql, $valores = []): mixed {
            try {
                $stmt = self::getConexao()->prepare($sql);
                foreach($valores as $key => $valor) {
                    $stmt->bindValue($key + 1, $valor);
                }
                $stmt->execute();
                return $stmt;
            } catch(PDOException $e) {
                die('Erro ao executar consulta no Banco de Dados!'. $e->getMessage());
            }
        }
        // LISTA OBJETOS DO BANCO DE DADOS
        protected function listar($tabela, $condicao = "", $parametro = []): mixed {
            $sql = "SELECT * FROM {$tabela} {$condicao} ORDER BY ID DESC";
            $stmt = $this->executarConsulta(sql: $sql, valores: $parametro);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        // INSERINDO OBJETOS NO BANCO DE DADOS
        protected function inserir($tabela, $atributos, $valores): mixed {
            $sql = "INSERT INTO {$tabela} (" . implode(",", $atributos) . ") VALUES (" . implode(",", array_fill(0, count($valores), "?")) . ")";
            $stmt = $this->executarConsulta(sql: $sql, valores: $valores);
            return self::getConexao()->lastInsertId(); 
        }
    }
?>