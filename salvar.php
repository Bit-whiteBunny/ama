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
    $_SESSION['erro'] = "Esse usuário já existe.";
    header("Location: cadastro.php");
    exit();
} else {
    //sql para inserir no banco
    $sql = "INSERT INTO jogador (email, senha, username)
            VALUES ('$email', '$senha', '$username')";

    if (mysqli_query($conexao, $sql)) {
        $sql = "SELECT id FROM jogador WHERE username = '$username'";
        $resultado = mysqli_query($conexao, $sql);
        $tupla = mysqli_fetch_assoc($resultado);
        $_SESSION['idUsuario'] = $tupla['id'];

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