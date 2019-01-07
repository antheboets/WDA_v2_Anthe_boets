<?php
include_once("/mnt/studentenhomes/Anthe.Boets/public_html/WDA/TacGen/database/UserDAO.php");
session_start();

include_once("/mnt/studentenhomes/Anthe.Boets/public_html/WDA/TacGen/Logic/lib.php");
include_once("/mnt/studentenhomes/Anthe.Boets/public_html/WDA/TacGen/database/SoldierDAO.php");
include_once("/mnt/studentenhomes/Anthe.Boets/public_html/WDA/TacGen/database/CountryDAO.php");
include_once("/mnt/studentenhomes/Anthe.Boets/public_html/WDA/TacGen/database/GunDAO.php");
include_once("/mnt/studentenhomes/Anthe.Boets/public_html/WDA/TacGen/database/ArmourDAO.php");
include_once("/mnt/studentenhomes/Anthe.Boets/public_html/WDA/TacGen/database/HelmetDAO.php");
if(!isLogedIn()){
	include_once("/mnt/studentenhomes/Anthe.Boets/public_html/WDA/TacGen/Logic/autoLogin.php");
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>TacGen</title>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
		<script src="../js/lib.js"></script>
		<script src="../js/header.js"></script>
        <script src="../js/createSoldier.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css"  href="../css/header.css">
		<link rel="stylesheet" type="text/css"  href="../css/index.css">
	</head>
	<body>
    <div class="container">
        <div class="row">
            <form action="../../logic/createSoldier.php" method="POST" id="fSoldier">
                <p class="noBreak">Name:</p>
                <input type="text" name="name">
                <p class="noBreak">Country: </p>
                <select name="country" id="dropdownCountry">

                    <?php
                    $countryList = CountryDAO::getAll();
                    foreach ($countryList as $country){
                        echo "<option value='".$country->id."'>".$country->code."</option>";
                    }
                    ?>
                </select>
                <p class="noBreak">Gun:</p>
                <select name="gun" id="dropdownGun">
                    <?php
                    $gunList = GunDAO::getAll();
                    foreach ($gunList as $gun){
                        echo "<option value='".$gun->id."'>".$gun->name."</option>";
                    }
                    ?>
                </select>
                <p class="noBreak">Armour:</p>
                <select name="armour" id="dropdownArmour">
                    <?php
                    $armourList = ArmourDAO::getAll();
                    foreach ($armourList as $armour){
                        echo "<option value='".$armour->id."'>".$armour->name."</option>";
                    }
                    ?>
                </select>
                <p class="noBreak">Helmet:</p>
                <select name="helmet" id="dropdownHelmet">
                    <?php
                    $helmetList = HelmetDAO::getAll();
                    foreach ($helmetList as $helmet){
                        echo "<option value='".$helmet->id."'>".$helmet->name."</option>";
                    }
                    ?>
                </select>
                <p class="noBreak">Desc:</p>
                <input type="text" name="desc">
                <br>
                <input type="submit" name="submit" value="create">
            </form>
        </div>
    </div>

	</body>
</html>