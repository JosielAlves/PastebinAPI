<?php
require('../PastebinAPI.class.php');
$pbapi=new PastebinAPI();
$pbapi->APIDevKey="Put your API developer key here";
$pbapi->authenticateUser('your login', 'your password');
//The method 'createPaste' returns an URL to the new paste
echo $pbapi->createPaste("<?php echo \"hello world!\"; ?>", "Hello world in PHP", "php", 0, PastebinAPI::PASTE_EXPIRENEVER, false);
?>
