<?php
session_start();
include('conecta.php');

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

//Verificar se o usuário já está cadastrado no banco de dados
$sqlVerifica = "SELECT email FROM jogador WHERE username = '$usuario' AND senha = '$senha' LIMIT 1";
$verificacao = $conexao->prepare($sqlVerifica);
$verificacao->execute();
$verificacao->store_result();

if ($verificacao->num_rows > 0) {
    $verificacao->bind_result($email);
    $verificacao->fetch();

    $_SESSION['usuario'] = $usuario;
    $_SESSION['senha'] = $senha;
    $_SESSION['email'] = $email;

    $_SESSION['msg'] = "Login enviado";
    header("Location: index.php");
    exit();
} else {
    $_SESSION['usuarioInvalido'] = "Usuário ou senha incorretos.";
    header("Location: index.php");
    exit();
}
?>