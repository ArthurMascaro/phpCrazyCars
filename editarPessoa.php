<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pessoa</title>
</head>

<body>

    <?php

    require_once "./configs/Pessoa.php";

    if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        if (isset($_POST['login']) && !empty($_POST['login'])) {
            if (isset($_POST['senha']) && !empty($_POST['senha'])) {
                if (isset($_POST['id']) && !empty($_POST['id'])) {
                    $nome = $_POST['nome'];
                    $login = $_POST['login'];
                    $senha = $_POST['senha'];
                    $id = $_POST['id'];
                    $resultado = Pessoa::editar($nome, $login, $senha, $id);
                    if ($resultado) {
                        echo "<p> $nome editado com sucesso </p>";
                        echo '<a href="index.php">Voltar</a>';
                    } else {
                        echo "<p> Erro ao editar $nome </p>";
                        echo '<a href="index.php">Voltar</a>';
                    }
                    exit;
                }
            }
        }
    }

    if (isset($_GET['id']) and !empty($_GET['id'])) {
        if (Pessoa::existe($_GET['id'])) {
            $pessoa = Pessoa::getPessoa($_GET['id']);
        } else {
            echo '<h1> Pessoa não encontrada </h1>';
            echo "<a href='index.php'>Voltar</a>";
            exit;
        }
    } else {
        echo '<h1> Pessoa não encontrada </h1>';
        echo "<a href='index.php'>Voltar</a>";
        exit;
    }

    ?>

    <h1>Editar <?= $pessoa['nome'] ?></h1>


    <form method="post">
        <p>Nome:</p>
        <input type="text" name="nome" required value="<?= $pessoa['nome'] ?>">
        <p>Login:</p>
        <input type="text" name="login" required value="<?= $pessoa['login'] ?>">
        <p>Senha:</p>
        <input type="password" name="senha" required minlength="4" value="<?= $pessoa['senha'] ?>">
        <input type="hidden" name="id" value="<?= $pessoa['id'] ?>">
        <br>
        <br>
        <button>Editar</button>
    </form>

</body>

</html>