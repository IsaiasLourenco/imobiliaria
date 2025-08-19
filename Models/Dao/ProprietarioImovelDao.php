<?php

namespace App\Models\Dao;

use App\Models\Conexao;

class ProprietarioImovelDao extends Conexao
{
    public function listarTodos()
    {
        $condicao = "WHERE ativo = 1";
        return $this->listar('proprietario', $condicao);
    }

    public function buscarPorId($id)
    {
        $condicao = "WHERE id = ?";
        $parametro = [$id];
        $resultado = $this->listar('proprietario', $condicao, $parametro);
        return $resultado[0] ?? null;
    }
}
