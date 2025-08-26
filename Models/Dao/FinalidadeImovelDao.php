<?php

namespace App\Models\Dao;

use App\Models\Conexao;
use App\Models\Finalidade;

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

        if (!empty($resultado)) {
            return $this->mapToFinalidadeImovel($resultado[0]);
        }

        return null;
    }

    private function mapToFinalidadeImovel($row): Finalidade
    {
        return new Finalidade(
            $row->id ?? 0, // Acesso por "->" em vez de array
            $row->descricao ?? '' // Acesso por "->" em vez de array
        );
    }

    public function adicionar(Finalidade $finalidade)
    {
        $atributos = array_keys($finalidade->atributosPreenchidos());
        $valores = array_values($finalidade->atributosPreenchidos());
        return $this->inserir('finalidade', $atributos, $valores);
    }

    public function editar(Finalidade $finalidade)
    {
        $atributos = array_keys($finalidade->atributosPreenchidos());
        $valores = array_values($finalidade->atributosPreenchidos());
        return $this->update('finalidade', $atributos, $valores, $finalidade->getId());
    }

    public function apagar($id)
    {
        return $this->deletar('finalidade', $id);
    }
}
