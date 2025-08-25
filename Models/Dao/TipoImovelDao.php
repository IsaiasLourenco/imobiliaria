<?php

namespace App\Models\Dao;

use App\Models\Conexao;
use App\Models\TipoImovel;

class TipoImovelDao extends Conexao
{
    public function listarTodos()
    {
        return $this->listar('tipoimovel'); // só pega todos os tipos
    }

    public function buscarPorId($id): ?TipoImovel
    {
        $dados = $this->listar("tipoimovel", "WHERE id = ?", [$id]);
        if (!$dados || count($dados) === 0) {
            return null;
        }
        return $this->mapToTipoImovel($dados[0]); // Agora apenas passa o objeto direto
    }

    private function mapToTipoImovel($row): TipoImovel
    {
        return new TipoImovel(
            $row->id ?? 0, // Acesso por "->" em vez de array
            $row->descricao ?? '' // Acesso por "->" em vez de array
        );
    }

    public function adicionar(TipoImovel $tipoImovel)
    {
        $atributos = array_keys($tipoImovel->atributosPreenchidos());
        $valores = array_values($tipoImovel->atributosPreenchidos());
        return $this->inserir('tipoimovel', $atributos, $valores);
    }

    public function editar(TipoImovel $tipoImovel)
    {
        $atributos = array_keys($tipoImovel->atributosPreenchidos());
        $valores = array_values($tipoImovel->atributosPreenchidos());
        return $this->update('tipoimovel', $atributos, $valores, $tipoImovel->getId());
    }

    public function apagar($id)
    {
        return $this->deletar('tipoimovel', $id);
    }
}
