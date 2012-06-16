<?php
// 2.073441028595
// 2.0408551692963
// 2.0222070217133
// 2.017117023468
// 2.025456905365

// http://phpseclib.sourceforge.net/

include('Crypt/AES.php');

$plaintext = '';
for ($i = 0; $i < 150000; $i++) {
    $plaintext.= chr(mt_rand(0, 255));
}

$start = microtime(true);

define('CRYPT_AES_MODE', CRYPT_AES_MODE_INTERNAL);
$aes = new Crypt_AES();
$aes->setKey('abcdefghijklmnop');
$aes->encrypt($plaintext);

$elapsed = microtime(true) - $start;
echo "Elapsed time: $elapsed";