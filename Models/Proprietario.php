<?php

namespace App\Models;

class Proprietario
{
    private $id;
    private $nome;
    private $contato;
    private $cep;
    private $logradouro;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;
    private $sexo;
    private $ativo;

    public function __construct(
        ?int $id = 0,
        ?string $nome = '',
        ?string $contato = '',
        ?string $cep = '',
        ?string $logradouro = '',
        ?string $numero = '',
        ?string $bairro = '',
        ?string $cidade = '',
        ?string $estado = '',
        ?string $sexo = '',
        ?string $ativo = ''
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->contato = $contato;
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->sexo = $sexo;
        $this->ativo = $ativo;
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
            'nome' => $this->nome,
            'contato' => $this->contato,
            'cep' => $this->cep,
            'logradouro' => $this->logradouro,
            'numero' => $this->numero,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'sexo' => $this->sexo,
            'ativo' => $this->ativo
        ];
    }

    public function atributosPreenchidos(): array
    {
        return $this->toArray(); // sem filtro nenhum
    }
}
