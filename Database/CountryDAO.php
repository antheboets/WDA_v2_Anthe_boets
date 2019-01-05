<?php

include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/Country.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Database/DatabaseFactory.php");

class CountryDAO{

	public static function getAll(){
        $results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Country");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $resultsArray[$i] = self::convertRowToObject($row);
        }
        return $resultsArray;    
    }

    public static function getById($id){
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Country WHERE CountryId = ?;", array($id));
        return self::convertRowToObject(mysqli_fetch_array($result));
    }


    private static function convertRowToObject($row){
    	if(!is_null($row)){
    		return new Country($row['CountryId'],$row['Code'],$row['Name']);
    	}
    	return NULL;
    }
}

?>