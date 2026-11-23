<?php
session_start();
include('conecta.php');
var_dump($_POST);
exit();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome        = trim($_POST['nome'] ?? '');
    $idade       = intval($_POST['idade'] ?? 0);
    $serie        = trim($_POST['ano'] ?? '');
    $descricao   = trim($_POST['descricao'] ?? '');

    $attr_cafe   = intval($_POST['attr_cafe'] ?? '0');
    $attr_imaginario  = intval($_POST['attr_imagi'] ?? '0');
    $attr_caos   = intval($_POST['attr_caos'] ?? '0');
    $attr_amor   = intval($_POST['attr_amor'] ?? '0');

    $pv          = intval($_POST['pv'] ?? '');
    $pe          = intval($_POST['pe'] ?? '');

    $equipamentos = trim($_POST['equipamentos'] ?? '');
    $arma         = trim($_POST['arma'] ?? '');

    $habilidades = [];
    for ($i = 1; $i <= 10; $i++) {
        $habilidades["habilidade$i"] = $_POST["habilidade$i"];
    }

    $aulas = [];
    for ($i = 1; $i <= 10; $i++) {
        $aulas["aulas$i"] = $_POST["aulas$i"];
    }

    // Exemplo de Validação simples (Nome é obrigatório)
    if (empty($nome)) {
        echo "<script>alert('O nome do personagem é obrigatório!'); window.history.back();</script>";
        exit;
    }


    //Verificar se o usuário já está cadastrado no banco de dados
    $sqlVerifica = "SELECT id FROM personagem WHERE nome = '$nome' LIMIT 1";
    $verificacao = $conexao->prepare($sqlVerifica);
    $verificacao->execute();
    $verificacao->store_result();

    if ($verificacao->num_rows > 0) {
        $_SESSION['usuarioExiste'] = "Esse usuário já existe.";
        header("Location: cadastro.php");
        exit();
    } else {
        //sql para inserir no banco
        $sqlPersonagem = "INSERT INTO personagem (nome, idade, serie, descricao, attr_cafe, attr_imaginario, attr_caos, attr_amor) 
                          VALUES ($nome, $idade, $serie, $descricao, $attr_cafe, $attr_imaginario, $attr_caos, $attr_amor)";

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
}
