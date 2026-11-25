<?php
session_start();
include('conecta.php');
/* var_dump($_POST);
exit(); */

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
    $casa         = trim($_POST['casa']);

    $habilidades = [];
    for ($i = 1; $i <= 10; $i++) {
        $habilidades["habilidade$i"] = $_POST["habilidade$i"];
    }

    $aulas = [];
    for ($i = 1; $i <= 3; $i++) {
        $aulas["aulas$i"] = $_POST["aulas$i"];
    }

    // Exemplo de Validação simples (Nome é obrigatório)
    if (empty($nome)) {
        echo "<script>alert('O nome do personagem é obrigatório!'); window.history.back();</script>";
        exit;
    }


    //Verificar se o usuário já está cadastrado no banco de dados
    $sqlVerifica = "SELECT id FROM casa WHERE nome = '$casa' LIMIT 1";
    $verificacao = $conexao->prepare($sqlVerifica);
    $verificacao->execute();
    $id_casa = 0;
    $verificacao->bind_result($id_casa);
    $verificacao->fetch();
    $verificacao->close();

    $sqlPersonagem = "INSERT INTO personagem (nome, idade, serie, descricao, casa_id,attr_cafe, attr_imaginario, attr_caos, attr_amor) 
                          VALUES ($nome, $idade, $serie, $descricao, $id_casa,$attr_cafe, $attr_imaginario, $attr_caos, $attr_amor)";

    if (mysqli_query($conexao, $sqlPersonagem)) {
        $_SESSION['msg'] = "Cadastro personagem enviado";
    } else {
        $_SESSION['erro'] = "Ocorreu um erro: " . mysqli_error($conexao);
    }

    $sqlVerifica = "SELECT id FROM personagem WHERE nome = '$nome' LIMIT 1";
    $verificacao = $conexao->prepare($sqlVerifica);
    $verificacao->execute();
    $id_per = 0;
    $verificacao->bind_result($id_per);
    $verificacao->fetch();
    $verificacao->close();

    $sqlArma = "INSERT INTO arma (descricao, personagem_id) 
                          VALUES ($arma, $id_per)";

    if (mysqli_query($conexao, $sqlArma)) {
        $_SESSION['msg'] = "Cadastro arma enviado";

    } else {
        $_SESSION['erro'] = "Ocorreu um erro: " . mysqli_error($conexao);
    }

    $sqlEquipamento = "INSERT INTO equipamento(descricao, personagem_id) 
                          VALUES ($equipamentos, $id_per)";

    if (mysqli_query($conexao, $sqlEquipamento)) {
        $_SESSION['msg'] = "Cadastro equipamento enviado";
       
    } else {
        $_SESSION['erro'] = "Ocorreu um erro: " . mysqli_error($conexao);
    }

    $sql = "INSERT INTO habilidade (nome, ativa, personagem_id) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sql);

    if ($stmt) {
        $sucesso = true;

        for ($i = 1; $i <= 10; $i++) {
            $index = 'habilidade' . $i;

            $ativa_val = isset($habilidades[$index]) ? $habilidades[$index] : 0;

            $stmt->bind_param("ssi", $index, $ativa_val, $id_per);

            if (!$stmt->execute()) {
                $sucesso = false;
                $_SESSION['erro'] = "Ocorreu um erro no item $i: " . $stmt->error;
                break; 
            }
        }

        $stmt->close();
    }
}
