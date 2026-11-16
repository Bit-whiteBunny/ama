<?php
    session_start();
    include '../conecta.php';

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];
    $endereco = $_POST['endereco'];

    if (empty($nome) || empty($data_nascimento)) {
        $_SESSION['erro'] = "Nome e data de nascimento são obrigatórios.";
        header("Location: criar.php");
        exit();
    }

    //sql para inserir no banco
    $sql = "INSERT INTO aluno (nome, data_nascimento, cpf, endereco)
            VALUES ('$nome', '$data_nascimento', '$cpf', '$endereco')";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['msg'] = "Aluno cadastrado com sucesso.";
        header("Location: criar.php");
    } else {
        $_SESSION['erro'] = "Ocorreu um erro: " . mysqli_error($conexao);
        header("Location: criar.php");
    }

    mysqli_close($conexao);
?>