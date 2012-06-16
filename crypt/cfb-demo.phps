<?php
/*
In theory, encrypting a string using a stream cipher should yield the same results no matter how that string is partitioned out.
At least when enableContinuousBuffer() has been called.  This is not the case with mcrypt.  The following code demonstrates
how phpseclib's rewritten CFB implementation (CFB mode is one of several modes that turn block ciphers into stream ciphers)
guarantees this behavior.

To test it out with mcrypt's default behavior do the following:

#
#-----[ OPEN ]------------------------------------------
#
Crypt/AES.php
#
#-----[ FIND ]------------------------------------------
#
            if ($this->mode == 'ncfb') {
#
#-----[ REPLACE WITH ]----------------------------------
#
            if (false) {

This departure from mcrypt is inspired by the following discussion at sci.crypt:

https://groups.google.com/group/sci.crypt/msg/477bd67aceeecab4?hl=ne
*/
include('Crypt/AES.php');
//define('CRYPT_AES_MODE', CRYPT_AES_MODE_INTERNAL);

echo CRYPT_AES_MODE == CRYPT_AES_MODE_INTERNAL ? "pure php\r\n" : "mcrypt\r\n";

$aes = new Crypt_AES(CRYPT_AES_MODE_CFB);
$aes->enableContinuousBuffer();
$aes->setKey(str_repeat('a', 24));
$aes->setIV(str_repeat('b', 8));

$aes2= clone $aes;

$blocks = array(10, 5, 17, 16);

$total = 0;
foreach ($blocks as $block) {
    $total+= $block;
}

$ciphertext = $aes2->decrypt(str_repeat('c', $total));
$total = 0;
foreach ($blocks as $block) {
    echo bin2hex(substr($ciphertext, $total, $block)) . "\r\n";
    $total+= $block;
}

echo "\r\n";

foreach ($blocks as $block) {
    echo bin2hex($aes->decrypt(str_repeat('c', $block))) . "\r\n";
}