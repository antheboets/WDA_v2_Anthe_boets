<?php 
	if($_SERVER["REQUEST_METHOD"] == 'POST'){
		if(isset($_POST['email']) && isset($_POST['header']) && isset($_POST['body']) && isset($_POST['send'])){
			if(!empty($_POST['email']) && !empty($_POST['header']) && !empty($_POST['body']) && !empty($_POST['send'])){
				$headers[] = 'From: <'.$_POST['email'].'>';
				mail('anthe.boets@student.ehb.be',$_POST['header'],$_POST['body'],implode("\r\n", $headers));
				header("location : ".$_SERVER['DOCUMENT_ROOT']."/TacGen/TacGen/UI/pages/contact.php");
			}
		}
	}
?>