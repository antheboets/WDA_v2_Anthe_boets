<?php
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/database/UserDAO.php");
session_start();

include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Logic/lib.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/database/SoldierDAO.php");
if(!isLogedIn()){
	include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Logic/autoLogin.php");
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>TacGen</title>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
		<script src="UI/js/lib.js"></script>
		<script src="UI/js/header.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css"  href="UI/css/header.css">
		<link rel="stylesheet" type="text/css"  href="UI/css/index.css">
	</head>
	<body>
		<script>
			<?php
				$bool = !isLogedIn() ? 'true' : 'false';
				echo 'function isLogedIn(){';
				echo 'return '. $bool .';';
				echo '}';
			?>
				
		</script>
		<?php 
			include($_SERVER['DOCUMENT_ROOT']."/TacGen/UI/component/header.php");
		?>
		<div class="container">
            <div class="row">
                <div class='col-md-4'>
                    <h1>Tactical Generator</h1>
                </div>
            </div>
            <div class="row">
                <div class='col-md-4'>
                    <h2>Newst Soldiers</h2>
                </div>
                <div class='col-md-4'>
                    <h2>Random Soldiers</h2>
                </div>
                <?php
                $amount = 4;
                $listNew = SoldierDAO::getByAmout($amount);
                $listRandom = SoldierDAO::getRandomByAmout($amount);
                $listCreator = array();
                if(isLogedIn()){
                    $listCreator = SoldierDAO::getByAmoutFromUser($_SESSION['user'],$amount);
                    if(count($listCreator) > 0) {
                        echo "<div class='col-md-4'>";
                        echo "</div>";
                    }
                }
                echo "</div>";
                echo "<div class=\"row\">";
                for($i = 0; $i < $amount; $i++){
	                if(count($listNew) > $i){
	                   	$listNew[$i]->printSoldier();
                    }
                }
                echo "</div>";
                ?>
        </div>
	</body>
</html>
