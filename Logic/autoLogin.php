<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("/mnt/studentenhomes/anthe.boets/public_html/TacGen/database/UserDAO.php");

if(isset($_COOKIE['autoLogin'])){
	if(!empty($_COOKIE['autoLogin'])){
		$email = str_replace('%40','@',$_COOKIE['autoLogin']);
		$user = UserDAO::getByEmail($email);
		if(!is_null($user)){
			$_SESSION['user'] = $user;
		}
	}
	else{
		setcookie('autoLogin','',time()-3600,"/");
	}
}

?>