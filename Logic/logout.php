<?php
	session_start();
	setcookie('autoLogin','',time()-3600,"/");
	session_destroy();
	header('location: "/mnt/studentenhomes/Anthe.Boets/public_html/WDA/TacGen/TacGen/index.php');
?>