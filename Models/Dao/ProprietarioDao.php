<?php

namespace App\Models\Dao;

use App\Models\Conexao;
use App\Models\Proprietario;

class ProprietarioDao extends Conexao
{
    public function listarTodos() {
        return $this->listar("PROPRIETARIO");
    }

    public function adicionar(Proprietario $proprietario)
    {
        $atributos = array_keys($proprietario->atributosPreenchidos());
        $valores = array_values($proprietario->atributosPreenchidos());
        return $this->inserir('proprietario', $atributos, $valores);
    }
}
