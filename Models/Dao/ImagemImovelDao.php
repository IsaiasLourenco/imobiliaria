<?php

namespace App\Models\Dao;

use App\Models\Conexao;

class ImagemImovelDao extends Conexao
{
    public function buscarPorImovel($id)
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=imobiliaria', 'root', '');
        $stmt = $pdo->prepare("SELECT imagem FROM imagemimovel WHERE imovel = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function inserirImagem($dados)
    {
        $sql = "INSERT INTO imagemimovel (imagem, imovel) VALUES (:imagem, :imovel)";
        $stmt = self::getConexao()->prepare($sql);
        $stmt->bindValue(':imagem', $dados['imagem']);
        $stmt->bindValue(':imovel', $dados['imovel']);
        return $stmt->execute();
    }

    public function buscarGaleriaPorImovel($id)
    {
        $sql = "SELECT imagem FROM imagemimovel WHERE imovel = :id";
        $stmt = self::getConexao()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }
}
