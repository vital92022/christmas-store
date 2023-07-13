<?php

spl_autoload_register(function($class){
	include 'classes/' . $class . '.php';
});

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

/*$sql = "
	CREATE TABLE IF NOT EXISTS goods
	(
		id int NOT NULL AUTO_INCREMENT,
		name varchar(255) NOT NULL,
		price varchar(255) NOT NULL,
		image varchar(255) NOT NULL,
		PRIMARY KEY(id)
	) CHARSET=utf8
";*/

/*$sql = "
	INSERT INTO goods (`name`, `price`, `image`) 
	VALUES 
	('Шоколадный дед мороз', '100 руб.', 'static/img/product-2.png'),
	('Новогодняя Ёлка', '9900 руб.', 'static/img/product-3.jpg'),
	('Сладкая коробка', '600 руб.', 'static/img/product-4.jpg'),
	('Фигурка деда мороза', '2000 руб.', 'static/img/product-5.jpg'),
	('Новогодний шар', '3000 руб.', 'static/img/product-6.jpg'),
	('Шар на елку', '300 руб.', 'static/img/product-7.jpg'),
	('Мишура', '120 руб.', 'static/img/product-8.jpg'),
	('Гирлянда \"Лампочки\"', '1200 руб.', 'static/img/product-9.jpg'),
	('Новогоднее шампанское', '240 руб.', 'static/img/product-10.jpg'),
	('Коробка конфет', '250 руб.', 'static/img/product-11.jpg'),
	('Подарок \"Сюрприз\"', '900 руб.', 'static/img/product-12.jpg'),
	('Звезда на Елку', '400 руб.', 'static/img/product-13.jpg'),
	('Шапка новогодняя', '600 руб.', 'static/img/product-14.jpg'),
	('Бенгальские огни', '100 руб.', 'static/img/product-15.jpg'),
	('Хлопушка', '80 руб.', 'static/img/product-16.png')
";*/

//$res = $PDO->PDO->query($sql);

//var_dump($res);

//die();

$currentMounth = 12;
$currentDay = 18;

if ($currentMounth == 12 && $currentDay >= 17) {

	$PDO = PdoConnect::getInstance();

	/*$sql = "
	CREATE TABLE IF NOT EXISTS orders
	(
		id int NOT NULL AUTO_INCREMENT,
		fio varchar(255) NOT NULL,
		phone varchar(255) NOT NULL,
		email varchar(255) NOT NULL,
		comment text NOT NULL,
		product_id int NOT NULL,
		PRIMARY KEY(id)
	) CHARSET=utf8
	";

	$result = $PDO->PDO->query($sql);
	var_dump($result);*/

	$result = $PDO->PDO->query("
		SELECT * FROM `goods`
	");

	$products = array();

	while ($productInfo = $result->fetch()){
		$products[] = $productInfo;
	}

	include 'online-store.php';
} else {
	include 'timer.php';
}

?>