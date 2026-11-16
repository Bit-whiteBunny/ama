<?php
    session_start();
    include '../conecta.php';

    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if (empty($id)) {
        $_SESSION['erro'] = "ID do aluno não fornecido.";
        header("Location: lista.php");
        exit();
    }

    //sql para excluir registro no banco
    $sql = "DELETE FROM aluno WHERE id=$id";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['msg'] = "Aluno excluído com sucesso.";
        header("Location: lista.php");
    } else {
        $_SESSION['erro'] = "Ocorreu um erro: " . mysqli_error($conexao);
        header("Location: lista.php");
    }

    mysqli_close($conexao);
?>