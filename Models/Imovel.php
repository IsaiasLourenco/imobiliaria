<?php

namespace App\Models;

class Imovel
{
    public $id;
    public $codigo;
    public $valor;
    public $cep;
    public $logradouro;
    public $numero;
    public $complemento;
    public $bairro;
    public $cidade;
    public $estado;
    public $quartos;
    public $banheiros;
    public $garagem;
    public $imagemcapa;
    public $areatotal;
    public $areaconstruida;
    public $statusimovel;
    public $datacadastro;
    public $tipoimovel;
    public $finalidade;
    public $proprietario;
    public $finalidade_descricao;

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
        ?string $finalidade_descricao = '',
    ) {
        date_default_timezone_set(timezoneId: 'America/Sao_Paulo');
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
        $this->datacadastro = $datacadastro ?? date('Y-m-d H:i:s');
        $this->tipoimovel = $tipoimovel;
        $this->finalidade = $finalidade;
        $this->proprietario = $proprietario;
        $this->finalidade_descricao = $finalidade_descricao;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getFinalidadeDescricao()
    {
        return $this->finalidade_descricao;
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
            'finalidade_descricao' => $this->finalidade_descricao,
        ];
    }

    public function atributosPreenchidos(): array
    {
        $dados = $this->toArray();
        unset($dados['finalidade_descricao']); // remove campo que não existe no banco
        return $dados;
    }
}
