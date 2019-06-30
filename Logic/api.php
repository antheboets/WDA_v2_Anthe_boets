<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Database/SoldierDAO.php");
echo var_dump($_POST);
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['name'])){
		if(!empty($_POST['name'])){
			if($_POST['name'] != ""){
				//$soldierArray = SoldierDAO::getSoldiersByName($_POST['name']);
				//echo json_encode($soldierArray);
			}
		}
	}
}
?>