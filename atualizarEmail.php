<?php
    session_start();
    include '../crud/conectaBD.php';

    $idUsuario = $_SESSION['idUsuario'];
    $emailNovo = $_POST['email'];

    //sql para inserir no banco
    $sql = "UPDATE jogador SET email = '$emailNovo' 
            WHERE id = $idUsuario";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['emailAtualizado'] = "Email atualizado.";
        header("Location: configUserAMA.php");
        exit();
    } else {
        $_SESSION['erroBD'] = "Ocorreu um erro: " . mysqli_error($conexao);
        header("Location: configUserAMA.php");
        exit();
    }
?>