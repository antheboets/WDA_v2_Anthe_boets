<?php

include_once("/mnt/studentenhomes/anthe.boets/public_html/TacGen/Data/AmmoType.php");
include_once("/mnt/studentenhomes/anthe.boets/public_html/TacGen/Database/DatabaseFactory.php");

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

    public static function delete($ammoType){
        return DatabaseFactory::getDatabase()->executeQuery("DELETE FROM AmmoType WHERE AmmoTypeId = ? AND CreatorId = ?;", array($ammoType->$ammoType->id,$ammoType->creator->id));
    }

    public static function update($ammoType){
        return DatabaseFactory::getDatabase()->executeQuery("UPDATE AmmoType SET Name = '?',DmgBoost = ? WHERE AmmoTypeId = ?;", array($ammoType->name,$ammoType->dmgBoost,$ammoType->id));
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