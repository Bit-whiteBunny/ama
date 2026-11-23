<?php
    session_start();
    include '../conecta.php';

    $id = $_POST['id'];
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
    $sql = "UPDATE aluno SET nome = '$nome', 
                data_nascimento = '$data_nascimento', 
                cpf = '$cpf', 
                endereco = '$endereco' 
            WHERE id = $id";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['msg'] = "Aluno atualizado com sucesso.";
        header("Location: lista.php");
    } else {
        $_SESSION['erro'] = "Ocorreu um erro: " . mysqli_error($conexao);
        header("Location: criar.php");
    }

    mysqli_close($conexao);
?>