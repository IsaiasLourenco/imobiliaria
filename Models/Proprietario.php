<?php

namespace App\Models;

class Proprietario
{
    private int $id;
    private string $nome;
    private string $contato;
    private string $cep;
    private string $logradouro;
    private string $numero;
    private string $bairro;
    private string $cidade;
    private string $estado;
    private string $sexo;
    private string $ativo;

    public function __construct(?int $id = null, 
                                ?string $nome = null, 
                                ?string $contato = null,
                                ?string $cep = null,
                                ?string $logradouro = null,
                                ?string $numero = null,
                                ?string $bairro = null,
                                ?string $cidade = null,
                                ?string $estado = null,
                                ?string $sexo = null,
                                ?string $ativo = null)
    {
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

    public function getId(): int {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function __set($chave, $valor): void {
        if (property_exists(object_or_class: $this, property: $chave)) {
            $this->$chave = $valor;
        }
    }

    public function toArray(): array {
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

    public function atributosPreenchidos(): array {
        return array_filter(array: $this->toArray(), callback: fn($value): bool => $value !== null && $value !=='');
    }
}
