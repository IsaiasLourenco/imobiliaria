<?php

namespace App\Models\Dao;

use App\Models\Conexao;
use App\Models\Imovel;
use Pdo;

class ImovelDao extends Conexao
{
    // Lista todos os imóveis
    public function listarTodos(): array
    {
        $dados = $this->listar("imovel");
        $imoveis = [];
        foreach ($dados as $row) {
            $imoveis[] = $this->mapToImovel((array)$row); // <-- converte stdClass em array
        }
        return $imoveis;
    }

    // Busca um único imóvel por ID
    // public function buscarUnicoImovelPorId($id): ?Imovel
    // {
    //     $dados = $this->listar("imovel", "WHERE id = ?", [$id]);
    //     if (!$dados || count($dados) === 0) {
    //         return null;
    //     }
    //     return $this->mapToImovel((array)$dados[0]); // <-- converte stdClass em array
    // }
    public function buscarUnicoImovelPorId($id): ?Imovel
    {
        $query = "SELECT 
        imovel.*, 
        f.descricao AS finalidade_descricao
    FROM imovel
    LEFT JOIN finalidade f ON imovel.finalidade = f.id
    WHERE imovel.id = ?";

        $stmt = $this->executarConsulta($query, [$id]);

        if (!$stmt) {
            return null;
        }

        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (!$dados || count($dados) === 0) {
            return null;
        }

        return $this->mapToImovel((array)$dados[0]);
    }

    // Adiciona um imóvel
    public function adicionar(Imovel $imovel)
    {
        $atributos = array_keys($imovel->atributosPreenchidos());
        $valores = array_values($imovel->atributosPreenchidos());
        return $this->inserir('imovel', $atributos, $valores);
    }

    // Edita um imóvel
    public function editar(Imovel $imovel)
    {
        $atributos = array_keys($imovel->atributosPreenchidos());
        $valores = array_values($imovel->atributosPreenchidos());
        try {
            // return $this->update('imovel', $atributos, $valores, $imovel->getId());
            return $this->update('imovel', $atributos, $valores, $imovel->getId()) !== false;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar imóvel: " . $e->getMessage());
        }
    }

    // Apaga um imóvel
    public function apagar($id)
    {
        return $this->deletar('imovel', $id);
    }

    // Atualiza apenas o status do imóvel
    public function atualizarStatusImovel($id, $statusId)
    {
        $sql = "UPDATE imovel SET statusimovel = :statusId WHERE id = :id";
        $stmt = self::getConexao()->prepare($sql);
        $stmt->bindParam(':statusId', $statusId);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Helper para mapear array de DB para objeto Imovel
    private function mapToImovel(array $row): Imovel
    {
        return new Imovel(
            $row['id'] ?? 0,
            $row['codigo'] ?? '',
            $row['valor'] ?? 0,
            $row['cep'] ?? '',
            $row['logradouro'] ?? '',
            $row['numero'] ?? '',
            $row['complemento'] ?? '',
            $row['bairro'] ?? '',
            $row['cidade'] ?? '',
            $row['estado'] ?? '',
            $row['quartos'] ?? 0,
            $row['banheiros'] ?? 0,
            $row['garagem'] ?? 0,
            $row['imagemcapa'] ?? 'sem-foto.jpg',
            $row['areatotal'] ?? 0,
            $row['areaconstruida'] ?? 0,
            $row['statusimovel'] ?? null,
            $row['datacadastro'] ?? date('Y-m-d H:i:s'),
            $row['tipoimovel'] ?? null,
            $row['finalidade'] ?? null,
            $row['proprietario'] ?? null,
            $row['finalidade_descricao'] ?? ''
        );
    }

    public function buscarUltimoCodigoPorPrefixo($prefixo)
    {
        $pdo = self::getConexao(); // pega a conexão PDO
        $stmt = $pdo->prepare("SELECT codigo FROM imovel WHERE codigo LIKE :prefixo ORDER BY codigo DESC LIMIT 1");
        $stmt->execute(['prefixo' => $prefixo . '%']);
        return $stmt->fetchColumn(); // retorna a string do último código, ex: MgSP007
    }

    public function listarImoveisComFinalidade()
    {
        $query = "SELECT imovel.*, f.descricao AS finalidade_descricao 
              FROM imovel imovel 
              LEFT JOIN finalidade f ON imovel.finalidade = f.id";

        // Executando a consulta
        $stmt = $this->executarConsulta($query);

        // Verificando se a consulta foi executada corretamente
        if (!$stmt) {
            echo "Erro ao executar a consulta";
            exit();
        }

        // Verifique se a consulta retornou os dados
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Se a consulta estiver correta e os dados foram retornados, continue com o mapeamento
        $imoveis = [];
        foreach ($dados as $row) {
            $imoveis[] = $this->mapToImovel($row); // Mapeando para Imovel
        }

        return $imoveis;
    }
}
