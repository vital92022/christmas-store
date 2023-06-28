<?php

function secondToDate($mounth, $day) {
	$currentDate = date('Y.m.d.H.i.s', time());
	$currentDateArray = explode('.', $currentDate);

	if ($currentDateArray[1] > $mounth || ($currentDateArray[1] == $mounth && $currentDateArray[2] > $day)){
		$year = $currentDateArray[0] + 1;
	} elseif ($currentDateArray[1] == $mounth && $currentDateArray[2] == $day) {
		return 0;
	} else {
		$year = $currentDateArray[0];
	}

	$dateFrom = date_create($currentDateArray[0] . "-" . $currentDateArray[1] . "-" . $currentDateArray[2] . " " . $currentDateArray[3] . ":" . $currentDateArray[4] . ":" . $currentDateArray[5]);
	$dateTo = date_create($year . "-" . $mounth . "-" . $day);

	$dateDifference = date_diff($dateTo, $dateFrom);

	return  ($dateDifference->y * 365 * 24 * 60 * 60) +
			($dateDifference->m * 30 * 24 * 60 *60) +
			($dateDifference->d * 24 * 60 * 60) +
			($dateDifference->h * 60 *60) +
			($dateDifference->i * 60) +
			$dateDifference->s;
}

$secondTo = secondToDate(12, 31);

$currentTimeSince1970 = time();
$currentDate = date('m.d', $currentTimeSince1970);
$currentDateArray = explode('.', $currentDate);

$currentMounth = $currentDateArray[0];
$currentDay = $currentDateArray[1];

include "classes/PdoConnect.php";

$PDO = PdoConnect::getInstance();

var_dump($PDO);

die();

if ($currentMounth == 12 && $currentDay >= 17) {
	include 'online-store.php';
} else {
	include 'timer.php';
}

 

?>