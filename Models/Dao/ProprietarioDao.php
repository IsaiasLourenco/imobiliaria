<?php

namespace App\Models\Dao;

use App\Models\Conexao;
use App\Models\Proprietario;

class ProprietarioDao extends Conexao
{
    public function listarTodos() {
        return $this->listar("proprietario");
    }

    public function usuarioId($id) {
        return $this->listar("proprietario", "WHERE ID = ?", [$id]);
    }

    public function adicionar(Proprietario $proprietario)
    {
        $atributos = array_keys($proprietario->atributosPreenchidos());
        $valores = array_values($proprietario->atributosPreenchidos());
        return $this->inserir('proprietario', $atributos, $valores);
    }
    
    public function editar(Proprietario $proprietario)
    {
        $atributos = array_keys($proprietario->atributosPreenchidos());
        $valores = array_values($proprietario->atributosPreenchidos());
        return $this->update('proprietario', $atributos, $valores, $proprietario->getId());
    }
}
