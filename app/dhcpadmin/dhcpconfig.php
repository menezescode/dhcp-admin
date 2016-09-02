<?php
session_start();
include_once 'dbconnect.php';

if (!isset($_SESSION['userSession'])) {
 header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM tbl_users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$DBcon->close();

function startService(){
  shell_exec('sudo service isc-dhcp-server start');
}

function restartService(){
  shell_exec('sudo service isc-dhcp-server restart');
}

function stopService(){
  shell_exec('sudo service isc-dhcp-server stop');
}

if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
        case 'start' : startService(); break;
        case 'restart' : restartService(); break;
        case 'stop' : stopService(); break;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- sweetalert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <!-- chosen -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.js"></script>

    <title>Welcome - <?php echo $userRow['email']; ?></title>

    <!-- Bootstrap -->
    <link crossorigin="anonymous" href=
    "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity=
    "sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
    rel="stylesheet">
    <!-- Sweetalert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <!-- Chosen -->
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

                    <li class="active">
                        <a href=
                        "dhcpconfig.php">Configuração</a>
                    </li>

                    <li>
                        <a href=
                        "log.php">Log</a>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#"><span class=
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
    "margin-top:250px;text-align:center;font-family:Verdana, Geneva, sans-serif;font-size:35px;">
    <h3>Alterar Status do Serviço DHCP</h3>
    <button type="button" id="btn-service-start" onclick="ajaxStart()" class="btn btn-success">Start</button>
    <button type="sumit" id="btn-service-restart" onclick="ajaxRestart()" class="btn btn-warning">Restart</button>
    <button type="submit" id="btn-service-stop" onclick="ajaxStop()" class="btn btn-danger">Stop</button>
    </div>

    <!-- <div class="container" style=
    "margin-top:50px;text-align:left;font-family:Verdana, Geneva, sans-serif;font-size:35px;">
    <h4>Configurações do Servidor DHCP</h4>
    <select class="chzn-select" name="faculty" style="width:300px;">
        <option value="eth0">INTERFACE - eth0</option>
        <option value="eth1">INTERFACE - eth1</option>
    </select>
    </div> -->


    <script>
    $(function() {
      $(".chzn-select").chosen();
    });

    function ajaxStart() {
      $.ajax({ url: 'dhcpconfig.php',
           data: {action: 'start'},
           type: 'post',
           success: function(output) {
             sweetAlert({
              title: "",
              text: "Serviço inciado com sucesso.",
              type: "success"
              });
            }
      });
    }

    function ajaxRestart() {
      $.ajax({ url: 'dhcpconfig.php',
           data: {action: 'restart'},
           type: 'post',
           success: function(output) {
             sweetAlert({
              title: "",
              text: "Serviço reiniciado com sucesso.",
              type: "success"
              });
            }
      });
    }

    function ajaxStop() {
      $.ajax({ url: 'dhcpconfig.php',
           data: {action: 'stop'},
           type: 'post',
           success: function(output) {
             sweetAlert({
              title: "",
              text: "Serviço parado com sucesso.",
              type: "error"
              });
            }
      });
    }
    </script>
</body>
</html>
