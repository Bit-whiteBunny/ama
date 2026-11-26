<?php
session_start();
include('conectaBD.php');

/*var_dump($_POST);
exit(); 
*/
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
        if (!empty($_POST["habilidade$i"]))
            $habilidades["habilidade$i"] = $_POST["habilidade$i"];
    }

    $aulas = [];
    for ($i = 1; $i <= 3; $i++) {
        if (!empty($_POST["aulas$i"]))
            $aulas["aulas$i"] = $_POST["aulas$i"];
    }

    // Exemplo de Validação simples (Nome é obrigatório)
    if (empty($nome)) {
        echo "<script>alert('O nome do personagem é obrigatório!'); window.history.back();</script>";
        exit;
    }

    // 1. Buscar o ID da Casa de forma segura
    $stmtCasa = $conexao->prepare("SELECT id FROM casa WHERE nome = ? LIMIT 1");
    $stmtCasa->bind_param("s", $casa);
    $stmtCasa->execute();
    $id_casa = 0;
    $stmtCasa->bind_result($id_casa);
    $stmtCasa->fetch();
    $stmtCasa->close();

    // 2. Inserir o Personagem usando Prepared Statement
    $sqlPersonagem = $conexao->prepare("INSERT INTO personagem (nome, idade, serie, descricao, casa_id, attr_cafe, attr_imaginario, attr_caos, attr_amor) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Tipos: s = string, i = inteiro
    $sqlPersonagem->bind_param("ssssissss", $nome, $idade, $serie, $descricao, $id_casa, $attr_cafe, $attr_imaginario, $attr_caos, $attr_amor);

    if ($sqlPersonagem->execute()) {
        $_SESSION['msg'] = "Cadastro do personagem enviado com sucesso!";
        // Pega o ID gerado para este personagem recém inserido
        $id_per = $conexao->insert_id;
    } else {
        $_SESSION['erro'] = "Ocorreu um erro ao cadastrar o personagem: " . $sqlPersonagem->error;
        $sqlPersonagem->close();
        exit;
    }
    $sqlPersonagem->close();

    $sqlArma = $conexao->prepare("INSERT INTO arma (descricao, personagem_id) VALUES(? , ?)");

    $sqlArma->bind_param("si", $arma, $id_per);

    if ($sqlArma->execute()) {
        $_SESSION['msg'] = "Cadastro da arma enviado com sucesso!";
    } else {
        $_SESSION['erro'] = "Ocorreu um erro ao cadastrar a arma: " . $sqlArma->error;
        $sqlArma->close();
        exit;
    }
    $sqlArma->close();

    $sqlEquipamento = $conexao->prepare("INSERT INTO equipamento (descricao, personagem_id) VALUES(? , ?)");

    $sqlEquipamento->bind_param("si", $equipamentos, $id_per);

    if ($sqlEquipamento->execute()) {
        $_SESSION['msg'] = "Cadastro da arma enviado com sucesso!";
    } else {
        $_SESSION['erro'] = "Ocorreu um erro ao cadastrar a arma: " . $sqlEquipamento->error;
        $sqlEquipamento->close();
        exit;
    }
    $sqlEquipamento->close();

    for ($i = 1; $i <= 10; $i++) {
        $nomeHabi = " ";
        if (!empty($habilidades["habilidade$i"])) {
            $nomeHabi = 'habilidade' . $i;
            $ativaHabi = $habilidades["habilidade$i"];
        }
        $sqlHabilidade = $conexao->prepare("INSERT INTO habilidade(nome, ativa, personagem_id) VALUES(?, ?, ?)");
        $sqlHabilidade->bind_param("ssi", $nomeHabi, $ativaHabi, $id_per);

        if ($sqlHabilidade->execute()) {
            $_SESSION['msg'] = "Cadastro da arma enviado com sucesso!";
        } else {
            $_SESSION['erro'] = "Ocorreu um erro ao cadastrar a arma: " . $sqlHabilidade->error;
            $sqlHabilidade->close();
            exit;
        }

        $sqlHabilidade->close();
    }

    for ($i = 1; $i <= 3; $i++) {
        $nomeAula = " ";
        $ativaAula = " ";
        if (!empty($aulas["aula$i"])) {
            $nomeAula = 'aula' . $i;
            $ativaAula = $aulas["aula$i"];
        }
            $sqlAula = $conexao->prepare("INSERT INTO aula(nome, ativa, personagem_id) VALUES(?, ?, ?)");
            $sqlAula->bind_param("ssi", $nomeAula, $ativaAula, $id_per);

            if ($sqlAula->execute()) {
                $_SESSION['msg'] = "Cadastro da arma enviado com sucesso!";
            } else {
                $_SESSION['erro'] = "Ocorreu um erro ao cadastrar a arma: " . $sqlAula->error;
                $sqlAula->close();
                exit;
            }
        
        $sqlAula->close();
    }
    header("Location: ../fichas/fichas.php");
    exit();
}
