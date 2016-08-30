<?php

session_start();

require_once 'dbconnect.php';

if (isset($_SESSION['userSession'])) {
 header("Location: home.php");
}

if(isset($_POST['btn-submit'])) {
  $email = strip_tags($_POST['email']);
  $email = $DBcon->real_escape_string($email);
  $query = $DBcon->query("SELECT user_id, email FROM tbl_users WHERE email='$email'");
  $row=$query->fetch_array();
  $count = $query->num_rows;
  $menssagem= "Olá, $email
               <br /><br />
               <a href='http://localhost/resetarsenha.php?email=$email'>Clique aqui para resetar sua senha.</a>
              ";

  $subject = "Resetar Senha";
  mail($email,$subject,$message);
}
//   $msg = "<div class='alert alert-success'>
//           <button class='close' data-dismiss='alert'>&times;</button>
//           Nós enviamos um email para voce
//           </div>"
//
// } else {
//   $msg = "<div class='alert alert-danger'>
//           <button class='close' data-dismiss='alert'>&times;</button>
//           <strong>Desculpe!</strong> Email não encontrado
//           </div>";
// }
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
