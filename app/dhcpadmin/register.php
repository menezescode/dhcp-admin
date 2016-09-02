<?php

session_start();

if (isset($_SESSION['userSession'])!="") {
  header("Location: home.php");
}

require_once 'dbconnect.php';

if(isset($_POST['btn-signup'])) {
  $uname = strip_tags($_POST['username']);
  $email = strip_tags($_POST['email']);
  $upass = strip_tags($_POST['password']);

  $uname = $DBcon->real_escape_string($uname);
  $email = $DBcon->real_escape_string($email);
  $upass = $DBcon->real_escape_string($upass);

  $hashed_password = password_hash($upass, PASSWORD_DEFAULT);

  $check_email = $DBcon->query("SELECT email FROM tbl_users WHERE email='$email'");
  $count=$check_email->num_rows;

  if ($count==0) {
    $query = "INSERT INTO tbl_users(username,email,password) VALUES('$uname','$email','$hashed_password')";

    if ($DBcon->query($query)) {
      $recebeIdQuery = $DBcon->query("SELECT * FROM tbl_users WHERE email='$email'");
      $idRow = $recebeIdQuery->fetch_array();
      $id = (int)$idRow['user_id'];

      $cria = "INSERT INTO tbl_user_info(u_id, endereco, cep, empresa, codigo)
               VALUES($id, DEFAULT, DEFAULT, DEFAULT, DEFAULT)";

      if ($DBcon->query($cria)){
        $msg = "<div class='alert alert-success'>
                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Usuário cadastrado com sucesso!
                </div>";
      }
    } else {
      $msg = "<div class='alert alert-danger'>
              <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Desculpe, não foi possivel completar o seu cadastro!
              </div>";
      }
    } else {
        $msg = "<div class='alert alert-danger'>
                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Descuple, já existe uma conta com este email.
                </div>";
  }
  $DBcon->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>DHCP Admin - Cadastro</title>
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
            <form class="form-signin" id="register-form" method="post" name=
            "register-form">
                <h2 class="form-signin-heading">DHCP Admin - Cadastro</h2>

                <hr>

                <?php
                if (isset($msg)) {
                  echo $msg;
                }
                ?>

                <div class="form-group">
                    <input class="form-control" name="username" placeholder=
                    "Digite um nome de usuário" required="" type="text">
                </div>

                <div class="form-group">
                    <input class="form-control" name="email" placeholder=
                    "Digite seu endereço de email" required="" type="email"> <span id=
                    "check-e"></span>
                </div>

                <div class="form-group">
                    <input class="form-control" name="password" placeholder=
                    "Digite sua senha" required="" type="password">
                </div>

                <hr>

                <div class="form-group">
                    <button class="btn btn-default" name="btn-signup" type=
                    "submit"><span class="glyphicon glyphicon-log-in"></span>
                    &nbsp; Criar Conta</button> <a class="btn btn-default"
                    href="index.php">Voltar para Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
