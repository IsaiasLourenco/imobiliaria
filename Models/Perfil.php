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

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function __set($chave, $valor): void
    {
        if (property_exists($this, $chave)) {
            $this->$chave = $valor;
        }
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'descricao' => $this->descricao
        ];
    }

    public function atributosPreenchidos(): array
    {
        return $this->toArray(); // sem filtro nenhum
    }
}
