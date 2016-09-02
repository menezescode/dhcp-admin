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

  echo json_encode($userRow);
  echo json_encode($userInfoRow);

  $DBcon->close();
?>
