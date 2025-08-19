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

    public function cadastrarUsuario($dados, $imagem)
    {
        $usuario = new Usuario();
        $dados['imagem'] = $imagem;

        // se não vier do formulário, seta como ativo = 1
        $dados['ativo'] = isset($dados['ativo']) ? (int)$dados['ativo'] : 1;

        foreach ($dados as $key => $valores) {
            if ($key == 'senha') {
                $valores = password_hash($valores, PASSWORD_BCRYPT);
            }
            $usuario->__set($key, $valores);
        }
        return $this->usuarioDao->adicionar($usuario);
    }


    public function editarUsuario($dados, $imagem)
    {
        $usuario = new Usuario();
        $dados['imagem'] = $imagem;
        foreach ($dados as $key => $valores) {
            if ($key == 'senha') {
                $valores = password_hash($valores, PASSWORD_BCRYPT);
            }
            $usuario->__set($key, $valores);
        }
        return $this->usuarioDao->editar($usuario);
    }

    public function atualizarStatus($id, $ativo)
    {
        return $this->usuarioDao->atualizarStatus((int)$id, (int)$ativo);
    }
}
