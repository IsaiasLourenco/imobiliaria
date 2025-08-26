<?php

namespace App\Models;

class Contato
{
    private $id;
    private $datamensagem;
    private $nome;
    private $email;
    private $telefone;
    private $motivo;
    private $mensagem;

    public function __construct(
        ?int $id = 0,
        ?string $datamensagem = '',
        ?string $nome = '',
        ?string $email = '',
        ?string $telefone = '',
        ?string $motivo = '',
        ?string $mensagem = '',
    ) {
        $this->id = $id;
        $this->datamensagem = !empty($datamensagem) ? $datamensagem : date('Y-m-d');
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->motivo = $motivo;
        $this->mensagem = $mensagem;
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
            'datamensagem' => $this->datamensagem,
            'nome' => $this->nome,
            'email' => $this->email,
            'telefone' => $this->telefone,
            'motivo' => $this->motivo,
            'mensagem' => $this->mensagem,
        ];
    }

    public function atributosPreenchidos(): array
    {
        return $this->toArray(); // sem filtro nenhum
    }
}
