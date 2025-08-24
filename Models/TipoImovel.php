<?php

namespace App\Models;

class TipoImovel
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

    // public function setId(int $id): void
    // {
    //     $this->id = $id;
    // }

    // public function setDescricao(string $descricao): void
    // {
    //     $this->descricao = $descricao;
    // }


    public function setId($id)
    {
        return $this->id = $id;
    }

    public function setDescricao($descricao)
    {
        return $this->descricao = $descricao;
    }

    public function atributosPreenchidos()
    {
        $atributos = [];

        if (!empty($this->descricao)) {
            $atributos['descricao'] = $this->descricao;
        }

        // Se quiser incluir o ID (geralmente no update, não no insert)
        if (!empty($this->id)) {
            $atributos['id'] = $this->id;
        }

        return $atributos;
    }
}
