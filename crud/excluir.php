<?php
    session_start();
    include('conecta.php');

    $usuario = isset($_GET['usuario']) ? $_GET['usuario'] : null;

    if (empty($id)) {
        $_SESSION['erro'] = "ID do aluno não fornecido.";
        header("Location: ../configuracoes/configUserAMA.php");
        exit();
    }

    //sql para excluir registro no banco
    $sql = "DELETE FROM jogador WHERE username=$usuario";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['contaExcluida'] = "Conta excluída com sucesso.";
        header("Location: ../configuracoes/configUserAMA.php");
        exit();
    } else {
        $_SESSION['erro'] = "Ocorreu um erro: " . mysqli_error($conexao);
        header("Location: ../configuracoes/configUserAMA.php");
        exit();
    }
?>