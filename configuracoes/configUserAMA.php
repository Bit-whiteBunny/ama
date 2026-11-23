<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Configurações de usuário</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="aparenceConfig.css" />
</head>

<body>
  <button id="voltar">
    <a href="../inicio/paginaInicial.php">
      <img class="logo" src="../imagens/logo.jpeg" alt="Brasão da Arcane Mirror Academy" height="100px" />
      <span class="ivoltar">&#8592;</span>
    </a>
  </button>
  <div id="painel">
    <h1 style="font-size: 40px">Configurações</h1>
    <div class="informacoes">
      <div>Usuário:</div>
      <div id="userAtual"><?= $_SESSION['usuario']; ?></div>
    </div>
    <button>Modificar nome de usuário</button>
    <br />
    <div class="informacoes">
      <div>E-mail:</div>
      <div id="userAtual"><?= $_SESSION['email']; ?></div>
    </div>
    <button>Modificar e-mail</button>
    <button>Modificar senha</button>
    <div id="excluir">
      <form action="excluir.php"><button type="submit">Excluir conta</button></form>
    </div>
  </div>
  </div>

  <?php if (!empty($_SESSION['contaExcluida'])): ?>
    <script>
      $(document).ready(function () {
        Swal.fire({
          title: 'Sucesso!',
          text: '<?= $_SESSION['contaExcluida']; ?>',
          icon: 'success',
          confirmButtonText: 'Ok'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location = 'index.php';
          }
        });
      });
    </script>
    <?php unset($_SESSION['msg']); ?>
  <?php endif; ?>

</body>
</html>