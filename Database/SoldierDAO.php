<?php

include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/Soldier.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Database/DatabaseFactory.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/CountryDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/GunDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/ArmourDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/HelmetDAO.php");

class SoldierDAO{

	public static function getAll(){
        $results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Soldier");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $resultsArray[$i] = self::convertRowToObject($row);
        }
        return $resultsArray;    
    }

    public static function getByAmout($amount){
    	$results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Soldier WHERE ORDER BY CreationDate DESC FETCH FIRST ? ROWS ONLY;",array($amount));
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $book = self::convertRowToObject(mysqli_fetch_array($row)); 
            $resultsArray[$i] = $book;  
        }
        return $resultsArray;
    }

    public static function getById($id){
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Soldier WHERE SoldierId = ?;", array($id));
        return self::convertRowToObject(mysqli_fetch_array($result));
    }

    public static function getFromSquad($id){
        $listSoldiers = array();
        $results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM SquadSoldiers WHERE SquadId = ?;", array($id));
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $listSoldiers[$i] = SoldierDAO::getById($row['SoldierId']);
        }
        return $listSoldiers;
    }

    public static function create($soldier){

        $soldierId = 0;
        $countryId = 0;
        $armourId = 0;
        $helmetId = 0;

	    if(!is_null($soldier->gun)){
	        $soldierId = $soldier->gun->id;
        }

	    if(!is_null($soldier->armour)){
            $armourId = $soldier->armour->id;
        }

	    if(!is_null($soldier->country)){
            $countryId = $soldier->country->id;
        }

	    if(!is_null($soldier->helmet)){
            $helmetId = $soldier->helmet->id;
        }

        return DatabaseFactory::getDatabase()->executeQuery("INSERT INTO Soldier VALUES (NULL,'?',?,?,?,?,'?',?,sysdate()) ;", array($soldier->name,$soldierId,$countryId,$armourId,$helmetId,$soldier->desc,$soldier->creatorId));
    }

	private static function convertRowToObject($row){
        if(!is_null($row)){
            $gun = GunDAO::getById($row['GunId']);
            $country = CountryDAO::getById($row['CountryId']);
            $armour = ArmourDAO::getById($row['ArmourId']);
            $helmet = HelmetDAO::getById($row['HelmetId']);
            $creator = UserDAO::getCreatorById($row['CreatorId']);
            return new Soldier($row['SoldierId'],$creator,$row['Name'],$row['CreatorId'],$gun,$country,$armour,$helmet,$row['Description']);
        }
	    return null;
	}
}
?>