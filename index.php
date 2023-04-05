<?php

$currentTimeSince1970 = time();
$currentDate = date('m.d', $currentTimeSince1970);
$currentDateArray = explode('.', $currentDate);

$currentMounth = $currentDateArray[0];
$currentDay = $currentDateArray[1];

if ($currentMounth == 12 && $currentDay >= 17) {
	include 'online-store.php';
} else {
	include 'timer.php';
}

 

?>