<?php
	//https://stackoverflow.com/questions/4356289/php-random-string-generator
	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
    	return $randomString;
	}

	//https://www.w3schools.com/php/filter_validate_email.asp
	//http://php.net/manual/en/function.filter-var.php
	//http://php.net/manual/en/filter.filters.validate.php
	function validateEmail($email){
		if(filter_var($email,FILTER_VALIDATE_EMAIL)){
			return true;
		}
		return false;
	}
	function isLogedIn(){
		if(isset($_SESSION['user'])){
			if(!empty($_SESSION['user'])){
				return true;
			}
		}
		return false;
	}
?>