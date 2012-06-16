<?php
// 40.9256269932
// 39.563421011
// 39.6149320602
// 40.2694010735
// 39.3952429295

// http://www.phpaes.com/

include('AES.class.php');

$plaintext = '';
for ($i = 0; $i < 150000; $i++) {
    $plaintext.= chr(mt_rand(0, 255));
}

$start = microtime(true);

$aes = new AES('abcdefghijklmnop');
$aes->encrypt($plaintext);

$elapsed = microtime(true) - $start;
echo "Elapsed time: $elapsed";