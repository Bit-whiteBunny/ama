<?php
    session_start();
    include 'crud/conecta.php';

    $idUsuario = $_SESSION['idUsuario'];
    $emailNovo = $_POST['email'];

    //sql para inserir no banco
    $sql = "UPDATE jogador SET email = '$emailNovo' 
            WHERE id = $idUsuario";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['emailAtualizado'] = "Email atualizado.";
        header("Location: lista.php");
        exit();
    } else {
        $_SESSION['erro'] = "Ocorreu um erro: " . mysqli_error($conexao);
        header("Location: criar.php");
        exit();
    }
?>