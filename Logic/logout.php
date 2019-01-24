<?php
	session_start();
	setcookie('autoLogin','',time()-3600,"/");
	session_destroy();
	header("location: ".$_SERVER['DOCUMENT_ROOT']."/TacGen/TacGen/index.php");
?>