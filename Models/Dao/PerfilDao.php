<?php

namespace App\Models\Dao;

use App\Models\Conexao;
use App\Models\Perfil;

class PerfilDao extends Conexao
{
    public function listarTodos()
    {
        return $this->listar("perfil");
    }

    public function usuarioId($id)
    {
        return $this->listar("perfil", "WHERE ID = ?", [$id]);
    }

    public function adicionar(Perfil $perfil)
    {
        $atributos = array_keys($perfil->atributosPreenchidos());
        $valores = array_values($perfil->atributosPreenchidos());
        return $this->inserir('perfil', $atributos, $valores);
    }

    public function editar(Perfil $perfil)
    {
        $atributos = array_keys($perfil->atributosPreenchidos());
        $valores = array_values($perfil->atributosPreenchidos());
        return $this->update('perfil', $atributos, $valores, $perfil->getId());
    }

    public function apagar($id)
    {
        return $this->deletar('perfil', $id);
    }
}
