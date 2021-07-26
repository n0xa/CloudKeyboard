<?php
include_once("config.php");
if($access_token=="changeme"){
  echo "Please configure your access_token in config.php".PHP_EOL;
  die(1);
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://api.particle.io/v1/devices/?access_token=".$access_token);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
$devices=json_decode($server_output,true);
curl_close ($ch);
?>
