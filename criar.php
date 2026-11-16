<?php
    session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Inter+Tight:wght@500;600;700&amp;family=JetBrains+Mono:wght@400;500&amp;display=swap">
    <title>Exemplo CRUD</title>
    <script>
        ! function() {
            try {
                var t = localStorage.getItem("dash26-theme"),
                    e = window.matchMedia("(prefers-color-scheme: dark)").matches;
                document.documentElement.setAttribute("data-theme", t || (e ? "dark" : "light"))
            } catch (t) {
                document.documentElement.setAttribute("data-theme", "light")
            }
        }()
    </script>
    <script defer="defer" src="../runtime.096d507f.js"></script>
    <script defer="defer" src="../2026.5a84696f.js"></script>
    <link href="../style.76ee5eee.css" rel="stylesheet">
</head>

<body>
    <div class="error-shell">
        <div class="error-card"><span class="error-eyebrow"></span>
            <h1 class="error-title">Criar novo aluno</h1>
            <div class="error-description" style="text-align: left;">
                <?php
                    if (!empty($_SESSION['erro'])) {
                        echo '<div class="alert danger"><span class="ico"><svg viewBox="0 0 24 24"><path d="M22 11.1V12a10 10 0 1 1-5.9-9.1"></path><path d="m22 4-10 10-3-3"></path></svg></span><div class="body"><div class="title">Erro</div>'.$_SESSION['erro'].'</div><button class="close" aria-label="Dismiss"><svg viewBox="0 0 24 24"><path d="M18 6 6 18M6 6l12 12"></path></svg></button></div>';
                        unset($_SESSION['erro']);
                    }
                    if (!empty($_SESSION['msg'])) {
                        echo '<div class="alert success"><span class="ico"><svg viewBox="0 0 24 24"><path d="M22 11.1V12a10 10 0 1 1-5.9-9.1"></path><path d="m22 4-10 10-3-3"></path></svg></span><div class="body"><div class="title">Sucesso</div>'.$_SESSION['msg'].'</div><button class="close" aria-label="Dismiss"><svg viewBox="0 0 24 24"><path d="M18 6 6 18M6 6l12 12"></path></svg></button></div>';
                        unset($_SESSION['msg']);
                    }
                ?>
                <form action="salvar.php" method="POST">
                    <p>
                        <label for="nome">Nome:*</label>
                        <input type="text" id="nome" name="nome" class="input" required autofocus>                      
                    </p>
                    <p>
                        <label for="cpf">CPF:</label>
                        <input type="text" id="cpf" name="cpf" class="input">
                    </p>
                    <p>
                        <label for="data_nascimento">Data de Nascimento:*</label>
                        <input type="date" id="data_nascimento" name="data_nascimento" class="input" required>   
                    </p>
                    <p>
                        <label for="endereco">Endereço:</label>
                        <input type="text" id="endereco" name="endereco" class="input">
                    </p>
                    <p>
                        <button type="submit" class="btn btn--primary">Adicionar aluno</button>
                        <a href="lista.php"><button type="button" class="btn btn--secondary">Voltar</button></a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>