<?php // 201611231421

// By ShadowScripter (http://stackoverflow.com/a/9843251/3036312)

// Function to check response time
function pingDomain($domain, $port = 80) {
	$starttime = microtime(true);
	$file      = fsockopen($domain, $port, $errno, $errstr, 10);
	$stoptime  = microtime(true);
	$status    = 0;
	if (!$file) $status = -1;  // Site is down
	else {
		fclose($file);
		$status = ($stoptime - $starttime) * 1000;
		$status = floor($status);
	}

	return $status;
}

echo "<pre>";

$respond = pingDomain('dev-avz.rhcloud.com');
var_dump($respond);