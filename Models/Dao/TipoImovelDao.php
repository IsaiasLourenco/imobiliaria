<?php

namespace App\Models\Dao;

use App\Models\Conexao;

class TipoImovelDao extends Conexao
{
    public function listarTodos()
    {
        return $this->listar('tipoimovel');
    }

    public function buscarPorId($id)
    {
        $condicao = "WHERE id = ?";
        $parametro = [$id];
        $resultado = $this->listar('tipoimovel', $condicao, $parametro);
        return $resultado[0] ?? null;
    }
}