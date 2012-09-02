<?php
// 10.424788951874
// 10.447833061218

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