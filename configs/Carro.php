<?php

require_once "BancoDados.php";

class Carro
{

    public static function cadastrar($nome, $marca, $ano, $idPessoa)
    {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("INSERT INTO carros (nome, marca, ano, idPessoa) VALUES (?, ?, ?, ?)");
            $sql->bindParam(1, $nome);
            $sql->bindParam(2, $marca);
            $sql->bindParam(3, $ano);
            $sql->bindParam(4, $idPessoa);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function listar()
    {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("SELECT c.id, c.nome, c.marca, c.ano, p.nome as nomePessoa FROM carros c JOIN pessoas p ON c.idPessoa = p.id order by id");
            $sql->execute();
            return $sql->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}