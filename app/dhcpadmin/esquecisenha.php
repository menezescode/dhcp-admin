<?php

session_start();

require_once 'dbconnect.php';
require_once 'vendor/autoload.php';

if (isset($_SESSION['userSession'])) {
 header("Location: home.php");
}

function phpmailer($email, $subject, $message) {
  $mail = new PHPMailer(); // create a new object
  $mail->isSMTP(); // enable SMTP
  $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
  $mail->SMTPAuth = true; // authentication enabled
  $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
  $mail->Host = "smtp.gmail.com";
  $mail->Port = 465; // or 587
  $mail->IsHTML(true);
  $mail->Username = "dw20161dhcp@gmail.com";
  $mail->Password = "dwdhcp12321";
  $mail->SetFrom("dw20161dhcp@gmail.com");
  $mail->Subject = $subject;
  $mail->Body = $message;
  $mail->AddAddress($email);

   if(!$mail->Send()) {
      return "foi não";
   } else {
     return "foi";
   }
}

if(isset($_POST['btn-submit'])) {
  $email = strip_tags($_POST['email']);
  $email = $DBcon->real_escape_string($email);
  $query = $DBcon->query("SELECT user_id, email FROM tbl_users WHERE email='$email'");
  $row=$query->fetch_array();
  $count = $query->num_rows;

  if ($count == 1 ){
    $message = "Olá, $email
    <br /><br />
    <a href='http://localhost:8080/src/dhcpadmin/resetarsenha.php?email=$email'>Clique aqui para resetar sua senha.</a>
    ";
    $subject = "Resetar Senha";

    if(phpmailer($email,$subject,$message) == "foi") {
      $msg = "<div class='alert alert-success'>
              <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Email
              enviado, por favor verifique sua caixa de spam.
              </div>";
    } else {
      // echo "Mailer Error: " . $mail->ErrorInfo;
      $msg = "<div class='alert alert-danger'>
              <span class='glyphicon glyphicon-info-sign'></span> &nbsp;
              Desculpe, não foi possivel completar seu pedido.
              </div>";
    }
  } else {
    $msg = "<div class='alert alert-danger'>
            <span class='glyphicon glyphicon-info-sign'></span> &nbsp;
            Desculpe, seu email não está cadastrado.
            </div>";
  }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Esqueci a Senha</title>
    <link crossorigin="anonymous" href=
    "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity=
    "sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
    rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body id="login">
    <div class="container">
        <form class="form-signin" method="post">
            <h2 class="form-signin-heading">Recuperar Senha</h2>

            <hr>

            <?php
              if(isset($msg)) {
                echo $msg;
              } else {
            ?>

            <div class='alert alert-info'>
                Por favor, digite seu endereço de email. Você receberá um link
                para recriar a sua senha.
            </div>

            <?php
               }
            ?>

            <div class="form-group">
                <input class="form-control" name="email" placeholder=
                "Digite seu endereço de email" required="" type="email">
                <span id="check-e"></span>
            </div>

            <hr>

            <button class="btn btn-danger btn-primary" name="btn-submit" type=
            "submit">Gerar nova senha</button>
        </form>
    </div>
</body>
</html>
