<?php

include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/Armour.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Database/DatabaseFactory.php");

class ArmourDAO{


	public static function getAll(){
	   	$results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Armour");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $resultsArray[$i] = self::convertRowToObject($row);
        }
        return $resultsArray;    
	}
    public static function update($armour){
        return DatabaseFactory::getDatabase()->executeQuery("UPDATE Armour SET Name = '?',Value = ? WHERE ArmourId = ?;", array($armour->name,$armour->Value,$armour->id));
    }

	public static function getById($id){
		$result = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Armour WHERE armourId = ?;", array($id));
		return self::convertRowToObject(mysqli_fetch_array($result));
	}

    public static function create($armour){
        return DatabaseFactory::getDatabase()->executeQuery("INSERT INTO Armour VALUES (NILL,'?',?,?);", array($armour->name,$armour->value,$armour->creator->id));
    }

	private static function convertRowToObject($row){
		if(!is_null($row)){
            $creator = UserDAO::getCreatorById($row['CreatorId']);
			return new Armour($row['ArmourId'],$creator,$row['Name'],$row['Value']);
		}
		return NULL;
	}
}

?>