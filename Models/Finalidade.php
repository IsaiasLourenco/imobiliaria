<?php

namespace App\Models;

class Finalidade
{

    private int $id;
    private string $descricao;

    public function __construct(int $id = 0, string $descricao = "")
    {
        $this->id = $id;
        $this->descricao = $descricao;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setId($id)
    {
        return $this->id = $id;
    }

    public function setDescricao($descricao)
    {
        return $this->descricao = $descricao;
    }

    public function __set($chave, $valor): void
    {
        if (property_exists($this, $chave)) {
            $this->$chave = $valor;
        }
    }

    public function atributosPreenchidos()
{
    $atributos = [];

    if (!empty($this->descricao)) {
        $atributos['descricao'] = $this->descricao;
    }

    return $atributos;
}

}
