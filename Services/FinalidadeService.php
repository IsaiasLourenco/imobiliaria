<?php

namespace App\Services;

use App\Models\Dao\FinalidadeImovelDao;
use App\Models\Finalidade;

class FinalidadeService
{
    private $finalidadeDao;

    public function __construct(FinalidadeImovelDao $finalidadeDao)
    {
        $this->finalidadeDao = $finalidadeDao;
    }

    public function cadastrarFinalidade($dados)
    {
        $finalidade = new Finalidade();
        foreach ($dados as $key => $valores) {
            $finalidade->__set($key, $valores);
        }
        return $this->finalidadeDao->adicionar($finalidade);
    }

    public function editarFinalidade($dados)
    {
        $finalidade = new Finalidade();
        foreach ($dados as $key => $valores) {
            $finalidade->__set($key, $valores);
        }
        return $this->finalidadeDao->editar($finalidade);
    }

}
