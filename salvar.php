<?php
session_start();
include ('conecta.php');

$usuario = $_POST['usuario'];
$email = $_POST['email'];
$senha = $_POST['senha'];

if (empty($email) || empty($usuario) || empty($senha)) {
    $_SESSION['erro'] = "Todos os campos são obrigatórios.";
    header("Location: cadastro.php");
    exit();
}

//sql para inserir no banco
$sql = "INSERT INTO jogador (email, senha, username)
            VALUES ('$email', '$senha', '$usuario')";

if (mysqli_query($conexao, $sql)) {
    $_SESSION['msg'] = "Cadastro enviado";
    header("Location: cadastro.php");
    exit();
} else {
    $_SESSION['erro'] = "Ocorreu um erro: " . mysqli_error($conexao);
    header("Location: cadastro.php");
    exit();
}

