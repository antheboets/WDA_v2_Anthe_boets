<?php
include_once($_SERVER['DOCUMENT_ROOT']."TacGen/database/UserDAO.php");
session_start();

include_once($_SERVER['DOCUMENT_ROOT']."TacGen/Logic/lib.php");
include_once($_SERVER['DOCUMENT_ROOT']."TacGen/database/SoldierDAO.php");
if(!isLogedIn()){
	include_once($_SERVER['DOCUMENT_ROOT']."TacGen/Logic/autoLogin.php");
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
			include($_SERVER['DOCUMENT_ROOT']."TacGen/UI/component/header.php");
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
                        echo "<h2>Random Soldiers</h2>";
                        echo "</div>";
                    }
                }
                echo "</div>";

                for($i = 0; $i < $amount; $i++){
                    if(count($listNew) > $i){
                     ?>
                        <div class="row">
                            <div class='col-md-4'>
                                <div class="soldier">
                                    <a href="soldierDetail?id=<?php echo $listNew[$i]->id; ?>">
                                        <img src="<?php echo $listNew[$i]->img;?>" height="600px" width="300px">
                                        <p class="noBreak">Name: <?php echo $listNew[$i]->name;?></p>
                                        <p class="noBreak">country: <?php echo $listNew[$i]->country->code;?></p>
                                        <p class="noBreak">Gun: <?php echo $listNew[$i]->gun->name;?></p>
                                        <p class="noBreak">Helmet: <?php echo $listNew[$i]->helmet->name;?></p>
                                        <p class="noBreak">Armour: <?php echo $listNew[$i]->armour->name;?></p>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                        if(count($listRandom) > $i){
                        ?>
                            <div class='col-md-4'>
                                <div class="soldier">
                                    <a href="soldierDetail?id=<?php echo $listRandom[$i]->id; ?>" >
                                        <img src="<?php echo $listRandom[$i]->img; ?>" height="600px" width="300px">
                                        <p class="noBreak">Name: <?php echo $listRandom[$i]->name; ?></p>
                                        <p class="noBreak">country: <?php echo $listRandom[$i]->country->code; ?></p>
                                        <p class="noBreak">Gun: <?php echo $listRandom[$i]->gun->name; ?></p>
                                        <p class="noBreak">Helmet: <?php echo $listRandom[$i]->helmet->name; ?></p>
                                        <p class="noBreak">Armour: <?php echo $listRandom[$i]->armour->name; ?></p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        if(count($listCreator) > $i){
                            ?>
                        <div class='col-md-4'>
                            <div class="soldier">
                                <a href="soldierDetail?id=<?php echo $listCreator[$i]->id; ?>">
                                    <img src="<?php echo $listCreator[$i]->img;?>" height="600px" width="300px">
                                    <p class="noBreak">Name: <?php echo $listCreator[$i]->name;?></p>
                                    <p class="noBreak">country: <?php echo $listCreator[$i]->country->code;?></p>
                                    <p class="noBreak">Gun: <?php echo $listCreator[$i]->gun->name;?></p>
                                    <p class="noBreak">Helmet: <?php echo $listCreator[$i]->helmet->name;?></p>
                                    <p class="noBreak">Armour: <?php echo $listCreator[$i]->armour->name;?></p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                    }

                }?>
        </div>
	</body>
</html>
