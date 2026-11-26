<?php
    session_start();
    include '../crud/conectaBD.php';

    $idUsuario = $_SESSION['idUsuario'];
    $userNovo = $_POST['username'];

    //sql para inserir no banco
    $sql = "UPDATE jogador SET username = '$userNovo' 
            WHERE id = $idUsuario";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['msg'] = "Nome de usuário atualizado.";
        header("Location: configuracoes/configUserAMA.php");
        exit();
    } else {
        $_SESSION['erro'] = "Ocorreu um erro: " . mysqli_error($conexao);
        header("Location: configuracoes/configUserAMA.php");
        exit();
    }
?>