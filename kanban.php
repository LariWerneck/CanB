<?php
@include 'config.php';

session_start();

$id_user = $_SESSION['id_user'];
$idframe = $_GET['id'];

$_SESSION['id_frame'] = $idframe;

$select = "SELECT * FROM tb_frames WHERE id_frame = '$idframe'";
$result = mysqli_query($conn, $select);
if ($result && mysqli_num_rows($result) > 0)
{
  $nm_frame = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
  $id_kanban = intval($_GET['id']);

  $query = "SELECT * FROM tb_cards WHERE id_kanban = '$id_kanban' AND id_user = '$id_user'";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0)
  {
    $cards = mysqli_fetch_all($result, MYSQLI_ASSOC);
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Kanban_Page/style.css" />
  <title>Kanban: <?= htmlspecialchars($nm_frame['nm_frame']) ?></title>
</head>
<body class="first-page">
  <div class="nav-bar">
    <a href="home.html"><img class="img" src="Create_Page/img/icon-home.svg" /></a>
    <a href="Create.php"><img class="img" src="Create_Page/img/icon-adicionar.svg" /></a>
    <a href="https://github.com/LariWerneck" target="_blank"><img class="img" src="Create_Page/img/icon-github.svg" /></a>
    <a href="Logout.php"><img class="img" src="Create_Page/img/icon-sair.svg" /></a>
  </div>
  <div class="main">
    <div class="div-logo">
      <img class="canb" src="Login_Page/img/logo.png" />
    </div>
    <div class="kanban">
      <div class="frame">
        <div class="list" id="fazer" ondrop="parar(event)" ondragover="comecar(event)">
          <div class="text-wrapper">Para fazer</div>
          <?php
          // Listar cards na coluna "Para fazer"
          if (isset($cards))
          {
            foreach ($cards as $card)
            {
              if ($card['ds_status'] === 'fazer') {
                echo '<div class="card-container" id="' . $card['id_card'] . '" draggable="true" status="fazer" ondragstart="moverquadro(event)">';
                echo '<textarea rows="4" cols="40" class="divTextArea" id="input' . $card['id_card'] . '" onblur="outArea(' . $card['id_card'] . ', this.value)">' . $card['ds_card'] . '</textarea>';
                echo '<button class="delete-button"><img class="delete-img" src="Create_Page/img/icon-delete.png"/></button>';
                echo '</div>';
            }
            }
          }
          ?>
        </div>
        <button class="addCard"> + Card </button>
      </div>
      <hr class="line">
      <div class="frame">
        <div class="list" id="fazendo" ondrop="parar(event)" ondragover="comecar(event)">
          <div class="text-wrapper">Fazendo</div>
          <?php
          // Listar cards na coluna "Fazendo"
          if (isset($cards))
          {
            foreach ($cards as $card)
            {
              if ($card['ds_status'] === 'fazendo')
              {
                echo '<div class="card-container" id="' . $card['id_card'] . '" draggable="true" status="fazer" ondragstart="moverquadro(event)">';
                echo '<textarea rows="4" cols="40" class="divTextArea" id="input' . $card['id_card'] . '" onblur="outArea(' . $card['id_card'] . ', this.value)">' . $card['ds_card'] . '</textarea>';
                echo '<button class="delete-button"><img class="delete-img" src="Create_Page/img/icon-delete.png"/></button>';
                echo '</div>';
              }
            }
          }
          ?>
        </div>
      </div>
      <hr class="line">
      <div class="frame">
        <div class="list" id="feito" ondrop="parar(event)" ondragover="comecar(event)">
          <div class="text-wrapper">Feito</div>
          <?php
          // Listar cards na coluna "Feito"
          if (isset($cards))
          {
            foreach ($cards as $card)
            {
              if ($card['ds_status'] === 'feito')
              {
                echo '<div class="card-container" id="' . $card['id_card'] . '" draggable="true" status="fazer" ondragstart="moverquadro(event)">';
                echo '<textarea rows="4" cols="40" class="divTextArea" id="input' . $card['id_card'] . '" onblur="outArea(' . $card['id_card'] . ', this.value)">' . $card['ds_card'] . '</textarea>';
                echo '<button class="delete-button"><img class="delete-img" src="Create_Page/img/icon-delete.png"/></button>';
                echo '</div>';
              }
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <script src='Kanban_Page/main.js'></script>
</body>
</html>
