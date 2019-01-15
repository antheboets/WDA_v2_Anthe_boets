<?php
	session_start();
	setcookie('autoLogin','',time()-3600,"/");
	session_destroy();
	header("location: /mnt/studentenhomes/anthe.boets/public_html/WDA/TacGen/TacGen/index.php");
?>