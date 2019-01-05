<?php

include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/Cal.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Database/DatabaseFactory.php");

class CalDAO{

    public static function getAll(){
        $results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Cal");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $resultsArray[$i] = self::convertRowToObject($row);
        }
        return $resultsArray;
    }

    public static function getById($id){
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Cal WHERE CalId = ?;", array($id));
        return self::convertRowToObject(mysqli_fetch_array($result));
    }

    public static function createCal($cal){
        return DatabaseFactory::getDatabase()->executeQuery("INSERT INTO Cal VALUES (NILL,'?',?,?);", array($cal->name,$cal->baseDmg,$cal->creator->id));
    }

    private static function convertRowToObject($row){
        if(!is_null($row)){
            $creator = UserDAO::getCreatorById($row['CreatorId']);
            return new Cal($row['CalId'],$creator,$row['Name'],$row['BaseDmg']);
        }
        return NULL;
    }
}

?>