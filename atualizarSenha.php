<?php
    session_start();
    include '../crud/conectaBD.php';

    $idUsuario = $_SESSION['idUsuario'];
    $senhaNova = $_POST['senha'];

    //sql para inserir no banco
    $sql = "UPDATE jogador SET senha = '$senhaNova' 
            WHERE id = $idUsuario";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['msg'] = "Senha atualizada.";
        header("Location: configuracoes/configUserAMA.php");
        exit();
    } else {
        $_SESSION['erro'] = "Ocorreu um erro: " . mysqli_error($conexao);
        header("Location: configuracoes/configUserAMA.php");
        exit();
    }
?>