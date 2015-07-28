<?php
// https://raw.githubusercontent.com/openssl/openssl/master/crypto/objects/objects.README

$lines = file('https://raw.githubusercontent.com/openssl/openssl/master/crypto/objects/objects.txt');
array_shift($lines);
$objects = $cat_search = $cat_replace = array();
$cname = $module = false;
foreach ($lines as $line) {
	$line = trim($line);
	switch (true) {
		case preg_match('#!Alias ([^ ]+) (.+)#', $line, $matches):
			$temp = $matches[1];
			$matches[1] = $matches[2];
			$matches[2] = $temp;
			break;
		case preg_match('#!Cname (.+)#', $line, $matches):
			$cname = $matches[1];
			continue 2;
		case preg_match('#!module (.+)#', $line, $matches):
			$module = $matches[1];
			continue 2;
		case $line == '!global':
			$module = false;
			continue 2;
		case preg_match('/[#:]/', $line[0]) || !strlen($line):
		case !preg_match('#([^:]+):([^:]+):?(.+)?#', $line, $matches):
			continue;
	}
	array_shift($matches);
	$matches = array_map('trim', $matches);
	$oid = strtolower($matches[0]);

	while ($oid != ($temp = preg_replace($cat_search, $cat_replace, $oid))) {
		$oid = $temp;
	}
	$oid = str_replace(' ', '.', $oid);
	// !module X9-62 + !Alias c-TwoCurve X9-62_ellipticCurve 0 == X9-62_c-TwoCurve
	// !module X9-62 + !Alias ellipticCurve ansi-X9-62 3 == X9-62_ellipticCurve
	if ($module !== false && isset($matches[1]) && !empty($matches[1])) {
		$matches[1] = $module . '_' . $matches[1];
	}

	if (isset($matches[1]) && !empty($matches[1])) {
		$cat_search[] = '#^' . strtolower($matches[1]) . ' #';
		$cat_replace[]= $oid . ' ';
	}
	if ($cname !== false) {
		$cat_search[] = '#^' . strtolower($cname) . ' #';
		$cat_replace[]= $oid . ' ';
		$cname = false;
	}

	if (preg_match('#^\d+(\.\d+)+$#', $oid)) {
		$objects[$oid] = isset($matches[2]) ? $matches[2] : $matches[1];
	}
}

foreach ($objects as $key=>$value) {
	echo "    '$key' => '$value',\r\n";
}