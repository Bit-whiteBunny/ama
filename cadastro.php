<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="aparenceLogin.css">
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
</head>

<body>
    <div class="error-shell">
        <div class="error-card"><span class="error-eyebrow"></span>
            <div id="container">
                <h1>Cadastro</h1>
                <div class="error-description" style="text-align: left;">
                    <?php
                    if (!empty($_SESSION['erro'])) {
                        echo '<div class="alert danger"><span class="ico"><svg viewBox="0 0 24 24"><path d="M22 11.1V12a10 10 0 1 1-5.9-9.1"></path><path d="m22 4-10 10-3-3"></path></svg></span><div class="body"><div class="title">Erro</div>' . $_SESSION['erro'] . '</div><button class="close" aria-label="Dismiss"><svg viewBox="0 0 24 24"><path d="M18 6 6 18M6 6l12 12"></path></svg></button></div>';
                        unset($_SESSION['erro']);
                    }
                    ?>
                    <form id="loginForm" action="salvar.php" method="POST">
                        <div id="dados">
                            <input type="email" name="email" id="email" class="textBox" placeholder="E-mail" required>
                            <input type="text" name="usuario" id="usuario" class="textBox" placeholder="Usuário" required>
                            <input type="password" name="senha" id="senha" class="textBox" placeholder="Senha" required>
                            <button type="submit" class="submitButton">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="jquery-4.0.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if (!empty($_SESSION['msg'])): ?>
        <script>
            $(document).ready(function () {
                Swal.fire({
                    title: 'Sucesso!',
                    text: '<?= $_SESSION['msg']; ?>',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = 'inicio/paginaInicial.php';
                    }
                });
            });
        </script>
        <?php unset($_SESSION['msg']); ?>
    <?php endif; ?>
</body>

</html>
