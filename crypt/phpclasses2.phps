<?php
// 59.907835006714
// 57.763930082321

// http://www.phpclasses.org/browse/package/4238.html

include('AESCipher.class.php');

$plaintext = '';
for ($i = 0; $i < 150000; $i++) {
    $plaintext.= chr(mt_rand(0, 255));
}

$start = microtime(true);

$aes = new AESCipher(AES::AES128);
$aes->encrypt($plaintext, 'abcdefghijklmnop');

$elapsed = microtime(true) - $start;
echo "Elapsed time: $elapsed";