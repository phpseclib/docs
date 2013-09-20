<?php
$keys = array('PHP 4.4', 'PHP 5.0', 'PHP 5.1', 'PHP 5.2', 'PHP 5.3', 'PHP 5.4', 'PHP 5.5');
$bins = array('php44', 'php50', 'php51', 'php52', 'php53', 'php54', 'php55');

$results = array();
$max = 0;

foreach ($bins as $key => $bin) {
	for ($i = 1; $i <= 5; $i++) {
		switch ($bin) {
			case 'php44':
			case 'php50':
				if ($i >= 5) {
					continue 2;
				}
		}

		echo "$bin col$i.php";

		$result = substr(shell_exec("$bin col$i.php"), 8);
		if ($result[0] != ' ') {
			exit("FAILED ON $bin / col$i");
		}
		$result = substr($result, 1);
		if (!isset($results[$keys[$key]])) {
			$results[$keys[$key]] = array();
		}

		$result2 = substr(shell_exec("$bin col$i.php"), 9);
		$elapsed = ($result + $result2) / 2;
		if ($elapsed > $max) {
			$max = $elapsed;
		}
		$results[$keys[$key]][] = $elapsed;

		echo " = $elapsed\r\n";
	}
}

echo "\r\n";

foreach ($results as $key => $result) {
	echo '<tr><td style="background: yellow"><b>' . $key . '</b></td>';
	for ($i = 0; $i < 5; $i++) {
		if (!isset($result[$i])) {
			echo '<td style="border: 0; background: white"></td>';
			continue;
		}
		$r = intval(($result[$i] / $max) * 255);
		$gb = 255 - $r;
		$r = str_pad(dechex($r), 2, '0', STR_PAD_RIGHT);
		$gb = str_pad(dechex($gb), 2, '0', STR_PAD_RIGHT);
		echo '<td style="background: #ff' . $gb . $gb . '">' . number_format($result[$i], 3) . '</td>';
	}
	echo '</tr>';
	echo "\r\n";
}