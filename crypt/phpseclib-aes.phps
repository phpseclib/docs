<?php
// 1.8914740085602
// 1.9603130817413

// http://phpseclib.sourceforge.net/

include('Crypt/AES.php');

$plaintext = '';
for ($i = 0; $i < 1024*1024; $i++) {
    $plaintext.= chr(mt_rand(0, 255));
}

$start = microtime(true);

define('CRYPT_AES_MODE', CRYPT_AES_MODE_INTERNAL);
$aes = new Crypt_AES();
$aes->setKey('abcdefghijklmnop');
$aes->encrypt($plaintext);

$elapsed = microtime(true) - $start;
echo "Elapsed time: $elapsed";