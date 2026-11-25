<?php
session_start();
include('crud/conecta.php');

$usuarioInserido = $_POST['username'];
$senhaInserida = $_POST['senha'];

//Verificar se o usuário já está cadastrado no banco de dados
$sqlVerifica = "SELECT id, email, username FROM jogador WHERE username = '$usuarioInserido' AND senha = '$senhaInserida' LIMIT 1";
$verificacao = $conexao->prepare($sqlVerifica);
$verificacao->execute();
$verificacao->store_result();

if ($verificacao->num_rows > 0) {
    $verificacao->fetch_assoc();

    $_SESSION['idUsuario'] = $verificacao['id'];
    $_SESSION['email'] = $verificacao['email'];
    $_SESSION['username'] = $verificacao['usuario'];

    $_SESSION['msg'] = "Login enviado";
    header("Location: index.php");
    exit();
} else {
    $_SESSION['usuarioInvalido'] = "Usuário ou senha incorretos.";
    header("Location: index.php");
    exit();
}
?>