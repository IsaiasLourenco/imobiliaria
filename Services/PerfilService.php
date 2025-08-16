<?php

namespace App\Services;

use App\Models\Dao\PerfilDao;
use App\Models\Perfil;

class PerfilService
{
    private $perfilDao;

    public function __construct(PerfilDao $perfilDao)
    {
        $this->perfilDao = $perfilDao;
    }

    public function cadastrarPerfil($dados)
    {
        $perfil = new Perfil();
        foreach ($dados as $key => $valores) {
            $perfil->__set($key, $valores);
        }
        return $this->perfilDao->adicionar($perfil);
    }

    public function editarPerfil($dados)
    {
        $perfil = new Perfil();
        foreach ($dados as $key => $valores) {
            $perfil->__set($key, $valores);
        }
        return $this->perfilDao->editar($perfil);
    }
}
