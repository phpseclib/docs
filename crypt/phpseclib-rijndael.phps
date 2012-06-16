<?php
// 2.8350601196289
// 2.5328509807587
// 2.4909479618073
// 2.6457149982452
// 2.6204810142517

// http://phpseclib.sourceforge.net/

include('Crypt/Rijndael.php');

$plaintext = '';
for ($i = 0; $i < 150000; $i++) {
    $plaintext.= chr(mt_rand(0, 255));
}

$start = microtime(true);

$aes = new Crypt_Rijndael();
$aes->setKey('abcdefghijklmnop');
$aes->encrypt($plaintext);

$elapsed = microtime(true) - $start;
echo "Elapsed time: $elapsed";