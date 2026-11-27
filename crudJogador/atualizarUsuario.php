<?php
session_start();
include '../crud/conectaBD.php';

$idUsuario = $_SESSION['idUsuario'];
$userNovo = $_POST['username'];

//sql para inserir no banco
$sqlVerifica = "SELECT id FROM jogador WHERE username = '$userNovo' LIMIT 1";
$verificacao = $conexao->prepare($sqlVerifica);
$verificacao->execute();
$verificacao->store_result();

if ($verificacao->num_rows > 0) {
    $_SESSION['erro'] = "Esse usuário já existe.";
    header("Location: ../configuracoes/configUserAMA.php");
    exit();
} else {
    $sql = "UPDATE jogador SET username = '$userNovo' 
            WHERE id = $idUsuario";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['msg'] = "Nome de usuário atualizado.";
        header("Location: ../configuracoes/configUserAMA.php");
        exit();
    } else {
        $_SESSION['erro'] = "Ocorreu um erro: " . mysqli_error($conexao);
        header("Location: ../configuracoes/configUserAMA.php");
        exit();
    }
}
?>