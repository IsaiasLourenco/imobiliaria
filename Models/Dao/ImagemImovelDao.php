<?php

namespace App\Models\Dao;

use App\Models\Conexao;

class ImagemImovelDao extends Conexao
{
    // Buscar todas as imagens de um imóvel
    public function buscarPorImovel($id)
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=imobiliaria', 'root', '');
        $stmt = $pdo->prepare("SELECT imagem FROM imagemimovel WHERE imovel = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    // Inserir uma imagem na galeria de um imóvel
    public function inserirImagem($dados)
    {
        $sql = "INSERT INTO imagemimovel (imagem, imovel) VALUES (:imagem, :imovel)";
        $stmt = self::getConexao()->prepare($sql);
        $stmt->bindValue(':imagem', $dados['imagem']);
        $stmt->bindValue(':imovel', $dados['imovel']);
        return $stmt->execute();
    }

    // Buscar galeria de imagens de um imóvel
    public function buscarGaleriaPorImovel($id)
    {
        $sql = "SELECT id, imagem FROM imagemimovel WHERE imovel = :id";
        $stmt = self::getConexao()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    // Excluir uma imagem do banco de dados
    public function deletarImagem($imagem)
    {
        $sql = "DELETE FROM imagemimovel WHERE imagem = :imagem";
        $stmt = self::getConexao()->prepare($sql);
        $stmt->bindValue(':imagem', $imagem);
        return $stmt->execute();
    }

    // Buscar uma imagem pelo ID
    public function buscarImagemPorId($imagemId)
    {
        $sql = "SELECT * FROM imagemimovel WHERE id = :id";
        $stmt = self::getConexao()->prepare($sql);
        $stmt->bindValue(':id', $imagemId);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_OBJ); // Retorna a imagem com todos os detalhes
    }
}
