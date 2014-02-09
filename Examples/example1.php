<?php

$fileHandle = fopen("Examples/example1_scribed.txt", 'c+');

$myArray = array(1, 2, 3);
foreach($myArray as $elem) {
	echo $elem  . "\n";
	fprintf($fileHandle, $elem);
}

sleep(10);

$randValue = rand(10, 12);
if ($randValue == 10) {
	echo "I have rolled a die and it hath landed on ten.";
} elseif ($randValue == 11) {
	echo "I have rolled a die and it hath landed on eleven.";
} else {
	echo "I deduce I must have rolled a twelve."  . "\n";
}

fclose($fileHandle);

date_default_timezone_set("UTC");
$dayNum = date('w');
switch($dayNum) {
	case 0:
		echo "Today is Sunday!"  . "\n";
		break;
	case 1:
		echo "Today is Monday!"  . "\n";
		break;
	case 2:
		echo "Today is Tuesday!"  . "\n";
		break;
	case 3:
		echo "Today is Wednesday!"  . "\n";
		break;
	case 4:
		echo "Today is Thursday!"  . "\n";
		break;
	case 5:
		echo "Today is Friday!"  . "\n";
		break;
	default:
		echo "Today is Saturday!"  . "\n";
}

?>