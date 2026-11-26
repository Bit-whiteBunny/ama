<?php
session_start();
include('crud/conectaBD.php');

$usuarioInserido = $_POST['username'];
$senhaInserida = $_POST['senha'];

//Verificar se o usuário já está cadastrado no banco de dados
$sqlVerifica = "SELECT id, email, username FROM jogador WHERE username = '$usuarioInserido' AND senha = '$senhaInserida' LIMIT 1";
$verificacao = $conexao->prepare($sqlVerifica);
$verificacao->execute();
$resultado = $verificacao->get_result();

if ($resultado->num_rows > 0) {
    $dadosUsuario = $resultado->fetch_assoc();

    $_SESSION['idUsuario'] = $dadosUsuario['id'];
    $_SESSION['email'] = $dadosUsuario['email'];
    $_SESSION['username'] = $dadosUsuario['username'];

    $_SESSION['msg'] = "Login enviado";
    header("Location: index.php");
    exit();
} else {
    $_SESSION['erro'] = "Usuário ou senha incorretos.";
    header("Location: index.php");
    exit();
}
?>