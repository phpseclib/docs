<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="google-site-verification" content="DHz4kg_uhBzFTmMZSrMTtF9lqPofgrUucAmZrsakViI" />
<meta name="keywords" content="SSH,SFTP,RSA,PHP,AES,Rijndael,3DES,RC4,SSH2,SSH1,X.509,X509" />
<meta name="description" content="A pure-PHP ASN.1 parser returning output identical to OpenSSL's asn1parse" />
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-19770173-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<title>phpseclib: ASN.1 Parser</title>
<link rel="stylesheet" href="../css/reset.css" />
<link rel="stylesheet" href="../css/text.css" />
<link rel="stylesheet" href="../css/960.css" />
<link rel="stylesheet" href="../css/prettify.css"/>
<script src="../js/prettify.js"></script>
<script src="../js/jquery-1.7.2.min.js"></script>

<style media="screen">
h1 { text-align: left; margin-bottom: 0 }.red { color: #e11 }
.prettyprint, .pre { background: #f5f4ee; max-height: 350px; overflow: scroll }
h2 { font-size: 15px }
code { background: #ffa }
#permlink { text-align: right }
#permlink span { font-size: 10px; color: blue; text-decoration: underline; cursor: pointer }
.buttonOff { display: none }
ul { margin-bottom: 0 }
#pgup { font-size: 10px; margin-bottom: 2em }
#cert:hover { cursor: hand }
table,td { border: 1px solid black; padding: 4px }
</style></head>

<body onload="prettyPrint()">

<a href="https://github.com/phpseclib/docs/blob/master/x509/asn1parse.php"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_green_007200.png" alt="Fork me on GitHub"></a>

<div class="container_12">
  <div class="grid_12">
    <h1>php<span class="red">sec</span>lib: ASN.1 Parser</h1>
    <div id="pgup">(return to <a href="decoder.php">phpseclib: X.509 Decoder</a>)</div>
  </div>
  <div class="clear"></div>
  <div class="grid_3">
    <div style="color: gray">
      The asn1parse command is a diagnostic utility that can parse ASN.1 structures. It can also be used to extract data from ASN.1 formatted data.
    </div>
  </div>
  <!-- end .grid_3 -->
  <div class="grid_9">
    <div>
<?php
if (!isset($_POST['cert']) && empty($_FILES)):
?>
<form enctype="multipart/form-data" action="" method="POST">
Copy / paste file to decode:<br />
<textarea name="cert" cols="80" rows="20">-----BEGIN CERTIFICATE-----
MIIDITCCAoqgAwIBAgIQT52W2WawmStUwpV8tBV9TTANBgkqhkiG9w0BAQUFADBM
MQswCQYDVQQGEwJaQTElMCMGA1UEChMcVGhhd3RlIENvbnN1bHRpbmcgKFB0eSkg
THRkLjEWMBQGA1UEAxMNVGhhd3RlIFNHQyBDQTAeFw0xMTEwMjYwMDAwMDBaFw0x
MzA5MzAyMzU5NTlaMGgxCzAJBgNVBAYTAlVTMRMwEQYDVQQIEwpDYWxpZm9ybmlh
MRYwFAYDVQQHFA1Nb3VudGFpbiBWaWV3MRMwEQYDVQQKFApHb29nbGUgSW5jMRcw
FQYDVQQDFA53d3cuZ29vZ2xlLmNvbTCBnzANBgkqhkiG9w0BAQEFAAOBjQAwgYkC
gYEA3rcmQ6aZhc04pxUJuc8PycNVjIjujI0oJyRLKl6g2Bb6YRhLz21ggNM1QDJy
wI8S2OVOj7my9tkVXlqGMaO6hqpryNlxjMzNJxMenUJdOPanrO/6YvMYgdQkRn8B
d3zGKokUmbuYOR2oGfs5AER9G5RqeC1prcB6LPrQ2iASmNMCAwEAAaOB5zCB5DAM
BgNVHRMBAf8EAjAAMDYGA1UdHwQvMC0wK6ApoCeGJWh0dHA6Ly9jcmwudGhhd3Rl
LmNvbS9UaGF3dGVTR0NDQS5jcmwwKAYDVR0lBCEwHwYIKwYBBQUHAwEGCCsGAQUF
BwMCBglghkgBhvhCBAEwcgYIKwYBBQUHAQEEZjBkMCIGCCsGAQUFBzABhhZodHRw
Oi8vb2NzcC50aGF3dGUuY29tMD4GCCsGAQUFBzAChjJodHRwOi8vd3d3LnRoYXd0
ZS5jb20vcmVwb3NpdG9yeS9UaGF3dGVfU0dDX0NBLmNydDANBgkqhkiG9w0BAQUF
AAOBgQAhrNWuyjSJWsKrUtKyNGadeqvu5nzVfsJcKLt0AMkQH0IT/GmKHiSgAgDp
ulvKGQSy068Bsn5fFNum21K5mvMSf3yinDtvmX3qUA12IxL/92ZzKbeVCq3Yi7Le
IOkKcGQRCMha8X2e7GmlpdWC1ycenlbN0nbVeSv3JUMcafC4+Q==
-----END CERTIFICATE-----</textarea><br />
Upload certificate:<br />
<input name="pem" type="file" /><br /> 
<input type="submit" value="Decode" />
</form>
<?php
else:

echo '<pre style="whitespace: nowrap">';
include_once('File/ASN1.php'); 

$asn1 = new File_ASN1();
$str = !empty($_POST['cert']) ? $_POST['cert'] : file_get_contents($_FILES['pem']['tmp_name']);
$temp = preg_replace('#^(?:[^-].+[\r\n]+)+|-.+-|[\r\n]| #', '', $str);
$temp = preg_match('#^[a-zA-Z\d/+]*={0,2}$#', $temp) ? base64_decode($temp) : false;
if ($temp != false) {
    $str = $temp;
}

$result = $asn1->decodeBER($str);

// these oid descriptions come from openssl/master/crypto/objects/objects.h
$oids = array(
    '0' => 'undefined',
    '1.3.14.3.2' => 'algorithm',
    '1.2.840.113549' => 'rsadsi',
    '1.2.840.113549.1' => 'pkcs',
    '1.2.840.113549.2.2' => 'md2',
    '1.2.840.113549.2.5' => 'md5',
    '1.2.840.113549.3.4' => 'rc4',
    '1.2.840.113549.1.1.1' => 'rsaEncryption',
    '1.2.840.113549.1.1.2' => 'md2WithRSAEncryption',
    '1.2.840.113549.1.1.4' => 'md5WithRSAEncryption',
    '1.2.840.113549.1.5.1' => 'pbeWithMD2AndDES-CBC',
    '1.2.840.113549.1.5.3' => 'pbeWithMD5AndDES-CBC',
    '2.5' => 'X500',
    '2.5.4' => 'X509',
    '2.5.4.3' => 'commonName',
    '2.5.4.6' => 'countryName',
    '2.5.4.7' => 'localityName',
    '2.5.4.8' => 'stateOrProvinceName',
    '2.5.4.10' => 'organizationName',
    '2.5.4.11' => 'organizationalUnitName',
    '2.5.8.1.1' => 'rsadsi',
    '1.2.840.113549.1.7' => 'pkcs7',
    '1.2.840.113549.1.7.1' => 'pkcs7-data',
    '1.2.840.113549.1.7.2' => 'pkcs7-signedData',
    '1.2.840.113549.1.7.3' => 'pkcs7-envelopedData',
    '1.2.840.113549.1.7.4' => 'pkcs7-signedAndEnvelopedData',
    '1.2.840.113549.1.7.5' => 'pkcs7-digestData',
    '1.2.840.113549.1.7.6' => 'pkcs7-encryptedData',
    '1.2.840.113549.1.3' => 'pkcs3',
    '1.2.840.113549.1.3.1' => 'dhKeyAgreement',
    '1.3.14.3.2.6' => 'des-ecb',
    '1.3.14.3.2.9' => 'des-cfb',
    '1.3.14.3.2.7' => 'des-cbc',
    '1.3.14.3.2.17' => 'des-ede',
    '1.3.6.1.4.1.188.7.1.1.2' => 'idea-cbc',
    '1.2.840.113549.3.2' => 'rc2-cbc',
    '1.3.14.3.2.18' => 'sha',
    '1.3.14.3.2.15' => 'shaWithRSAEncryption',
    '1.2.840.113549.3.7' => 'des-ede3-cbc',
    '1.3.14.3.2.8' => 'des-ofb',
    '1.2.840.113549.1.9' => 'pkcs9',
    '1.2.840.113549.1.9.1' => 'emailAddress',
    '1.2.840.113549.1.9.2' => 'unstructuredName',
    '1.2.840.113549.1.9.3' => 'contentType',
    '1.2.840.113549.1.9.4' => 'messageDigest',
    '1.2.840.113549.1.9.5' => 'signingTime',
    '1.2.840.113549.1.9.6' => 'countersignature',
    '1.2.840.113549.1.9.7' => 'challengePassword',
    '1.2.840.113549.1.9.8' => 'unstructuredAddress',
    '1.2.840.113549.1.9.9' => 'extendedCertificateAttributes',
    '2.16.840.1.113730' => 'Netscape Communications Corp.',
    '2.16.840.1.113730.1' => 'Netscape Certificate Extension',
    '2.16.840.1.113730.2' => 'Netscape Data Type',
    '1.3.14.2.26.05 <- wrong */' => 'sha1',
    '1.2.840.113549.1.1.5' => 'sha1WithRSAEncryption',
    '1.3.14.3.2.13' => 'dsaWithSHA',
    '1.3.14.3.2.12' => 'dsaEncryption-old',
    '1.2.840.113549.1.5.11' => 'pbeWithSHA1AndRC2-CBC',
    '1.2.840.113549.1.5.12' => 'PBKDF2',
    '1.3.14.3.2.27' => 'dsaWithSHA1-old',
    '2.16.840.1.113730.1.1' => 'Netscape Cert Type',
    '2.16.840.1.113730.1.2' => 'Netscape Base Url',
    '2.16.840.1.113730.1.3' => 'Netscape Revocation Url',
    '2.16.840.1.113730.1.4' => 'Netscape CA Revocation Url',
    '2.16.840.1.113730.1.7' => 'Netscape Renewal Url',
    '2.16.840.1.113730.1.8' => 'Netscape CA Policy Url',
    '2.16.840.1.113730.1.12' => 'Netscape SSL Server Name',
    '2.16.840.1.113730.1.13' => 'Netscape Comment',
    '2.16.840.1.113730.2.5' => 'Netscape Certificate Sequence',
    '2.5.29' => '',
    '2.5.29.14' => 'X509v3 Subject Key Identifier',
    '2.5.29.15' => 'X509v3 Key Usage',
    '2.5.29.16' => 'X509v3 Private Key Usage Period',
    '2.5.29.17' => 'X509v3 Subject Alternative Name',
    '2.5.29.18' => 'X509v3 Issuer Alternative Name',
    '2.5.29.19' => 'X509v3 Basic Constraints',
    '2.5.29.20' => 'X509v3 CRL Number',
    '2.5.29.32' => 'X509v3 Certificate Policies',
    '2.5.29.35' => 'X509v3 Authority Key Identifier',
    '1.3.6.1.4.1.3029.1.2' => 'bf-cbc',
    '2.5.8.3.101' => 'mdc2',
    '2.5.8.3.100' => 'mdc2withRSA',
    '2.5.4.42' => 'givenName',
    '2.5.4.4' => 'surname',
    '2.5.4.43' => 'initials',
    '2.5.4.45' => 'uniqueIdentifier',
    '2.5.29.31' => 'X509v3 CRL Distribution Points',
    '1.3.14.3.2.3' => 'md5WithRSAEncryption',
    '2.5.4.5' => 'serialNumber',
    '2.5.4.12' => 'title',
    '2.5.4.13' => 'description',
    '1.2.840.113533.7.66.10' => 'cast5-cbc',
    '1.2.840.113533.7.66.12' => 'pbeWithMD5AndCast5CBC',
    '1.2.840.10040.4.3' => 'dsaWithSHA1-old',
    '1.3.14.3.2.29' => 'sha1WithRSAEncryption',
    '1.2.840.10040.4.1' => 'dsaWithSHA',
    '1.3.36.3.2.1' => 'ripemd160',
    '1.3.36.3.3.1.2' => 'ripemd160WithRSA',
    '1.2.840.113549.3.8' => 'rc5-cbc',
    '1.1.1.1.666.1' => 'run length compression',
    '1.1.1.1.666.2' => 'zlib compression',
    '2.5.29.37' => 'X509v3 Extended Key Usage',
    '1.3.6.1.5.5.7' => '',
    '1.3.6.1.5.5.7.3' => '',
    '1.3.6.1.5.5.7.3.1' => 'TLS Web Server Authentication',
    '1.3.6.1.5.5.7.3.2' => 'TLS Web Client Authentication',
    '1.3.6.1.5.5.7.3.3' => 'Code Signing',
    '1.3.6.1.5.5.7.3.4' => 'E-mail Protection',
    '1.3.6.1.5.5.7.3.8' => 'Time Stamping',
    '1.3.6.1.4.1.311.2.1.21' => 'Microsoft Individual Code Signing',
    '1.3.6.1.4.1.311.2.1.22' => 'Microsoft Commercial Code Signing',
    '1.3.6.1.4.1.311.10.3.1' => 'Microsoft Trust List Signing',
    '1.3.6.1.4.1.311.10.3.3' => 'Microsoft Server Gated Crypto',
    '1.3.6.1.4.1.311.10.3.4' => 'Microsoft Encrypted File System',
    '2.16.840.1.113730.4.1' => 'Netscape Server Gated Crypto',
    '2.5.29.27' => 'X509v3 Delta CRL Indicator',
    '2.5.29.21' => 'CRL Reason Code',
    '2.5.29.24' => 'Invalidity Date',
    '1.3.101.1.4.1' => 'Strong Extranet ID',
    '1.2.840.113549.1.12' => '',
    '1.2.840.113549.1.12. 1' => '',
    '1.2.840.113549.1.12. 1. 1' => 'pbeWithSHA1And128BitRC4',
    '1.2.840.113549.1.12. 1. 2' => 'pbeWithSHA1And40BitRC4',
    '1.2.840.113549.1.12. 1. 3' => 'pbeWithSHA1And3-KeyTripleDES-CBC',
    '1.2.840.113549.1.12. 1. 4' => 'pbeWithSHA1And2-KeyTripleDES-CBC',
    '1.2.840.113549.1.12. 1. 5' => 'pbeWithSHA1And128BitRC2-CBC',
    '1.2.840.113549.1.12. 1. 6' => 'pbeWithSHA1And40BitRC2-CBC',
    '1.2.840.113549.1.12. 10' => '',
    '1.2.840.113549.1.12. 10. 1' => '',
    '1.2.840.113549.1.12. 10. 1. 1' => 'keyBag',
    '1.2.840.113549.1.12. 10. 1. 2' => 'pkcs8ShroudedKeyBag',
    '1.2.840.113549.1.12. 10. 1. 3' => 'certBag',
    '1.2.840.113549.1.12. 10. 1. 4' => 'crlBag',
    '1.2.840.113549.1.12. 10. 1. 5' => 'secretBag',
    '1.2.840.113549.1.12. 10. 1. 6' => 'safeContentsBag',
    '1.2.840.113549.1.9. 20' => 'friendlyName',
    '1.2.840.113549.1.9. 21' => 'localKeyID',
    '1.2.840.113549.1.9. 22' => '',
    '1.2.840.113549.1.9. 22. 1' => 'x509Certificate',
    '1.2.840.113549.1.9. 22. 2' => 'sdsiCertificate',
    '1.2.840.113549.1.9. 23' => '',
    '1.2.840.113549.1.9. 23. 1' => 'x509Crl',
    '1.2.840.113549.1.5.13' => 'PBES2',
    '1.2.840.113549.1.5.14' => 'PBMAC1',
    '1.2.840.113549.2.7' => 'hmacWithSHA1',
    '1.3.6.1.5.5.7.2.1' => 'Policy Qualifier CPS',
    '1.3.6.1.5.5.7.2.2' => 'Policy Qualifier User Notice',
    '1.2.840.113549.1.9.15' => 'S/MIME Capabilities',
    '1.2.840.113549.1.5.4' => 'pbeWithMD2AndRC2-CBC',
    '1.2.840.113549.1.5.6' => 'pbeWithMD5AndRC2-CBC',
    '1.2.840.113549.1.5.10' => 'pbeWithSHA1AndDES-CBC',
    '1.3.6.1.4.1.311.2.1.14' => 'Microsoft Extension Request',
    '1.2.840.113549.1.9.14' => 'Extension Request',
    '2.5.4.41' => 'name',
    '2.5.4.46' => 'dnQualifier',
    '1.3.6.1.5.5.7.1' => '',
    '1.3.6.1.5.5.7.48' => '',
    '1.3.6.1.5.5.7.1.1' => 'Authority Information Access',
    '1.3.6.1.5.5.7.48.1' => 'OCSP',
    '1.3.6.1.5.5.7.48.2' => 'CA Issuers',
    '1.3.6.1.5.5.7.3.9' => 'OCSP Signing'
);

function make_printable($result, $i = 0)
{
    global $oids, $str;

    $length = $result['length'] - $result['headerlength'];
    if (isset($result['constant'])) {
        $constructed = is_array($result['content'][0]);
        print_line($result['start'], $i, $length, $result['headerlength'], $constructed, 'cont [ ' . $result['constant'] . ' ]');
        if ($constructed) {
            make_printable($result['content'][0], $i + 1);
        }
        return;
    }

    switch ($result['type']) {
        case FILE_ASN1_TYPE_SEQUENCE:
        case FILE_ASN1_TYPE_SET:
            $type = $result['type'] == FILE_ASN1_TYPE_SEQUENCE ? 'SEQUENCE' : 'SET';
            print_line($result['start'], $i, $length,$result['headerlength'],  true, $type);
            for ($j = 0; $j < count($result['content']); $j++) {
                make_printable($result['content'][$j], $i + 1);
            }
            break;
        case FILE_ASN1_TYPE_INTEGER:
            print_line($result['start'], $i, $length, $result['headerlength'], false, 'INTEGER', strtoupper($result['content']->toHex()));
            break;
        case FILE_ASN1_TYPE_OBJECT_IDENTIFIER:
            print_line($result['start'], $i, $length, $result['headerlength'], false, 'OBJECT', strtr($result['content'], $oids));
            break;
        case FILE_ASN1_TYPE_BIT_STRING:
            print_line($result['start'], $i, $length, $result['headerlength'], false, 'BIT STRING');
            break;
        case FILE_ASN1_TYPE_BOOLEAN:
            print_line($result['start'], $i, $length, $result['headerlength'], false, 'BOOLEAN', ord(substr($str, $result['start'] + $result['headerlength'], $result['length'] - $result['headerlength'])));
            break;
        case FILE_ASN1_TYPE_OCTET_STRING:
            print_line($result['start'], $i, $length, $result['headerlength'], false, 'OCTET STRING');
            break;
        case FILE_ASN1_TYPE_NULL:
            print_line($result['start'], $i, $length, $result['headerlength'], false, 'NULL');
            break;
        case FILE_ASN1_TYPE_NUMERIC_STRING:
            $type = 'NUMERICSTRING';
        case FILE_ASN1_TYPE_PRINTABLE_STRING:
            if (!isset($type)) {
                $type = 'PRINTABLESTRING';
            }
        case FILE_ASN1_TYPE_TELETEX_STRING:
            if (!isset($type)) {
                $type = 'T61STRING';
            }
        case FILE_ASN1_TYPE_VIDEOTEX_STRING:
            if (!isset($type)) {
                $type = 'VIDEOTEXSTRING';
            }
        case FILE_ASN1_TYPE_VISIBLE_STRING:
            if (!isset($type)) {
                $type = 'VISIBLESTRING';
            }
        case FILE_ASN1_TYPE_IA5_STRING:
            if (!isset($type)) {
                $type = 'IA5STRING';
            }
        case FILE_ASN1_TYPE_GRAPHIC_STRING:
            if (!isset($type)) {
                $type = 'GRAPHICSTRING';
            }
        case FILE_ASN1_TYPE_GENERAL_STRING:
            if (!isset($type)) {
                $type = 'GENERALSTRING';
            }
        case FILE_ASN1_TYPE_UTF8_STRING:
            if (!isset($type)) {
                $type = 'UTF8STRING';
            }
        case FILE_ASN1_TYPE_BMP_STRING:
            if (!isset($type)) {
                $type = 'BMPSTRING';
            }
            print_line($result['start'], $i, $length, $result['headerlength'], false, $type, $result['content']);
            break;
        case FILE_ASN1_TYPE_GENERALIZED_TIME:
        case FILE_ASN1_TYPE_UTC_TIME:
            $type = $result['type'] == FILE_ASN1_TYPE_GENERALIZED_TIME ? 'GENERALIZEDTIME' : 'UTCTIME';
            print_line($result['start'], $i, $length, $result['headerlength'], false, $type, substr($str, $result['start'] + $result['headerlength'], $result['length'] - $result['headerlength']));
    }
}

function print_line($start, $depth, $length, $headerlength, $constructed, $type, $extra = false)
{
    echo str_pad($start, 5, ' ', STR_PAD_LEFT) . ':';
    echo 'd=' . str_pad($depth, 3);
    echo 'hl=' . str_pad($headerlength, 2);
    echo 'l=' . str_pad($length, 4, ' ', STR_PAD_LEFT) . ' ';
    echo ($constructed ? 'cons' : 'prim') . ': ';
    echo str_repeat(' ', $depth) . $type;
    if ($extra !== false) {
        echo str_repeat(' ', 18 - strlen($type)) . ':' . $extra;
    }
    echo "\r\n";
}

make_printable($result[0]);
echo '</pre>';
endif;
?>
    </div>
  </div>
  <!-- end .grid_9 -->
</div>
<!-- end .container_16 -->
</body>
</html>