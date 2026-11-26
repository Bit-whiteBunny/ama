<?php
session_start();
include('crud/conectaBD.php');

$username = $_POST['username'];
$email = $_POST['email'];
$senha = $_POST['senha'];

//Verificar se o usuário já está cadastrado no banco de dados
$sqlVerifica = "SELECT id FROM jogador WHERE username = '$username' LIMIT 1";
$verificacao = $conexao->prepare($sqlVerifica);
$verificacao->execute();
$verificacao->store_result();

if ($verificacao->num_rows > 0) {
    $_SESSION['usuarioExiste'] = "Esse usuário já existe.";
    header("Location: cadastro.php");
    exit();
} else {
    //sql para inserir no banco
    $sql = "INSERT INTO jogador (email, senha, username)
            VALUES ('$email', '$senha', '$username')";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['msg'] = "Cadastro enviado";
        header("Location: cadastro.php");
        exit();
    } else {
        $_SESSION['erro'] = "Ocorreu um erro: " . mysqli_error($conexao);
        header("Location: cadastro.php");
        exit();
    }
}
?>
