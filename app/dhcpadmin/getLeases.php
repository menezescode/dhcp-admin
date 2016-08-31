<?php
function showLeases ($target){

  $vrau = shell_exec("$target");

  $show = [];

  preg_match("/([0-9]{1,3}\.){3}[0-9]{1,3}/", $vrau, $matches);
  // $matches = explode(':', $matches[0]);
  // $result['iaddr'] = $matches[1]; //Apenas ip
  $show['Lease'] = $matches[0];

  preg_match("/client-hostname \"[a-zA-Z]{1,20}\"/", $vrau, $matches);

  $show['Client'] = $matches[0];

  //echo $show['Client'];

  return json_encode($show);
 }

 header('Content-Type: application/json');
 header("Access-Control-Allow-Origin: *");

 echo showLeases($_GET['target']);
 ?>
