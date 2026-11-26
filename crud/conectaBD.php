<?php
$servidor   = "localhost:3306";
$usuario    = "root";
$senha      = "root";
$nomeBD = "ama";
//cria a conexão
$conexao = mysqli_connect($servidor, $usuario, $senha, $nomeBD);

//verifica a conexão
if (!$conexao) {
  die("Conexão falhou: " . mysqli_connect_error());
}
//echo "Conectado!"; //debug
?>
