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
    private $complemento;
    private $bairro;
    private $cidade;
    private $estado;
    private $imagem;
    private $datacadastro;
    private $ativo;

    public function __construct(
        $id = 0,
        $nome = '',
        $usuario = '',
        $senha = '',
        $perfil = '',
        $email = '',
        $telefone = '',
        $cep = '',
        $logradouro = '',
        $numero = '',
        $complemento = '',
        $bairro = '',
        $cidade = '',
        $estado = '',
        $imagem = '',
        $datacadastro = '',
        $ativo = ''
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
        $this->complemento = $complemento;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->imagem = $imagem;
        $this->datacadastro = !empty($datacadastro) ? $datacadastro : date('Y-m-d H:i:s');
        $this->ativo = $ativo;
    }

    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getUsuario() { return $this->usuario; }
    public function getSenha() { return $this->senha; }
    public function getPerfil() { return $this->perfil; }
    public function getEmail() { return $this->email; }
    public function getTelefone() { return $this->telefone; }
    public function getCep() { return $this->cep; }
    public function getLogradouro() { return $this->logradouro; }
    public function getNumero() { return $this->numero; }
    public function getComplemento() { return $this->complemento; }
    public function getBairro() { return $this->bairro; }
    public function getCidade() { return $this->cidade; }
    public function getEstado() { return $this->estado; }
    public function getImagem() { return $this->imagem; }
    public function getDatacadastro() { return $this->datacadastro; }
    public function getAtivo() { return $this->ativo; }

    public function setId($id) { $this->id = $id; }

    public function __set($chave, $valor)
    {
        if (property_exists($this, $chave)) {
            $this->$chave = $valor;
        }
    }

    public function toArray()
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
            'complemento' => $this->complemento,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'imagem' => $this->imagem,
            'datacadastro' => $this->datacadastro,
            'ativo' => $this->ativo
        ];
    }

    public function atributosPreenchidos()
    {
        return $this->toArray();
    }
}