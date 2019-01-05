<?php

include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/AmmoItem.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Database/DatabaseFactory.php");

class AmmoItemDAO{
    public static function getAll(){
        $results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM AmmoItem");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $resultsArray[$i] = self::convertRowToObject($row);
        }
        return $resultsArray;
    }


    public static function getById($id){
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM AmmoItem WHERE AmmoItemId = ?;", array($id));
        return self::convertRowToObject(mysqli_fetch_array($result));
    }

    public static function getFromSquad($id){
        $listItems = array();
        $results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM AmmoItem WHERE SquadId = ?;", array($id));
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $listItems[$i] = AmmoItemDAO::getById($row);
        }
        return $listItems;
    }

    public static function create($SquadId,$ammoItem){
        return DatabaseFactory::getDatabase()->executeQuery("INSERT INTO AmmoItem VALUES (?,?,?);", array($SquadId,$ammoItem->ammoType->id,$ammoItem->amount));
    }


    private static function convertRowToObject($row){
        if(!is_null($row)){
            return new AmmoItem($row['AmmoTypeId'],$row['Amout']);
        }
        return NULL;
    }
}
?>