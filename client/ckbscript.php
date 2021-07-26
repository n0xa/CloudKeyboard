<?php
# Script interpreter for Cloud Keyboard
include_once("config.php");
include_once("scancodes.php");
include_once("devices.php");
$fn = fopen($argv[1],"r");

function post($device,$access_token,$ep,$arg){
  $convert=Array("scancode","shft","win","alt","ctl","ctlalt");
  if(in_array($ep,$convert)){
    $scancode=scancode($arg);
    $arg=$scancode;
  }
  if(isset($device)){
          $dev=$device;
  }
  $url="https://api.particle.io/v1/devices/".$device."/".$ep."?access_token=".$access_token;
  sleep(5);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,$url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "arg=".$arg);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $server_output = curl_exec($ch);
  curl_close ($ch);
  echo "    [ done ]" .PHP_EOL;
}


while(! feof($fn))  {
  $cmd = explode(':',trim(fgets($fn)),2);
  echo implode(":", $cmd);
  if(isset($cmd[1])){
    switch ($cmd[0]) {
      case "device":
	$dev="";
	foreach($devices as $device){
	  if($device['name']==$cmd[1]){
            $dev=$device['id'];
	    echo "  [ Fetched device id ]".PHP_EOL;
          }
        }
        if(empty($dev)){
	  die(1);
        }
        break;
      case "sleep":
        $sec=intval($cmd[1]);
        sleep($sec);
	echo "  [ done ]". PHP_EOL;
        break;
      default:
        $ep=$cmd[0];
	$arg=$cmd[1];
	post($dev,$access_token,$ep,$arg);
    }  
  }
}
fclose($fn);
echo "Finished processing ".$argv[1].PHP_EOL;
?>
