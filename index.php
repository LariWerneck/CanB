<?php
@include 'config.php';
session_start();
if(isset($_POST['submit']))
{
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = md5($_POST['password']);
  $conpassword = md5($_POST['conpassword']);
  $select = " SELECT * FROM tb_users WHERE ds_email = '$email' && ds_password = '$password'";
  $result = mysqli_query($conn, $select);
  if (mysqli_num_rows($result) > 0)
  {
    $error[] = 'Usuário já cadastrado!';
  }
  else
  {
    if($password != $conpassword )
    {
      $error[] = 'As senhas são diferentes!';
    }
    else
    {
      $insert = "INSERT INTO tb_users(ds_email, ds_password) VALUES('$email', '$password')";
      mysqli_query($conn, $insert);
      header('location:Login.php');
    }
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registre-se</title>
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
            if(isset($error))
            {
              foreach($error as $error)
              {
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
                <input type="password" class="input" name="password" id="password" placeholder="Senha"  required>
              </div>
            </div>
            <div class="label-wrapper">
              <div class="input-wrapper">
                <input type="password" class="input" name="conpassword" id="conpassword" placeholder="Senha"  required>
              </div>
            </div>
            <div class="TextEcho">
              Já tem uma conta? Faça <a href="Login.php">Login</a>
            </div>
            <a href="Login.php">
              <button type="submit" name="submit" class="button">
                Registre-se
              </button>
            </a>
        </form>
      </div>
    </div>
  </div>
</body>
</html>