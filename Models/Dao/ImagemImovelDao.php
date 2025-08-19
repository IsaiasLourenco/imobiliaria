<?php 

namespace App\Models\Dao;

use App\Models\Conexao;

class ImagemImovelDao extends Conexao
{
    public function buscarPorImovel($id)
    {
        return $this->listar("imagemimovel", "WHERE imovel = ?", [$id]);
    }
}

?>