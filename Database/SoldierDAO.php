<?php

include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/Soldier.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Database/DatabaseFactory.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Database/CountryDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Database/GunDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Database/ArmourDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Database/HelmetDAO.php");

class SoldierDAO{

	public static function getAll(){
        $results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Soldier");
        $resultsArray = array();
        if($results){
            for($i = 0; $i < $results->num_rows; $i++){
                $row = $results->fetch_array();
                $resultsArray[$i] = self::convertRowToObject($row);
            }
        }
        return $resultsArray;    
    }

    public static function getByAmout($amount){
    	$results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Soldier ORDER BY CreationDate DESC LIMIT ?;",array($amount));
        $resultsArray = array();
        if($results){
            for($i = 0; $i < $results->num_rows; $i++){
                $row = $results->fetch_array();
                $resultsArray[$i] = self::convertRowToObject($row);
            }
        }
        return $resultsArray;
    }
    public static function getByAmoutFromUser($user,$amount){
        $results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Soldier WHERE CreatorId = ? WHERE  ORDER BY CreationDate DESC LIMIT ?;",array($user->id,$amount));
        $resultsArray = array();
        if($results){
            for($i = 0; $i < $results->num_rows; $i++){
                $row = $results->fetch_array();
                $resultsArray[$i] = self::convertRowToObject($row);
            }
        }

        return $resultsArray;
    }

    public static function getRandomByAmout($amount){
        $list = self::getAll();
        $indexList = array();
        $randomList = array();
        if(count($list) >$amount ){
            for ($i = 0; $i < $amount; $i++){
                $randNum = rand(0,count($list));
                $add = true;
                foreach ($indexList as $index){
                    if($randNum == $index){
                        $add = false;
                    }
                }
                if($add){
                    $randomList[$i] = $list[$randNum];
                }
                else {
                    $i--;
                }
            }
        }
        else{
            $randomList = $list;
        }

        return $randomList;
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

    public static function update($soldier){
        return DatabaseFactory::getDatabase()->executeQuery("UPDATE Soldier SET Name = '?',GunId = ?,CountryId = ?, ArmourId = ?, HelmetId = ?, Description = ?, Img = '?' WHERE GunId = ?;", array($soldier->name,$soldier->gun->id,$soldier->country->id,$soldier->armour->id,$soldier->helmet->id,$soldier->desc,$soldier->img,$soldier->id));
    }

    public static function delete($soldier){
        return DatabaseFactory::getDatabase()->executeQuery("DELETE FROM Soldier WHERE SoldierId = ? AND CreatorId = ?;", array($soldier->Id,$soldier->creator->id));
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

        return DatabaseFactory::getDatabase()->executeQuery("INSERT INTO Soldier VALUES (NULL,'?',?,?,?,?,'?',?,sysdate(),'?') ;", array($soldier->name,$soldierId,$countryId,$armourId,$helmetId,$soldier->desc,$soldier->creator->id,$soldier->img));
    }

	private static function convertRowToObject($row){
        if(!is_null($row)){
            $gun = NULL;
            $armour = NULL;
            $helmet = NULL;
            if(!is_null($row['GunId'])){
                $gun = GunDAO::getById($row['GunId']);
            }
            if(!is_null($row['GunId'])){
                $armour = ArmourDAO::getById($row['ArmourId']);
            }
            if(!is_null($row['GunId'])) {
                $helmet = HelmetDAO::getById($row['HelmetId']);
            }
            $country = CountryDAO::getById($row['CountryId']);
            $creator = UserDAO::getCreatorById($row['CreatorId']);
            return new Soldier($row['SoldierId'],$creator,$row['Name'],$gun,$country,$armour,$helmet,$row['Description'],$row['Img']);
        }
	    return null;
	}
}
?>