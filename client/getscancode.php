<?PHP
if(empty($argv[1])){
	echo "Please enter a key name as the argument.".PHP_EOL;
	echo "   Examples:  R  END  F4  RETURN  PAGEUP  KP7".PHP_EOL;
	die(1);
}
include_once('scancodes.php');
print_r(scancode($argv[1]));
?>
