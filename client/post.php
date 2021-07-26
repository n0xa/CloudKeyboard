<?php
include_once("config.php");
include_once("scancodes.php");
$name=$_REQUEST['device'];
$ep=$_REQUEST['ep'];
$arg=$_REQUEST['arg'];
$device=$_REQUEST['device'];

$convert=Array("scancode","shft","win","alt","ctl","ctlalt");
echo $ep;
if(in_array($ep,$convert)){
  $scancode=scancode($arg);
  echo "scancode: ".$arg."=".$scancode;
  $arg=$scancode;
}

if(isset($device)){
	$dev=$device;
}

$url="https://api.particle.io/v1/devices/".$device."/".$ep."?access_token=".$access_token;
echo $url;
sleep(5);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "arg=".$arg);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

curl_close ($ch);
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
