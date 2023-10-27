<?php
@include 'config.php';
session_start();

$id_user = $_SESSION['id_user'];


if (isset($_POST['submit']))
{
  $name = mysqli_real_escape_string($conn, $_POST['nomequadro']);
  $select = "SELECT * FROM tb_frames WHERE nm_frame = '$name' AND id_user = $id_user";
  $result = mysqli_query($conn, $select);

  if (mysqli_num_rows($result) > 0)
  {
    $error[] = 'Quadro já cadastrado';
  }
  else
  {
    $insert = "INSERT INTO tb_frames (nm_frame, id_user) VALUES ('$name', '$id_user')";
    mysqli_query($conn, $insert);
    $idframe = mysqli_insert_id($conn);
    header("Location: kanban.php?id=" . $idframe);
    exit();
  }
}

$select = "SELECT id_frame, nm_frame FROM tb_frames WHERE id_user = $id_user";
$result = mysqli_query($conn, $select);
$frames = array();

if (mysqli_num_rows($result) > 0)
{
  while ($row = mysqli_fetch_assoc($result))
  {
    $frames[] = $row;
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Create_Page/style.css" />
  <title>Quadros Kanban</title>
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
    <?php 
      if(isset($error))
      {
        foreach($error as $error)
        {
          echo '<span>'.$error.'</span>';
        }
      }
    ?>
    <div class="quadros" id="quadros">
    <?php foreach ($frames as $frame) : ?>
      
        <div class="quadro" name="quadro" id="quadro<?= $frame['id_frame'] ?>">
        
<a href="kanban.php?id=<?= $frame['id_frame'] ?>&id_kanban=<?= $frame['id_frame'] ?>">
          <div class="TitleFrame"><?= htmlspecialchars($frame['nm_frame']) ?></div>
          </a>
        <div class="card">
    <button class="delete-button"><img class="delete-img" src="Create_Page/img/icon-delete.png"/></button>
    <button class="update-button"><img class="update-img" src="Create_Page/img/icon-update.png"/></button>
</div>
        </div>
      
    <?php endforeach; ?>
    <button class="new-frame" id="openModal"><img class="mais" src="Create_Page/img/icon-mais.svg" /></button>
      <div id="myModal" class="modal">
        <div class="modal-content">
          <form method="post" action="" class="containerForm" >
            <label class="text-wrapper" for="nomequadro">Nome do Quadro Kanban:</label>
            <div class="label-wrapper">
              <input type="text" id="nomequadro" name="nomequadro" class="inputNameFrame">
            </div>
            <button id="nameFrame" class="btnNameFrame" name="submit">Nomear</button>
          </form>
          <div class ="formsalign">
            <span class="close" id="closeModal">&times;</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src='Create_Page/main.js'></script>
</body>
</html>