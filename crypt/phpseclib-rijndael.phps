<?php
// 3.2925698757172
// 3.3214590549469

// http://phpseclib.sourceforge.net/

include('Crypt/Rijndael.php');

$plaintext = '';
for ($i = 0; $i < 1024*1024; $i++) {
    $plaintext.= chr(mt_rand(0, 255));
}

$start = microtime(true);

$aes = new Crypt_Rijndael();
$aes->setKey('abcdefghijklmnop');
$aes->encrypt($plaintext);

$elapsed = microtime(true) - $start;
echo "Elapsed time: $elapsed";