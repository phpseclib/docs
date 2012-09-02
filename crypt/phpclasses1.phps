<?php
// 25.180118083954
// 25.612590074539

// http://www.phpclasses.org/browse/package/3650.html

include('AES128.php');

$plaintext = '';
for ($i = 0; $i < 1024*1024; $i++) {
    $plaintext.= chr(mt_rand(0, 255));
}

$start = microtime(true);

$aes = new AES128(true);
$key = $aes->makeKey('abcdefghijklmnop');
for ($i = 0; $i < 1024*1024; $i+=16) {
    $aes->blockEncrypt(substr($plaintext, $i, 16), $key);
}

$elapsed = microtime(true) - $start;
echo "Elapsed time: $elapsed";