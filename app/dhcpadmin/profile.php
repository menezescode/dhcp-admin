<?php
  session_start();
  include_once 'dbconnect.php';

  if (!isset($_SESSION['userSession'])) {
   header("Location: index.php");
  }

  $query = $DBcon->query("SELECT * FROM tbl_users WHERE user_id=".$_SESSION['userSession']);
  $userRow = $query->fetch_array();

  $queryInfo = $DBcon->query("SELECT * FROM tbl_user_info WHERE u_id=".$_SESSION['userSession']);
  $userInfoRow = $queryInfo->fetch_array();

  // if(isset($_POST['btn-export'])) {
  //   echo json_encode($userRow);
  //   echo json_encode($userInfoRow);
  // }

  $DBcon->close();
?>

<!DOCTYPE html>
<html>
  <head>
      <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
      <title>Welcome - <?php echo $userRow['email']; ?></title>

      <!-- jquery -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <!-- chosen -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.js"></script>
      <!-- bootstrap -->
      <link crossorigin="anonymous" href=
      "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity=
      "sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
      rel="stylesheet">
      <!-- chosen css -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.css">
  </head>

  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button aria-controls="navbar" aria-expanded="false" class=
                "navbar-toggle collapsed" data-target="#navbar" data-toggle=
                "collapse" type="button"><span class="sr-only">Toggle
                navigation</span> <span class="icon-bar"></span> <span class=
                "icon-bar"></span> <span class="icon-bar"></span></button>
                <a class="navbar-brand" href="home.php">DHCP Admin</a>
            </div>

            <div class="navbar-collapse collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li>
                        <a href=
                        "home.php">
                        Dashboard</a>
                    </li>
                    <li>
                        <a href=
                        "dhcpconfig.php">Configuração</a>
                    </li>
                    <li>
                        <a href=
                        "log.php">Log</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="active">
                        <a href="profile.php"><span class=
                        "glyphicon glyphicon-user"></span>&nbsp;
                        <?php echo $userRow['username']; ?></a>
                    </li>
                    <li>
                        <a href="logout.php?logout"><span class=
                        "glyphicon glyphicon-log-out"></span>&nbsp; Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style=
    "margin-top:50px;text-align:left;font-family:Verdana, Geneva, sans-serif;">
    <h3>Informações:</h3>
    <table class="table table-bordered" style="margin-bottom:0px;">
      <tbody>
        <tr>
          <td>Username</td>
          <td><?php echo $userRow['username']; ?></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><?php echo $userRow['email']; ?></td>
        </tr>
        <tr>
          <td>Endereço</td>
          <td><?php echo $userInfoRow['endereco']; ?></td>
        </tr>
        <tr>
          <td>Cep</td>
          <td><?php echo $userInfoRow['cep']; ?></td>
        </tr>
        <tr>
          <td>Empresa</td>
          <td><?php echo $userInfoRow['empresa']; ?></td>
        </tr>
        <tr>
          <td>Código</td>
          <td><?php echo $userInfoRow['codigo']; ?></td>
        </tr>
      </tbody>
    </table>
    </div>

    <div class="container" style=
    "margin-top:10px;text-align:left;font-family:Verdana, Geneva, sans-serif;">
    <h4>Exportar Informações:</h4>
    <hr>
    <form method="POST">
      <select class="chzn-select" name="faculty" style="width:300px;">
        <option value="json">Exportar JSON</option>
        <option value="xml">Exportar XML</option>
      </select>
      <button class="btn btn-success btn-primary" name="btn-export" type=
      "submit">Exportar</button>
    </form>
    </div>

    <script>
      $(function() {
        $(".chzn-select").chosen();
      });
    </script>

</body>
</html>
