<?php

include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/BarrelExtension.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Database/DatabaseFactory.php");

class BarrelExtensionDAO{

    public static function getAll(){
        $results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM BarrelExtension");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $resultsArray[$i] = self::convertRowToObject($row);
        }
        return $resultsArray;
    }

    public static function getById($id){
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM BarrelExtension WHERE BarrelExtensionId = ?;", array($id));
        return self::convertRowToObject(mysqli_fetch_array($result));
    }

    public static function create($barrelExtension){
        return DatabaseFactory::getDatabase()->executeQuery("INSERT INTO BarrelExtension VALUES (NILL,'?',?,?,?);", array($barrelExtension->name,$barrelExtension->dmgBoost,$barrelExtension->accuracyBoost,$barrelExtension->creator->id));
    }

    private static function convertRowToObject($row){
        if(!is_null($row)){
            $creator = UserDAO::getCreatorById($row['CreatorId']);
            return new BarrelExtension($row['BarrelExtensionId'],$creator,$row['Name'],$row['DmgBoost'],$row['AccuracyBoost']);
        }
        return NULL;
    }
}

?>