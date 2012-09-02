<?php
// 30.751706123352
// 31.477724075317

// http://www.movable-type.co.uk/scripts/aes-php.html

include('aes.php');

$plaintext = '';
for ($i = 0; $i < 1024*1024; $i++) {
    $plaintext.= chr(mt_rand(0, 255));
}

$start = microtime(true);

AESEncryptCtr($plaintext, 'abcdefghijklmnop', 128);

$elapsed = microtime(true) - $start;

echo "Elapsed time: $elapsed";