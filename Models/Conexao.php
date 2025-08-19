<?php  
namespace App\Models;

use PDOException;
use PDO;

class Conexao {
    private static $conexao;
    // LOCALHOST
    protected static function getConexao() {
        if (self::$conexao === null) {
            $info = "mysql:host=localhost; dbname=imobiliaria";
            try {
                self::$conexao = new PDO($info, "root", "", [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                die('Erro de conexão com Banco de Dados. '.$e->getMessage());
            }
        }
        return self::$conexao; 
    }
    // HOSPEDADO
    // protected static function getConexao() {
    //     if (self::$conexao === null) {
    //         $info = "mysql:host=localhost; dbname=isaia876_imobiliaria";
    //         try {
    //             self::$conexao = new PDO($info, "isaia876_imobiliaria", "ImobVetor256", [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
    //             self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //         } catch(PDOException $e) {
    //             die('Erro de conexão com Banco de Dados. '.$e->getMessage());
    //         }
    //     }
    //     return self::$conexao; 
    // }

    protected static function closeConexao() {
        self::$conexao = null;
    }

    protected function executarConsulta($sql, $valores = []) {
        try {
            $stmt = self::getConexao()->prepare($sql);
            foreach($valores as $key => $valor) {
                $stmt->bindValue($key + 1, $valor);
            }
            $stmt->execute();
            return $stmt;
        } catch(PDOException $e) {
            die('Erro ao executar consulta no Banco de Dados! '.$e->getMessage());
        }
    }

    // LISTA OBJETOS DO BANCO DE DADOS
    protected function listar($tabela, $condicao = "", $parametro = []) {
        $sql = "SELECT * FROM {$tabela} {$condicao} ORDER BY id DESC";
        $stmt = $this->executarConsulta($sql, $parametro);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // INSERINDO OBJETOS NO BANCO DE DADOS
    protected function inserir($tabela, $atributos, $valores) {
        $sql = "INSERT INTO {$tabela} (" . implode(",", $atributos) . ") VALUES (" . implode(",", array_fill(0, count($valores), "?")) . ")";
        $stmt = $this->executarConsulta($sql, $valores);
        return self::getConexao()->lastInsertId(); 
    }

    // ATUALIZANDO OBJETOS NO BANCO DE DADOS
    protected function update($tabela, $campos, $valores, $id) {
        $set = implode(',', array_map(function($campo) {
            return "$campo = ?";
        }, $campos));
        $sql = "UPDATE {$tabela} SET {$set} WHERE id = ?";
        $stmt = $this->executarConsulta($sql, array_merge($valores, [$id]));
        return $stmt->rowCount();
    }

    // DELETANDO OBJETOS DO BANCO DE DADOS
    protected function deletar($tabela, $id) {
        $sql = "DELETE FROM {$tabela} WHERE id = ?";
        $stmt = $this->executarConsulta($sql, [$id]);
        return $stmt->rowCount();
    }
}
?>