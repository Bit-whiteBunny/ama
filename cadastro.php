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
</head>

<body>
    <div id="container">
        <h1>Cadastro</h1>
        <form id="loginForm" action="salvar.php" method="POST">
            <div id="dados">
                <input type="email" name="email" id="email" class="textBox" placeholder="E-mail" required>
                <input type="text" name="username" id="username" class="textBox" placeholder="Usuário" required>
                <input type="password" name="senha" id="senha" class="textBox" placeholder="Senha" required>
                <button type="submit" class="submitButton">Cadastrar</button>
            </div>
        </form>
    </div>

    <script src="jquery-4.0.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php
    if (!empty($_SESSION['usuarioExiste'])) {
        echo '<script>alert("' . $_SESSION['usuarioExiste'] . '")</script>';
        unset($_SESSION['usuarioExiste']);
    }
    ?>

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