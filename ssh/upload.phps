<?php
$start = microtime(true);

$ssh = ssh2_connect('www.domain.tld');
ssh2_auth_password($ssh, 'username', 'password');

$sftp = ssh2_sftp($ssh);

$fp = fopen('ssh2.sftp://'.$sftp.'/home/username/1mb', 'w');

fwrite($fp, str_repeat('a', 1024 * 1024));
$elapsed = microtime(true) - $start;

echo "remotehost / libssh2 took $elapsed seconds\r\n";

// --------------------------------------

$start = microtime(true);

$ssh = ssh2_connect('127.0.0.1');
ssh2_auth_password($ssh, 'username', 'passwprd');

$sftp = ssh2_sftp($ssh);

$fp = fopen('ssh2.sftp://'.$sftp.'/1mb', 'w');

fwrite($fp, str_repeat('a', 1024 * 1024));
$elapsed = microtime(true) - $start;

echo "localhost / libssh2 took $elapsed seconds\r\n";

// --------------------------------------

include('Net/SFTP.php');

$start = microtime(true);

$sftp = new Net_SFTP('www.domain.tld');
$sftp->login('username', 'password');

$sftp->put('1mb', str_repeat('a', 1024 * 1024));

$elapsed = microtime(true) - $start;

echo "remotehost / phpseclib took $elapsed seconds\r\n";

// --------------------------------------

$start = microtime(true);

$sftp = new Net_SFTP('127.0.0.1');
$sftp->login('username', 'password');

$sftp->put('1mb', str_repeat('a', 1024 * 1024));

$elapsed = microtime(true) - $start;

echo "localhost / phpseclib took $elapsed seconds\r\n";