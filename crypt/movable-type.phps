<?php
// 28.423454999924
// 28.079409122467

// http://www.movable-type.co.uk/scripts/aes-php.html

include('aes.php');

$plaintext = '';
for ($i = 0; $i < 1024*1024; $i++) {
    $plaintext.= chr(mt_rand(0, 255));
}

$start = microtime(true);

AESCtr::encrypt($plaintext, 'abcdefghijklmnop', 128);

$elapsed = microtime(true) - $start;

echo "Elapsed time: $elapsed";