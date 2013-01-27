<?php
// 52.062352180481
// 51.86350107193

// http://www.phpclasses.org/browse/package/4238.html

include('AESCipher.class.php');

$plaintext = '';
for ($i = 0; $i < 1024*1024; $i++) {
    $plaintext.= chr(mt_rand(0, 255));
}

$start = microtime(true);

$aes = new AESCipher(AES::AES128);
$aes->encrypt($plaintext, 'abcdefghijklmnop');

$elapsed = microtime(true) - $start;
echo "Elapsed time: $elapsed";