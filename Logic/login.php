<?php
	session_start();
	include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Logic/lib.php");
	include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/database/UserDAO.php");

	if($_SERVER["REQUEST_METHOD"] == 'POST'){
		if(isset($_POST['email']) && isset($_POST['password'])){
			if(!empty($_POST['email']) && !empty($_POST['password'])){

				$emailCheck = true;
				//checkEmail;
				
				if(isset($_POST['stayLogedIn'])){
					setcookie('autoLogin', $_POST['email'],2147483647 ,"/");
				}
				
				if(!validateEmail($_POST['email'])){
					$emailCheck = false;
				}

				if($emailCheck){

					$salt = UserDAO::getSaltFromUser($_POST['email']);
					$hash = hash('sha512',$_POST['password'] . $salt);
					$user = UserDAO::checkCredentials($_POST['email'],$hash);
					if(!is_null($user)){
						$_SESSION['user'] = $user;
						header("location: ".$_SERVER['DOCUMENT_ROOT']."/TacGen/TacGen/index.php");
					}
				}
			}
		}
	}
	header("location: ".$_SERVER['DOCUMENT_ROOT']."/TacGen/TacGen/index.php");
?>