<?php

namespace App\Models\Dao;

use App\Models\Conexao;
use App\Models\Usuario;

class UsuarioDao extends Conexao
{
    public function listarTodos()
    {
        $sql = "SELECT u.*, p.DESCRICAO AS NOME_PERFIL
            FROM usuario u
            LEFT JOIN perfil p ON u.PERFIL = p.ID";
        $stmt = self::getConexao()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function usuarioId($id)
    {
        return $this->listar("usuario", "WHERE ID = ?", [$id]);
    }

    public function adicionar(Usuario $usuario)
    {
        $atributos = array_keys($usuario->atributosPreenchidos());
        $valores = array_values($usuario->atributosPreenchidos());
        return $this->inserir('usuario', $atributos, $valores);
    }

    public function editar(Usuario $usuario)
    {
        $atributos = array_keys($usuario->atributosPreenchidos());
        $valores = array_values($usuario->atributosPreenchidos());
        return $this->update('usuario', $atributos, $valores, $usuario->getId());
    }

    public function apagar($id)
    {
        return $this->deletar('usuario', $id);
    }

    public function atualizarStatus($id, $ativo): bool
    {
        $sql = "UPDATE usuario SET ativo = :ativo WHERE id = :id";
        $stmt = self::getConexao()->prepare($sql);
        $stmt->bindParam(':ativo', $ativo);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
