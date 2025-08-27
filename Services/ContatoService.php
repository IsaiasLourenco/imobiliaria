<?php

namespace App\Services;

use App\Models\Conexao;

class ContatoService extends Conexao
{
    public static function marcarComoLida($id, $ativo)
    {
        $sql = "UPDATE contato SET ativo = ? WHERE id = ?";
        $stmt = self::getConexao()->prepare($sql);
        $stmt->execute([$ativo, $id]);
    }
}
