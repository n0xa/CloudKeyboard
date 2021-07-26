<?php
include('devices.php');
echo '<html> <body> <center> <form action="post.php" method="POST"> <input type="hidden" name="ep" value="kb">
    Keyboard input:
    <input type="text" name="arg">
Device:
';
foreach($devices as $device){
if($_REQUEST['dev']==$device['name']){
  $chk="CHECKED";
}else{
  $chk="";
}
printf("<input type='radio' name='device' value='%s' %s> <a href='%s?dev=%s'>%s</a><br />", $device['id'], $chk, $_SERVER['PHP_SELF'], $device['name'], $device['name']);
}
echo ' <input type="submit" value="Send it!"> </form>

  <form action="post.php" method="POST">
    Send keystroke:
    <input type="text" name="arg">
    <input type="radio" name="ep" value="scancode" CHECKED>No Modifier
    <input type="radio" name="ep" value="shft">Shift
    <input type="radio" name="ep" value="win">Win/Command
    <input type="radio" name="ep" value="alt">Alt
    <input type="radio" name="ep" value="ctl">Ctrl
    <input type="radio" name="ep" value="ctlalt">Ctrl+Alt
Device:
';
foreach($devices as $device){
if($_REQUEST['dev']==$device['name']){
  $chk="CHECKED";
}else{
  $chk="";
}
printf("<input type='radio' name='device' value='%s' %s> <a href='%s?dev=%s'>%s</a><br />", $device['id'], $chk, $_SERVER['PHP_SELF'], $device['name'], $device['name']);
}
?>
    <input type="submit" value="Send it!">
  </form>


  </center>
  </body>
</html>
