<?php

session_start();

require_once 'dbconnect.php';

if (isset($_SESSION['userSession'])!="") {
  header("Location: home.php");
  exit;
}

if (isset($_POST['btn-login'])) {
  $email = strip_tags($_POST['email']);
  $password = strip_tags($_POST['password']);

  $email = $DBcon->real_escape_string($email);
  $password = $DBcon->real_escape_string($password);

  $query = $DBcon->query("SELECT user_id, email, password FROM tbl_users WHERE email='$email'");
  $row=$query->fetch_array();

  $count = $query->num_rows; // Se a combinação email/pass for correta então o retorno tem q ser 1 linha

  if (password_verify($password, $row['password']) && $count==1) {
    $_SESSION['userSession'] = $row['user_id'];
    header("Location: home.php");
  } else {
    $msg = "<div class='alert alert-danger'>
            <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Username ou Senha Invalidos!
            </div>";
    }
  $DBcon->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">

    <title>DHCP Admin - Login</title>
    <link crossorigin="anonymous" href=
    "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity=
    "sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
    rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="signin-form">
        <div class="container">
            <form class="form-signin" id="login-form" method="post" name=
            "login-form">
                <h2 class="form-signin-heading">DHCP Admin - Entrar</h2>

                <hr>
                <?php
                  if(isset($msg)){
                    echo $msg;
                  }
                ?>

                <div class="form-group">
                    <input class="form-control" name="email" placeholder=
                    "Digite seu endereço de email" required="" type="email">
                    <span id="check-e"></span>
                </div>

                <div class="form-group">
                    <input class="form-control" name="password" placeholder=
                    "Digite sua senha" required="" type="password">
                </div>

                <hr>

                <div class="form-group">
                    <button class="btn btn-default" id="btn-login" name=
                    "btn-login" type="submit"><span class=
                    "glyphicon glyphicon-log-in"></span> &nbsp; Entrar</button>
                    <a class="btn btn-default" href="register.php">Cadastre-se
                    aqui</a>
                    <a class="btn btn-default" href="esquecisenha.php">Esqueci minha senha</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
