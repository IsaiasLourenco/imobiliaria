<?php

namespace App\Models;

class Usuario
{
    private $id;
    private $nome;
    private $usuario;
    private $senha;
    private $perfil;
    private $email;
    private $telefone;
    private $cep;
    private $logradouro;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;
    private $imagem;
    private $datacadastro;
    private $ativo;

    public function __construct(
        ?int $id = 0,
        ?string $nome = '',
        ?string $usuario = '',
        ?string $senha = '',
        ?string $perfil = '',
        ?string $email = '',
        ?string $telefone = '',
        ?string $cep = '',
        ?string $logradouro = '',
        ?string $numero = '',
        ?string $bairro = '',
        ?string $cidade = '',
        ?string $estado = '',
        ?string $imagem = '',
        ?string $datacadastro = '',
        ?string $ativo = ''
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->perfil = $perfil;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->imagem = $imagem;
        $this->datacadastro = !empty($datacadastro) ? $datacadastro : date('Y-m-d H:i:s');
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
            'usuario' => $this->usuario,
            'senha' => $this->senha,
            'perfil' => $this->perfil,
            'email' => $this->email,
            'telefone' => $this->telefone,
            'cep' => $this->cep,
            'logradouro' => $this->logradouro,
            'numero' => $this->numero,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'imagem' => $this->imagem,
            'datacadastro' => $this->datacadastro,
            'ativo' => $this->ativo
        ];
    }
    
    public function atributosPreenchidos(): array
    {
        return $this->toArray(); // sem filtro nenhum
    }
}
