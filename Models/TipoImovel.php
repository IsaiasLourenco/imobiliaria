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


    public function setId($id)
    {
        return $this->id = $id;
    }

    public function setDescricao($descricao)
    {
        return $this->descricao = $descricao;
    }

    public function atributosPreenchidos($modo = 'insert')
    {
        $atributos = [];

        if ($modo === 'update') {
            $atributos['descricao'] = $this->descricao;
            if (!empty($this->id)) {
                $atributos['id'] = $this->id;
            }
        } else {
            if (!empty($this->descricao)) {
                $atributos['descricao'] = $this->descricao;
            }
        }

        return $atributos;
    }
}
