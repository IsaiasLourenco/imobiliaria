<?php

namespace App\Models;

class Imovel
{
    private $id;
    private $codigo;
    private $valor;
    private $cep;
    private $logradouro;
    private $numero;
    private $complemento;
    private $bairro;
    private $cidade;
    private $estado;
    private $quartos;
    private $banheiros;
    private $garagem;
    private $imagemcapa;
    private $areatotal;
    private $areaconstruida;
    private $statusimovel;
    private $datacadastro;
    private $tipoimovel;
    private $finalidade;
    private $proprietario;

    public function __construct(
        ?int $id = 0,
        ?string $codigo = '',
        ?string $valor = '',
        ?string $cep = '',
        ?string $logradouro = '',
        ?string $numero = '',
        ?string $complemento = '',
        ?string $bairro = '',
        ?string $cidade = '',
        ?string $estado = '',
        ?string $quartos = '',
        ?string $banheiros = '',
        ?string $garagem = '',
        ?string $imagemcapa = '',
        ?string $areatotal = '',
        ?string $areaconstruida = '',
        ?string $statusimovel = '',
        ?string $datacadastro = '',
        ?string $tipoimovel = '',
        ?string $finalidade = '',
        ?string $proprietario = '',
    ) {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->valor = $valor;
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->complemento = $complemento;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->quartos = $quartos;
        $this->banheiros = $banheiros;
        $this->garagem = $garagem;
        $this->imagemcapa = $imagemcapa;
        $this->areatotal = $areatotal;
        $this->areaconstruida = $areaconstruida;
        $this->statusimovel = $statusimovel;
        $this->datacadastro = $datacadastro;
        $this->tipoimovel = $tipoimovel;
        $this->finalidade = $finalidade;
        $this->proprietario = $proprietario;
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
            'codigo' => $this->codigo,
            'valor' => $this->valor,
            'cep' => $this->cep,
            'logradouro' => $this->logradouro,
            'numero' => $this->numero,
            'complemento' => $this->complemento,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'quartos' => $this->quartos,
            'banheiros' => $this->banheiros,
            'garagem' => $this->garagem,
            'imagemcapa' => $this->imagemcapa,
            'areatotal' => $this->areatotal,
            'areaconstruida' => $this->areaconstruida,
            'statusimovel' => $this->statusimovel,
            'datacadastro' => $this->datacadastro,
            'tipoimovel' => $this->tipoimovel,
            'finalidade' => $this->finalidade,
            'proprietario' => $this->proprietario,
        ];
    }

    public function atributosPreenchidos(): array
    {
        return $this->toArray(); // sem filtro nenhum
    }
}
