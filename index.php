<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Carros</title>
</head>

<body>

    <?php

    require_once "./configs/Pessoa.php";
    require_once "./configs/Carro.php";

    if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        if (isset($_POST['login']) && !empty($_POST['login'])) {
            if (isset($_POST['senha']) && !empty($_POST['senha'])) {
                $nome = $_POST['nome'];
                $login = $_POST['login'];
                $senha = $_POST['senha'];
                if (Pessoa::existeEmail($login)) {
                    $resultado = Pessoa::cadastrar($nome, $login, $senha);
                    if ($resultado) {
                        echo "<p> $nome cadastrado com sucesso </p>";
                    } else {
                        echo "<p> Erro ao cadastrar $nome </p>";
                    }
                } else {
                    echo "já existe uma pessoa com este Email";
                }
            }
        }
    }

    if (isset($_POST['nomeCarro']) && !empty($_POST['nomeCarro'])) {
        if (isset($_POST['marcaCarro']) && !empty($_POST['marcaCarro'])) {
            if (isset($_POST['anoCarro']) && !empty($_POST['anoCarro'])) {
                if (isset($_POST['idPessoa']) && !empty($_POST['idPessoa'])) {
                    $nomeCarro = $_POST['nomeCarro'];
                    $marcaCarro = $_POST['marcaCarro'];
                    $anoCarro = $_POST['anoCarro'];
                    $idPessoa = $_POST['idPessoa'];
                    if (Pessoa::existe($idPessoa)) {
                        $resultado = Carro::cadastrar($nomeCarro, $marcaCarro, $anoCarro, $idPessoa);


                        if ($resultado) {
                            echo "<p> $nomeCarro cadastrado com sucesso </p>";
                        } else {
                            echo "<p> Erro ao cadastrar $nomeCarro </p>";
                        }
                    } else
                        echo "<p> Essa pessoa não existe </p>";
                }
            }
        }
    }

    if (isset($_GET['excluirPessoa']) && !empty($_GET['excluirPessoa'])) {
        $id = $_GET['excluirPessoa'];
        if (Pessoa::existe($id)) {
            $resultado = Pessoa::excluir($id);
            if ($resultado) {
                echo "<p> Pessoa excluída com sucesso </p>";
            } else {
                echo "<p> Erro ao excluir pessoa </p>";
            }
        } else {
            echo "<p> Essa pessoa não existe </p>";
        }
    }


    ?>
    <h1>Iae, veja Carros.</h1>

    <h2>Cadastre uma pessoa aqui:</h2>

    <form method="post">
        <p>Nome:</p>
        <input type="text" name="nome" required>
        <p>Login:</p>
        <input type="text" name="login" required>
        <p>Senha:</p>
        <input type="password" name="senha" required minlength="4">
        <br>
        <br>
        <button>Cadastrar</button>
    </form>

    <br>

    <h2> Cadastre um Carro: </h2>

    <form method="post">
        <p>Nome:</p>
        <input type="text" name="nomeCarro" required>
        <p>Marca:</p>
        <input type="text" name="marcaCarro" required>
        <p>Ano:</p>
        <input type="number" name="anoCarro" required>
        <p>Pessoa:</p>
        <select name="idPessoa">
            <?php
            $pessoas = Pessoa::listar();
            foreach ($pessoas as $pessoa) {
                echo "<option value='" . $pessoa['id'] . "'>" . $pessoa['nome'] . "</option>";
            }
            ?>
        </select>
        <br>
        <br>
        <button>Cadastrar</button>
    </form>

    <br>

    <hr>

    <h2>Lista de Pessoas:</h2>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Login</th>
                <th>Senha</th>
                <th>Alterar</th>
                <th>Deletar</th>
            </tr>
        </thead>
        <tbody>
            <?php

            require_once "./configs/Pessoa.php";
            $pessoas = Pessoa::listar();
            foreach ($pessoas as $pessoa) {
                echo "<tr>";
                echo "<td style='text-align: center'>"  . $pessoa["id"] . "</td>";
                echo "<td style='text-align: center'>" . $pessoa["nome"] . "</td>";
                echo "<td style='text-align: center'>" . $pessoa["login"] . "</td>";
                echo "<td style='text-align: center'>" . $pessoa["senha"] . "</td>";
                echo "<td style='text-align: center'>" . "<a href='editarPessoa.php?id=" . $pessoa["id"] . "'>Editar</a>" . "</td>";
                echo "<td style='text-align center'> <a href='index.php?excluirPessoa=$pessoa[id]'>Excluir</a> </td>";
                echo "</tr>";
            }

            ?>
        </tbody>
    </table>

    <br>
    <hr>

    <h2>Lista de Carros:</h2>
    <table>
        <thead>
            <tr>
                <th>IdCarro</th>
                <th>Nome</th>
                <th>Marca</th>
                <th>Ano</th>
                <th>NomePessoa</th>
            </tr>
        </thead>
        <tbody>
            <?php

            require_once "./configs/Carro.php";
            $carros = Carro::listar();
            foreach ($carros as $carro) {
                echo "<tr>";
                echo "<td style='text-align: center'>"  . $carro["id"] . "</td>";
                echo "<td style='text-align: center'>" . $carro["nome"] . "</td>";
                echo "<td style='text-align: center'>" . $carro["marca"] . "</td>";
                echo "<td style='text-align: center'>" . $carro["ano"] . "</td>";
                echo "<td style='text-align: center'>" . $carro["nomePessoa"] . "</td>";
                echo "</tr>";
            }




            ?>
        </tbody>
    </table>

</body>

</html>