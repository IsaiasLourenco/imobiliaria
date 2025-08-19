<?php

namespace App\Models\Dao;

use App\Models\Conexao;

class StatusImovelDao extends Conexao
{
    public function listarTodos()
    {
        return $this->listar('statusimovel');
    }

    public function buscarPorId($id)
    {
        $condicao = "WHERE id = ?";
        $parametro = [$id];
        $resultado = $this->listar('statusimovel', $condicao, $parametro);
        return $resultado[0] ?? null;
    }
}