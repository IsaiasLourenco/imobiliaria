<?php

namespace App\Models\Dao;

use App\Models\Conexao;

class FinalidadeImovelDao extends Conexao
{
    public function listarTodos()
    {
        return $this->listar('finalidade');
    }

    public function buscarPorId($id)
    {
        $condicao = "WHERE id = ?";
        $parametro = [$id];
        $resultado = $this->listar('finalidade', $condicao, $parametro);
        return $resultado[0] ?? null;
    }
}