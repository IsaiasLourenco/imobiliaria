<?php

namespace App\Services;

use App\Models\Dao\ProprietarioDao;
use App\Models\Proprietario;

class ProprietarioService
{
    private $proprietarioDao;

    public function __construct(ProprietarioDao $proprietarioDao)
    {
        $this->proprietarioDao = $proprietarioDao;
    }

    public function cadastrarProprietario($dados)
    {
        $proprietario = new Proprietario();
        foreach ($dados as $key => $valores) {
            $proprietario->__set($key, $valores);
        }
        return $this->proprietarioDao->adicionar($proprietario);
    }

    public function editarProprietario($dados)
    {
        $proprietario = new Proprietario();
        foreach ($dados as $key => $valores) {
            $proprietario->__set($key, $valores);
        }
        return $this->proprietarioDao->editar($proprietario);
    }

    public function atualizarStatus($id, $ativo)
    {
        return $this->proprietarioDao->atualizarStatus($id, $ativo);
    }
}
