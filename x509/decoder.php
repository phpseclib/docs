<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="google-site-verification" content="DHz4kg_uhBzFTmMZSrMTtF9lqPofgrUucAmZrsakViI" />
<meta name="keywords" content="SSH,SFTP,RSA,PHP,AES,Rijndael,3DES,RC4,SSH2,SSH1,X.509,X509" />
<meta name="description" content="Decode an arbitrary certificate with phpseclib's X.509 parser" />
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
<title>phpseclib: X.509 Decoder</title>
<link rel="stylesheet" href="../css/reset.css" />
<link rel="stylesheet" href="../css/text.css" />
<link rel="stylesheet" href="../css/960.css" />
<link rel="stylesheet" href="../css/prettify.css"/>
<link rel="stylesheet" href="../css/jquery.qtip.min.css"/>
<link rel="stylesheet" href="../css/jquery.treeview.css" /> 
<script src="../js/prettify.js"></script>
<script src="../js/jquery-1.7.2.min.js"></script>
<script src="../js/jquery.qtip.min.js"></script>
<script src="../js/jquery.cookie.js"></script> <script src="../js/jquery.treeview.js"></script> 
<script>
var certFlag = false;

var manageSelects = function() {
  options = $('select option');
  for (var i = 0; i < options.length; i++) {
   $('.' + options[i].value).hide();
  }

  options = $('select option:selected');
  for (var i = 0; i < options.length; i++) {
   $('.' + options[i].value).show();
  }
};

var highlight = function() {
  if ($('.' + this.value).closest('#notes').length == 0) {
    $('.' + this.value).css('background-color', '#ffa');
  }
};

var unhighlight = function() {
  if ($('.' + this.value).closest('#notes').length == 0) {
    $('.' + this.value).css('background-color', '#f5f4ee');
  }
};

var toggleButton = function() {
  buttons = $('button[value="' + this.value + '"]');
  buttons.eq(0).toggle();
  buttons.eq(1).toggle();
  $('.' + this.value).toggle();
};

var permLink = function() {
  attrs = '';
  selected = $('select option:selected,.disableCode:visible');
  for (i = 0; i < selected.length; i++) {
    attrs+= selected[i].value + ',';
  }
  hashPos = window.location.href.indexOf('#');
  newURL = hashPos == -1 ? window.location.href : window.location.href.substring(0, hashPos);
  window.location.href = newURL + '#' + attrs;
};

var handleCert = function(event) {
  e = event.relatedTarget || event.toElement;
  if (e.id != 'cert2') {
    $('#cert2').hide();
  }
}

var showPath = function() {   path = '';   parents = $(this).parents('li:visible');   for (var i = parents.length - 1; i >= 0; i--) {     name = $('.name', parents[i])[0].textContent;     delimiter = isNaN(name) ? '\'' : '';     path+= '[' + delimiter + name + delimiter + ']';   }   $('#path').html('<code id="path">$cert' + path + '</code>:'); }; 
$(document).ready(function() {
  //$('pre span[id]').hide();
  //$('#notes div[id]').hide();

  $('.printr').treeview({     persist: "location",     collapsed: true,     unique: true   });

  buttons = $('button:visible');
  for (var i = 0; i < buttons.length; i++) {
   $('.' + buttons[i].value).hide();
  }

  options = window.location.href.split('#');
  options = options.length > 1 ? options[1].split(',') : new Array();
  for (var i = 0; i < options.length; i++) {
    options[i] = options[i].replace(/%20/g, ' ');
    $('select option[value="' + options[i] +'"]').prop('selected', true);
    button = $('button[value="' + options[i] +'"]');
    if (button.length) {
      toggleButton.apply(button[0]);
    }
  }

  manageSelects();

  //$('#cert').qtip();

  $('.name,.hitarea').click(showPath); 
  $('select').change(manageSelects);
  //$('select').change(highlight);
  $('select').keyup(manageSelects);
  //$('select').focus(highlight);
  //$('select').blur(unhighlight);
  $('button').click(toggleButton);
  $('#permlink span').click(permLink);
});
</script>

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
<div class="container_12">
  <div class="grid_12">
    <h1>php<span class="red">sec</span>lib: X.509 Decoder</h1>
    <div id="pgup">(return to <a href="intro.html">phpseclib: X.509 Examples</a>)</div>
  </div>
  <div class="clear"></div>
  <div class="grid_3">
    <p style="color: gray">
      The associative array returned by this page corresponds to the ASN.1 description of X.509 certificates.
    </p>
  </div>
  <!-- end .grid_3 -->
  <div class="grid_9">
    <div>
<?php
if (!isset($_POST['cert']) && empty($_FILES)):
?>
<form enctype="multipart/form-data" action="" method="POST">
Copy / paste certificate:<br />
<textarea name="cert" cols="80" rows="20"></textarea><br />
Upload certificate:<br />
<input name="pem" type="file" /><br /> 
<input type="submit" value="Decode" />
</form>
<?php
else:
    $cert = !empty($_POST['cert']) ? $_POST['cert'] : file_get_contents($_FILES['pem']['tmp_name']);

    include('File/X509.php');

    function array2html($array, $start = true)
    {
        $result = '';
        foreach ($array as $key => $value) {
            switch ($key) {
                case 'subjectPublicKey':
                    $open = '<pre>';
                    $close = '</pre>';
                    break;
                case 'signature':
                    $open = '<div style="overflow: auto; word-wrap: break-word">';
                    $close = '</div>';
                    break;
                default:
                    $open = $close = '';
            }
            $result.= '<li><span class="name">' . $key . '</span>' . (is_array($value) ? array2html($value, false) : '<ul><li>' . $open . htmlspecialchars($value) . $close . '</li></ul>') . '</li>';
        }
        $start = $start ? ' class="printr"' : '';
        return '<ul' . $start . '>' . $result . '</ul>';
    }

    $x509 = new File_X509();
    $cert = $x509->loadX509($cert);

    //echo '<hr /><b>Subject:</b> ' . $x509->getDN(true) . '<hr />';
    //echo '<b>Issuer:</b> ' . $x509->getIssuerDN(true) . '<hr />';
    echo '<table><tr><td style="text-align: right; background: #ffa"><b>Subject</b></td><td>' . $x509->getDN(true) . '</td></tr><tr><td style="text-align: right; background: #ffa"><b>Issuer</b></td><td>' . $x509->getIssuerDN(true) . '</td></tr></table>';
?>
<code id="path">$cert</code>
<?php

    echo array2html($cert);

endif;
?>
    </div>
  </div>
  <!-- end .grid_9 -->
</div>
<!-- end .container_16 -->
</body>
</html>