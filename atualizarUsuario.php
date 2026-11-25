<?php
    session_start();
    include '../crud/conectaBD.php';

    $idUsuario = $_SESSION['idUsuario'];
    $userNovo = $_POST['username'];

    //sql para inserir no banco
    $sql = "UPDATE jogador SET username = '$userNovo' 
            WHERE id = $idUsuario";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['userAtualizado'] = "Nome de usuário atualizado.";
        header("Location: configUserAMA.php");
        exit();
    } else {
        $_SESSION['erroBD'] = "Ocorreu um erro: " . mysqli_error($conexao);
        header("Location: configUserAMA.php");
        exit();
    }
?>