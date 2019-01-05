<?php

include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/AmmoType.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Database/DatabaseFactory.php");

class AmmoTypeDAO{

    public static function getAll(){
        $results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM AmmoType");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $resultsArray[$i] = self::convertRowToObject($row);
        }
        return $resultsArray;
    }


    public static function getById($id){
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM AmmoType WHERE AmmoTypeId = ?;", array($id));
        return self::convertRowToObject(mysqli_fetch_array($result));
    }

    public static function create($ammoType){
        return DatabaseFactory::getDatabase()->executeQuery("INSERT INTO AmmoType VALUES (NILL,'?',?,?,?);", array($ammoType->name,$ammoType->cal->id,$ammoType->dmgBoost,$ammoType->creator->id));
    }


    private static function convertRowToObject($row){
        if(!is_null($row)){
            $creator = UserDAO::getCreatorById($row['CreatorId']);
            return new AmmoType($row['AmmoTypeId'],$creator,$row['Name'],$row['CalId'],$row['DmgBoost']);
        }
        return NULL;
    }
}
?>