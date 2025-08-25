<?php

namespace App\Models\Dao;

use App\Models\Conexao;
use App\Models\Usuario;

class UsuarioDao extends Conexao
{
    public function listarTodos()
    {
        $sql = "SELECT u.*, p.descricao AS NOME_PERFIL
            FROM usuario u
            LEFT JOIN perfil p ON u.PERFIL = p.id";
        $stmt = self::getConexao()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function buscarUsuarioPorId($id): ?Usuario
    {
        $dados = $this->listar("usuario", "WHERE id = ?", [$id]);
        if (!$dados || count($dados) === 0) {
            return null;
        }
        return $this->mapToUsuario((array)$dados[0]);
    }

    private function mapToUsuario(array $row): Usuario
    {
        return new Usuario(
            $row['id'] ?? 0,
            $row['nome'] ?? '',
            $row['usuario'] ?? '',
            $row['senha'] ?? '',
            $row['perfil'] ?? '',
            $row['email'] ?? '',
            $row['telefone'] ?? '',
            $row['cep'] ?? '',
            $row['logradouro'] ?? '',
            $row['numero'] ?? '',
            $row['complemento'] ?? '',
            $row['bairro'] ?? '',
            $row['cidade'] ?? '',
            $row['estado'] ?? '',
            $row['imagem'] ?? '',
            $row['datacadastro'] ?? '',
            $row['ativo'] ?? 1
        );
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
        $ativo = (int)$ativo; // garante 0 ou 1
        $id = (int)$id;

        $sql = "UPDATE usuario SET ativo = :ativo WHERE id = :id";
        $stmt = self::getConexao()->prepare($sql);
        $stmt->bindValue(':ativo', $ativo, \PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function autenticar($usuario) {
        // return $this->listar("USUARIO", "WHERE usuario '". $usuario ."'");
        return $this->listar("usuario", "WHERE usuario = ?", [$usuario]);
    }

}
