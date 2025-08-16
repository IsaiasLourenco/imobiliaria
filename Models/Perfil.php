<?php

namespace App\Models;

class Perfil
{
    private $id;
    private $descricao;

    public function __construct(
        ?int $id = 0,
        ?string $descricao = ''
    ) {
        $this->id = $id;
        $this->descricao = $descricao;
    }

    public function getId(): int
    {
        return $this->id;
    }
    
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }
    
    public function setDescricao($descricao): void
    {
        $this->descricao = $descricao;
    }

}
