<?php
$keys = array('movable-type.php', 'phpaes.php', 'phpclasses1.php', 'phpclasses2.php', 'phpseclib.php');

$results = array();

foreach ($keys as $bin) {
	echo "php55 $bin";

	$result = preg_replace('#.*Elapsed time: #', '', shell_exec("php55 $bin"));
	$result2= preg_replace('#.*Elapsed time: #', '', shell_exec("php55 $bin"));

	$elapsed = ($result + $result2) / 2;

	$results[$bin .'s'] = $elapsed;

	echo " = $elapsed\r\n";
}

echo "\r\n";

foreach ($results as $key => $result) {
	echo '            <tr>
              <td><a href="' . $key . '">' . $key . '</a></td>
              <td>' . $result . '</td>
            </tr>';
	echo "\r\n";
}