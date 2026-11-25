<?php
    session_start();
    include 'crud/conecta.php';

    $idUsuario = $_SESSION['idUsuario'];
    $senhaNova = $_POST['senha'];

    //sql para inserir no banco
    $sql = "UPDATE jogador SET username = '$senhaNova' 
            WHERE id = $idUsuario";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['senhaAtualizada'] = "Senha atualizada.";
        header("Location: lista.php");
        exit();
    } else {
        $_SESSION['erro'] = "Ocorreu um erro: " . mysqli_error($conexao);
        header("Location: criar.php");
        exit();
    }
?>