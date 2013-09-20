<?php
include('Math/BigInteger.php');
include('Crypt/RSA.php');
//include('PHP/Compat/Function/str_split.php');
//include('PHP/Compat/Function/bcpowmod.php');

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

define('MATH_BIGINTEGER_MODE', MATH_BIGINTEGER_MODE_GMP);

$start = microtime_float();

$rsa = new Crypt_RSA();

$plaintext = '...';

$rsa->loadKey('-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAylq1ZRSREX7DWHUKg4HX
KGN5C8GQgasXaobkF0J5ok/TfDQnG4WntB/brjQaQRN9phFovHEClj2XywYfL/s9
syHHioaVOIMZ86cLP7xzJc6dF/bydPLD1p14DkpJLgCSx6CyTlFzOhmm4/YMEh4t
XR8FHY1f3pgWwEDXkkMKo/2U5FIIH0HBfnXgZeYSw7DalriaiZ+PyxpnqfYA5TT2
AXCiguSHlo14ZEf/dwNlDmEfjBLrJPltOp69ZlqZYeykuEjg54KbvR2EMjQWj3V6
9sh1jPZvEeK8Tw/3E+aC4AoQzOB0VLF56yn1yfMZFvBRYd6RAhtcoU7Lli3/J7c3
ewIDAQAB
-----END PUBLIC KEY-----'); // public key

$rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
$ciphertext = $rsa->encrypt($plaintext);

$rsa->loadKey('-----BEGIN RSA PRIVATE KEY-----
MIIEpQIBAAKCAQEAylq1ZRSREX7DWHUKg4HXKGN5C8GQgasXaobkF0J5ok/TfDQn
G4WntB/brjQaQRN9phFovHEClj2XywYfL/s9syHHioaVOIMZ86cLP7xzJc6dF/by
dPLD1p14DkpJLgCSx6CyTlFzOhmm4/YMEh4tXR8FHY1f3pgWwEDXkkMKo/2U5FII
H0HBfnXgZeYSw7DalriaiZ+PyxpnqfYA5TT2AXCiguSHlo14ZEf/dwNlDmEfjBLr
JPltOp69ZlqZYeykuEjg54KbvR2EMjQWj3V69sh1jPZvEeK8Tw/3E+aC4AoQzOB0
VLF56yn1yfMZFvBRYd6RAhtcoU7Lli3/J7c3ewIDAQABAoIBAQDIeuowxRmc/bxI
TV0nQWKLr1Hj5dhnv7ypXA9rQ/8CYpgi/ACq8dZfTRj3FMPWKZtZBvJ/kG+BrnBP
Qzdu8DoG2ba6dfAtVyZFEgDBGtHyaSuW7KD2YPbKEKU7cznhi8vgYEOH+IZyz6tb
OxBmeuNy2SLWTpTnEkOoIhXx4N4P7Y7cTWE3eAnaVNf7moeL12lj6FYp0SwEQbtd
lLCRN/Sts+6zIrQGwGO/+y7GK8LY6IqGZtf95eoGy5+OSnDSpddC5UXUG+9oIcrT
5N3V1o+t1vYGMl93LO+dGYUugF3O3YQGlxGcJM57Cps57f56bhttZF6FVtsK7DJI
X/vfVMHBAoGBAPHdHZ50HhxgN/yuWPtXTqTeAkVFi1VQAn+BKFiYwyRAiOY68YZX
LwwqXa9Rc1uCUDKXHLGMPGAgZTfb6z19EAsGG08LQbeClZM0Jm1c83skqN8mnbrn
nPSiFc09hSHRLmul195xOkpb0IxZ+8oeljXnbz6IJagzHLP40lvHx/rrAoGBANYu
bwjrRDDWnaQQbPY3Z9fTHx9AD2ErPyVsg+OGvUqDGtTU/32kYR4anUkNaldLcI3k
/QtYgxwE0zcCn9+fmfwYXvIEfmJG1+NH6Mw0rLt15qO6vhZ/fx6ewV0ZtTUvxj2X
yGO5gXE26v3Il+KtlIXm3DBFR5/3+wQIbtaT03GxAoGBAN8dtJoc0j4pANznVQyf
sNvkNcIDcpKD2ZoX4slAOxxxMBj7HR1pxev6FSyK/djX8PWKcxzSmkuu9tC93ld9
zFPvETgs0TXhj+wYuq4+hhn+ao5YyD7INQFzmJsZ+nuExcbmWapJV5WK92rSA7Wj
27vkQLo1zE9Kv1rC2gNy2+d7AoGBAInpFjfg/WSRHKpipTaZEHVpDNYbcou3xA49
5GKiBMqwxpsal3R4Xsx6iKJcUAfrnIrRUpp2oN1uwe3e88CTTRyFOMWPXS28vhAr
4lty43JFhYARo4prCBhYUtu2zPZ1T6mjTTXhYdbbbM6C1kHwUP0zXL58LZV0oJ3F
LFFgmDrRAoGAS9i9FLcipuff0n+1e83rRiE78rAYqA345Y5exakEqfW/orTDfYcq
or0jV1Oh8ZpspoQCEgei9pmP8BoN3j4JCV6sOduXPsRQfIqV7zAFCcIEqxnG1Xhz
vnGFhUKyff8ObWammbWnYnnzXnXRCL+982W8LoOhTzTv7LuSIMq3eOg=
-----END RSA PRIVATE KEY-----'); // private key
echo $rsa->decrypt($ciphertext);

$elapsed = microtime_float() - $start;

echo "\r\ntook $elapsed seconds";