<?php
session_start();
include '../crud/conectaBD.php';

$idUsuario = (int) $_SESSION['idUsuario'];

//sql para buscar o jogador no banco
$sql = "SELECT id, email, username FROM jogador WHERE id = '$idUsuario'";
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) === 0) {
  $_SESSION['erro'] = "Jogador não encontrado!";
  header("Location: ../index.php");
  exit();
}

while ($tupla = mysqli_fetch_assoc($resultado)) {
  $username = $tupla["username"] ?? '';
  $email = $tupla["email"] ?? '';
}
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <style>
    .atualizar {
      margin: 10px;
      border: #46563C solid 1px;
      color: #46563C;
      cursor: pointer;
      background-color: #B4D699;
    }
  </style>
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
      <div id="userAtual"><?= $username ?></div>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUsername">Modificar
      nome de usuário</button>
    <br />
    <div class="informacoes">
      <div>E-mail:</div>
      <div id="userAtual"><?= $email ?></div>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEmail">Modificar
      e-mail</button>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSenha">Modificar
      senha</button>
    <div id="excluir">
      <form action="../crudJogador/excluir.php"><button type="submit">Excluir conta</button></form>
    </div>
  </div>
  </div>

  <div class="modal" id="modalUsername" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modificar nome de usuário</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="perg">
            <form action="../crudJogador/atualizarUsuario.php" method="POST">
              <label for="username">Insira seu novo nome: </label>
              <input type="text" name="username" id="username" required>
              <button type="submit" class="atualizar">Atualizar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="modalEmail" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modificar email</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="perg">
            <form action="../crudJogador/atualizarEmail.php" method="POST">
              <label for="email">Insira seu novo email: </label>
              <input type="email" name="email" id="email" required>
              <button type="submit" class="atualizar">Atualizar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="modalSenha" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modificar senha</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="perg">
            <form action="../crudJogador/atualizarSenha.php" method="POST">
              <label for="password">Insira sua nova senha: </label>
              <input type="password" name="senha" id="senha" required>
              <button type="submit" class="atualizar">Atualizar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>

  <script src="../jquery-4.0.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <?php
  if (!empty($_SESSION['erro'])) {
    echo '<script>alert("' . $_SESSION['erro'] . '")</script>';
    unset($_SESSION['erro']);
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
        })
      });
    </script>
    <?php unset($_SESSION['msg']); ?>
  <?php endif; ?>
</body>

</html>