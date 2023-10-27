<?php
@include 'config.php';

session_start();

if(isset($_POST['submit']))
{
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = md5($_POST['password']);
  $select = " SELECT * FROM tb_users WHERE ds_email = '$email' && ds_password = '$password'";
  $result = mysqli_query($conn, $select);

  if (mysqli_num_rows($result) > 0)
  {
    $_SESSION['email'] = $email;
    $select = " SELECT id_user FROM tb_users WHERE ds_email = '$email' && ds_password = '$password'";
    $result = mysqli_query($conn, $select);
    if ($result)
    {
      $row = mysqli_fetch_assoc($result);
      if ($row) 
      {
          $id_user = $row['id_user'];
          $_SESSION['id_user'] = $id_user;
      }
    }
    header('location:home.html');
  }
  else
  {
    $error[] = 'E-mail ou senha incorreta';
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log-in</title>
  <link rel="stylesheet" href="Login_Page/style.css">
</head>
<body>
    <div class="home">
      <div class="main">
        <img class="img" src="Login_Page/img/TasksRafiki.svg">
        <div class="login">
          <img class="canb" src="Login_Page/img/logo.png">
          <div class="text-wrapper">
            Log in
          </div>
          <?php 
            if(isset($error)) {
              foreach($error as $error) {
                echo '<span>'.$error.'</span>';
              }
            }
          ?>
          <form action="" method="post" class="formlogin">
            <div class="label-wrapper">
              <div class="input-wrapper">
                <input type="email" class="input" name="email" id="email" placeholder="E-mail" autofocus required>
              </div>
            </div>
            <div class="label-wrapper">
              <div class="input-wrapper">
                <input class="input" name="password" id="password" placeholder="Senha" type="password" required>
              </div>
            </div>
            <div class="TextEcho">
              Não tem uma conta? <a href="Register.php">Registre-se</a>
            </div>
              <button type="submit" name="submit" class="button">
                Login
              </button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>