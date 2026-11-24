<?php
session_start();
include('conecta.php');

$usuarioInserido = $_POST['usuario'];
$senhaInserida = $_POST['senha'];

//Verificar se o usuário já está cadastrado no banco de dados
$sqlVerifica = "SELECT id, email, username FROM jogador WHERE username = '$usuarioInserido' AND senha = '$senhaInserida' LIMIT 1";
$verificacao = $conexao->prepare($sqlVerifica);
$verificacao->execute();
$verificacao->store_result();

if ($verificacao->num_rows > 0) {
    $verificacao->bind_result($id, $email, $usuario);
    $verificacao->fetch();

    $_SESSION['usuario'] = $usuario;
    $_SESSION['email'] = $email;
    $_SESSION['usuario'] = $usuario;

    $_SESSION['msg'] = "Login enviado";
    header("Location: index.php");
    exit();
} else {
    $_SESSION['usuarioInvalido'] = "Usuário ou senha incorretos.";
    header("Location: index.php");
    exit();
}
?>