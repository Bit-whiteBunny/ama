<?php
    session_start();
    include('conecta.php');

    $idUsuario = $_SESSION['id'];

    //sql para excluir registro no banco
    $sql = "DELETE FROM jogador WHERE id='$idUsuario'";

    if (mysqli_query($conexao, $sql)) {
        session_unset();
        $_SESSION['contaExcluida'] = "Conta excluída com sucesso.";
        header("Location: ../configuracoes/configUserAMA.php");
        exit();
    } else {
        $_SESSION['erro'] = "Ocorreu um erro: " . mysqli_error($conexao);
        header("Location: ../configuracoes/configUserAMA.php");
        exit();
    }
?>