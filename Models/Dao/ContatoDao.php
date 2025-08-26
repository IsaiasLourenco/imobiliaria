<?php

namespace App\Models\Dao;

use App\Models\Conexao;
use App\Models\Contato;

class ContatoDao extends Conexao
{
    public function listarTodos()
    {
        return $this->listar("contato");
    }

    public function buscarContatoPorId($id)
    {
        $result = $this->listar("contato", "WHERE id = ?", [$id]);
        return $result ? $result[0] : null; // Retorna o primeiro item ou null
    }


    public function adicionar(Contato $contato)
    {
        $atributos = array_keys($contato->atributosPreenchidos());
        $valores = array_values($contato->atributosPreenchidos());
        return $this->inserir('contato', $atributos, $valores);
    }

    public function editar(Contato $contato)
    {
        $atributos = array_keys($contato->atributosPreenchidos());
        $valores = array_values($contato->atributosPreenchidos());
        return $this->update('contato', $atributos, $valores, $contato->getId());
    }

    public function apagar($id)
    {
        return $this->deletar('contato', $id);
    }

}
