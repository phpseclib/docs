<?php
// 14.464425087
// 15.1086549759
// 14.0526640415
// 16.6648478508
// 14.759483099

// http://www.phpclasses.org/browse/package/3650.html

include('AES128.php');

$plaintext = '';
for ($i = 0; $i < 150000; $i++) {
    $plaintext.= chr(mt_rand(0, 255));
}

$start = microtime(true);

$aes = new AES128(true);
$key = $aes->makeKey('abcdefghijklmnop');
for ($i = 0; $i < 150000; $i+=16) {
    $aes->blockEncrypt(substr($plaintext, $i, 16), $key);
}

$elapsed = microtime(true) - $start;
echo "Elapsed time: $elapsed";