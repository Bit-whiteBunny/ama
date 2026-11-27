<?php
    session_start();
    include('../crud/conectaBD.php');

    $idUsuario = $_SESSION['idUsuario'];

    //sql para excluir registro no banco
    $sql = "DELETE FROM jogador WHERE id='$idUsuario'";

    if (mysqli_query($conexao, $sql)) {
        header("Location: ../configuracoes/configUserAMA.php");
        session_unset();
        exit();
    } else {
        $_SESSION['erro'] = "Ocorreu um erro: " . mysqli_error($conexao);
        header("Location: ../configuracoes/configUserAMA.php");
        exit();
    }
?>