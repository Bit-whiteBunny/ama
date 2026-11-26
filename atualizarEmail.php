<?php
    session_start();
    include '../crud/conectaBD.php';

    $idUsuario = $_SESSION['idUsuario'];
    $emailNovo = $_POST['email'];

    //sql para inserir no banco
    $sql = "UPDATE jogador SET email = '$emailNovo' 
            WHERE id = $idUsuario";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['msg'] = "Email atualizado.";
        header("Location: configuracoes/configUserAMA.php");
        exit();
    } else {
        $_SESSION['erro'] = "Ocorreu um erro: " . mysqli_error($conexao);
        header("Location: configuracoes/configUserAMA.php");
        exit();
    }
?>