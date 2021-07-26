<?php                                                                                                                                            
// Displays a list of devices associated to your Particle.io account
include_once('devices.php');
// header 
printf('%3s|%-25s|%-20s|%-20s'.PHP_EOL,'On' ,'id','name','last_heard');
foreach($devices as $device){
  printf('%3s|%-25s|%-20s|%-20s'.PHP_EOL,$device['online']==1 ? 'Y' : 'N' ,$device['id'],$device['name'],$device['last_heard']);
}
<?php
