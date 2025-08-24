<?php

namespace App\Services;

use App\Models\Dao\TipoImovelDao;
use App\Models\TipoImovel;

class TipoImovelService
{
    private $tipoImovelDao;

    public function __construct(TipoImovelDao $tipoImovelDao)
    {
        $this->tipoImovelDao = $tipoImovelDao;
    }

    public function cadastrarTipoImovel($dados)
    {
        $tipoImovel = new TipoImovel();

        foreach ($dados as $key => $valores) {
            $metodo = 'set' . ucfirst($key);
            if (method_exists($tipoImovel, $metodo)) {
                $tipoImovel->$metodo($valores);
            }
        }
        return $this->tipoImovelDao->adicionar($tipoImovel);
    }


    public function editarTipoImovel($dados)
    {
        $tipoImovel = new TipoImovel();
        foreach ($dados as $key => $valores) {
            $metodo = 'set' . ucfirst($key);
            if (method_exists($tipoImovel, $metodo)) {
                $tipoImovel->$metodo($valores);
            }
        }
        return $this->tipoImovelDao->editar($tipoImovel);
    }
}
