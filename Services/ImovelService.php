<?php

namespace App\Services;

use App\Models\Dao\ImovelDao;
use App\Models\Imovel;

class ImovelService
{
    private $imovelDao;

    public function __construct(ImovelDao $imovelDao)
    {
        $this->imovelDao = $imovelDao;
    }

    public function cadastrarImovel($dados)
    {
        $imovel = new Imovel();
        foreach ($dados as $key => $valores) {
            $imovel->__set($key, $valores);
        }
        return $this->imovelDao->adicionar($imovel);
    }

    public function editarImovel($dados)
    {
        $imovel = new Imovel();
        foreach ($dados as $key => $valores) {
            $imovel->__set($key, $valores);
        }
        return $this->imovelDao->editar($imovel);
    }

    public function atualizarStatusImovel($id, $statusId)
    {
        return $this->imovelDao->atualizarStatusImovel($id, $statusId);
    }
}
