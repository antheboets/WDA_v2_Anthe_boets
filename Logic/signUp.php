<?php
	session_start();
	include_once($_SERVER['DOCUMENT_ROOT']."TacGen/Logic/lib.php");
	include_once($_SERVER['DOCUMENT_ROOT']."TacGen/database/UserDAO.php");

	if($_SERVER["REQUEST_METHOD"] == 'POST'){
		if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['rePassword'])){
			if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['rePassword'])){

				$passwordCheck = true;
				//checkPass
				if($_POST['password'] != $_POST['rePassword']){
					$passwordCheck = false;
				}

				
				$emailCheck = true;
				//checkEmail
				if(!validateEmail($_POST['email'])){
					$emailCheck = false;
				}

				if(UserDAO::checkEmail($_POST['email'])){
					$emailCheck = false;
				}

				if($passwordCheck && $emailCheck){

					
					$salt = generateRandomString(16);

					//http://php.net/manual/en/function.hash.php
					$hash = hash('sha512',$_POST['password'] . $salt);

					$user = new User(0,$_POST['email'],$_POST['username'] );
					if(UserDAO::create($user,$hash,$salt)){
						$_SESSION['user'] = UserDAO::getByEmail($_POST['email']);
						header("location: ".$_SERVER['DOCUMENT_ROOT']."/TacGen//index.php");
					} 
				}
			}
		}
	}
	header("location: ".$_SERVER['DOCUMENT_ROOT']."/TacGen/index.php");
	
?>