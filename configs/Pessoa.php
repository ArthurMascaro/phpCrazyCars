<?php

require_once "BancoDados.php";

class Pessoa
{

    public static function cadastrar($nome, $login, $senha)
    {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("INSERT INTO pessoas (nome, login, senha) VALUES (?, ?, ?)");
            $sql->bindParam(1, $nome);
            $sql->bindParam(2, $login);
            $sql->bindParam(3, $senha);
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
            $sql = $conexao->prepare("SELECT * FROM pessoas order by nome");
            $sql->execute();
            return $sql->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function existe($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("SELECT count(*) FROM pessoas WHERE id = ?");
            $sql->bindParam(1, $id);
            $sql->execute();
            $quantidade = $sql->fetchColumn();
            if ($quantidade > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function existeEmail($email)
    {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("SELECT count(*) FROM pessoas WHERE login = ?");
            $sql->bindParam(1, $email);
            $sql->execute();
            $quantidade = $sql->fetchColumn();
            if ($quantidade <= 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function getPessoa($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("SELECT * FROM pessoas WHERE id = ?");
            $sql->execute([$id]);
            return $sql->fetchAll()[0];
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function editar($nome, $login, $senha, $id)
    {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("UPDATE pessoas SET nome = ?, login = ?, senha = ? WHERE id = ?");
            $sql->execute([$nome, $login, $senha, $id]);
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

    public static function excluir($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("DELETE from pessoas where id = ?");
            $sql->execute([$id]);
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
}