<?php
    session_start();
    include '../crud/conectaBD.php';

    $idUsuario = $_SESSION['idUsuario'];
    $senhaNova = $_POST['senha'];

    //sql para inserir no banco
    $sql = "UPDATE jogador SET senha = '$senhaNova' 
            WHERE id = $idUsuario";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['senhaAtualizada'] = "Senha atualizada.";
        header("Location: configUserAMA.php");
        exit();
    } else {
        $_SESSION['erroBD'] = "Ocorreu um erro: " . mysqli_error($conexao);
        header("Location: configUserAMA.php");
        exit();
    }
?>