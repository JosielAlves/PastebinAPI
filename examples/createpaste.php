<?php
require('../PastebinAPI.class.php');
$pbapi=new PastebinAPI();
$pbapi->APIDevKey="Put your API developer key here";
//The method 'createPaste' returns an URL to the new paste
echo $pbapi->createPaste("<?php echo \"hello world!\"; ?>", "Hello world in PHP", "php", 0, PastebinAPI::PASTE_EXPIRENEVER);
?>
