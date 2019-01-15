<?php
	session_start();
	include_once("/mnt/studentenhomes/anthe.boets/public_html/WDA/TacGen/Logic/lib.php");
	include_once("/mnt/studentenhomes/anthe.boets/public_html/WDA/TacGen/database/UserDAO.php");

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
						header("location: /mnt/studentenhomes/anthe.boets/public_html/WDA/TacGen/TacGen/index.php");
					}
				}
			}
		}
	}
	header("location: /mnt/studentenhomes/anthe.boets/public_html/WDA/TacGen/TacGen/index.php");
?>