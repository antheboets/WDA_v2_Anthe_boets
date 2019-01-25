<?php

include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/database/UserDAO.php");
session_start();

include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Logic/lib.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/database/SoldierDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/database/CountryDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/database/GunDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/database/ArmourDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/database/HelmetDAO.php");



if($_SERVER["REQUEST_METHOD"] == 'POST'){

	if(isset($_POST['name']) && isset($_POST['country']) && isset($_POST['gun']) && isset($_POST['armour']) &&  isset($_POST['helmet'])  && isset($_POST['desc'])){
        if(!empty($_POST['name']) && !empty($_POST['country']) && !empty($_POST['gun']) && !empty($_POST['armour'])  && !empty($_POST['helmet'])  &&  !empty($_POST['desc'])){


            $country = CountryDAO::getById($_POST['country']);
            $gun = GunDAO::getById($_POST['gun']);
            $armour = ArmourDAO::getById($_POST['armour']);
            $helmet = HelmetDAO::getById($_POST['helmet']);

            

            $soldier =  new Soldier(0,$_SESSION['user'],$_POST['name'],$gun,$country,$armour,$helmet,$_POST['desc'],NULL);
            SoldierDAO::create($soldier);
            header('location: ');
        }
	}
}

header('location: ');

?>