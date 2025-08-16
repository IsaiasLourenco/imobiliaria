<?php

namespace App\Services;

use App\Models\Dao\UsuarioDao;
use App\Models\Usuario;

class UsuarioService
{
    private $usuarioDao;

    public function __construct(UsuarioDao $usuarioDao)
    {
        $this->usuarioDao = $usuarioDao;
    }

    public function cadastrarUsuario($dados)
    {
        $usuario = new Usuario();
        foreach ($dados as $key => $valores) {
            $usuario->__set($key, $valores);
        }
        return $this->usuarioDao->adicionar($usuario);
    }

    public function editarUsuario($dados)
    {
        $usuario = new Usuario();
        foreach ($dados as $key => $valores) {
            $usuario->__set($key, $valores);
        }
        return $this->usuarioDao->editar($usuario);
    }

    public function atualizarStatus($id, $ativo): bool
    {
        return $this->usuarioDao->atualizarStatus($id, $ativo);
    }
}
