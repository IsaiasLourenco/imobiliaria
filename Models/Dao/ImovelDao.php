<?php

namespace App\Models\Dao;

use App\Models\Conexao;
use App\Models\Imovel;

class ImovelDao extends Conexao
{
    public function listarTodos()
    {
        return $this->listar("imovel");
    }

    public function usuarioId($id)
    {
        return $this->listar("imovel", "WHERE id = ?", [$id]);
    }

    public function adicionar(Imovel $imovel)
    {
        $atributos = array_keys($imovel->atributosPreenchidos());
        $valores = array_values($imovel->atributosPreenchidos());
        return $this->inserir('imovel', $atributos, $valores);
    }

    public function editar(Imovel $imovel)
    {
        $atributos = array_keys($imovel->atributosPreenchidos());
        $valores = array_values($imovel->atributosPreenchidos());
        return $this->update('imovel', $atributos, $valores, $imovel->getId());
    }

    public function apagar($id)
    {
        return $this->deletar('imovel', $id);
    }

    public function atualizarStatusImovel($id, $statusId)
    {
        $sql = "UPDATE imovel SET statusimovel = :statusId WHERE id = :id";
        $stmt = self::getConexao()->prepare($sql);
        $stmt->bindParam(':statusId', $statusId);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
