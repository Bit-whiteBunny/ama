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
        <h1>Login</h1>
        <?php
        if (!empty($_SESSION['erro'])) {
            echo '<script>alert("' . $_SESSION['erro'] . '")</script>';
            unset($_SESSION['erro']);
        }
        ?>
        <form id="loginForm" method="POST" action="login.php">
            <div id="dados">
                <input type="text" class="textBox" name="username" id="username" placeholder="Usuário" required>
                <input type="password" class="textBox" name="senha" id="senha" placeholder="Senha" required>
                <button type="submit" class="submitButton">Entrar</button>
            </div>
        </form>
    </div>
    <p><a href="cadastro.php">Criar conta</a></p>
</body>

</html>
<script src="jquery-4.0.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
if (!empty($_SESSION['usuarioInvalido'])) {
    echo '<script>alert("' . $_SESSION['usuarioInvalido'] . '")</script>';
    unset($_SESSION['usuarioInvalido']);
}
?>

<?php
if (!empty($_SESSION['semCadastro'])) {
    echo '<script>alert("' . $_SESSION['semCadastro'] . '")</script>';
    unset($_SESSION['semCadastro']);
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