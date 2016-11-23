<?php
require('Pinger.php');

use anovsiradj\Pinger;

// without http(s)://
$ping = Pinger::init('my-web1', 'dev-avz.rhcloud.com');
$ping->connect(); // START

echo "<pre>";

// METHOD 01:
var_dump($ping->status);
var_dump($ping->time);
var_dump(ceil($ping->time));
var_dump(floor($ping->time));
// METHOD 02:
var_dump(Pinger::init('my-web1')->errno);
var_dump(Pinger::init('my-web1')->errstr);

try {
	Pinger::init('my-web2')->connect();
} catch (Exception $e) {
	echo "\n", $e->getMessage(), "\n";
}

echo "\nkeep goin..., ", __FILE__;
