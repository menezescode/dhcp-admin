<?php

  session_start();
  require_once 'dbconnect.php';

  if (isset($_SESSION['userSession'])) {
    header("Location: home.php");
  }

  if(empty($_GET['email'])) {
    header("Location: index.php") ;
  }

  $email = strip_tags($_GET['email']);
  $email = $DBcon->real_escape_string($email);

  $query = $DBcon->query("SELECT * FROM tbl_users WHERE email='$email'");
  $count = $query->num_rows;

  if ($count == 0 ){
    $msg = "<div class='alert alert-danger'>
            <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Desculpe, não foi possível completar a sua solicitação.
            </div>";
  } else {
    if(isset($_POST['btn-reset-pass'])) {
      $pass = strip_tags($_POST['pass']);
      $confpass = strip_tags($_POST['confirm-pass']);

      $pass = $DBcon->real_escape_string($pass);
      $confpass = $DBcon->real_escape_string($confpass);
      $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

      if ($pass == $confpass){
        $query = $DBcon->query("UPDATE tbl_users SET password='$hashed_password' WHERE email='$email'");
        $msg = "<div class='alert alert-success'>
                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Senha alterada com sucesso.
                </div>";
      } else {
        $msg = "<div class='alert alert-danger'>
                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Desculpe, as senhas inseridas são diferentes.
                </div>";
      }
    }
  }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Resetar Senha</title>
    <link crossorigin="anonymous" href=
    "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity=
    "sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
    rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body id="login">
    <div class="container">
        <div class='alert alert-success'>
            Olá, você está aqui para resetar sua senha.
        </div>

        <form class="form-signin" method="post">
            <h3 class="form-signin-heading">Resetar Senha.</h3>

            <hr>

            <?php
              if(isset($msg)){
                echo $msg;
              }
            ?>

            <div class="form-group">
                <input class="form-control" name="pass" placeholder=
                "Nova Senha" required="" type="password">
                <span id="check-e"></span>
            </div>
            <div class="form-group">
                <input class="form-control" name="confirm-pass" placeholder=
                "Confirmar Nova Senha" required="" type="password">
                <span id="check-e"></span>
            </div>

            <hr>
            <button class="btn btn-large btn-primary" name="btn-reset-pass"
            type="submit">Resetar minha senha</button>
            <a class="btn btn-default"
            href="index.php">Voltar para Login</a>
        </form>
    </div>
    <!-- /container -->
    <script src="bootstrap/js/jquery-1.9.1.min.js">
    </script>
    <script src="bootstrap/js/bootstrap.min.js">
    </script>
</body>
</html>
