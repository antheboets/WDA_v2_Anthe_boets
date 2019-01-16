<?php

include_once("/mnt/studentenhomes/anthe.boets/public_html/TacGen/Data/BarrelExtension.php");
include_once("/mnt/studentenhomes/anthe.boets/public_html/TacGen/Database/DatabaseFactory.php");

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
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM BarrelExtension WHERE BarrelExtension = ?;", array($id));
        return self::convertRowToObject(mysqli_fetch_array($result));
    }



    public static function update($barrelExtension){
        return DatabaseFactory::getDatabase()->executeQuery("UPDATE BarrelExtension SET Name = '?',DmgBoost = ?,AccuracyBoost = ? WHERE ArmourId = ?;", array($barrelExtension->name,$barrelExtension->dmgBoost,$barrelExtension->accuracyBoost,$barrelExtension->id));
    }

    public static function delete($barrelExtension){
        return DatabaseFactory::getDatabase()->executeQuery("DELETE FROM BarrelExtension WHERE BarrelExtension = ? AND CreatorId = ?;", array($barrelExtension->id,$barrelExtension->creator->id));
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