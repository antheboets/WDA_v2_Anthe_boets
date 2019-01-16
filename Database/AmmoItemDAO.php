<?php

include_once("/mnt/studentenhomes/anthe.boets/public_html/TacGen/Data/AmmoItem.php");
include_once("/mnt/studentenhomes/anthe.boets/public_html/TacGen/Database/DatabaseFactory.php");
include_once("/mnt/studentenhomes/anthe.boets/public_html/TacGen/Database/SquadDAO.php");
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

    public static function delete($SquadId,$ammoItem){
        $squad = SquadDAO::getById($SquadId->creator->id);
        if(!is_null($squad)){
            return DatabaseFactory::getDatabase()->executeQuery("DELETE FROM AmmoItem WHERE SquadId = ? AND AmmoTypeId = ?;", array($SquadId,$ammoItem->ammoType->id));
        }
        return false;
    }

    public static function create($SquadId,$ammoItem){
        return DatabaseFactory::getDatabase()->executeQuery("INSERT INTO AmmoItem VALUES (?,?,?);", array($SquadId,$ammoItem->ammoType->id,$ammoItem->amount));
    }

    public static function update($SquadId,$ammoItem){
        return DatabaseFactory::getDatabase()->executeQuery("UPDATE AmmoItem SET Amount = ? WHERE SquadId = ? AND AmmoTypeId = ?;", array($ammoItem->amount,$SquadId,$ammoItem->ammoType->id));
    }

    private static function convertRowToObject($row){
        if(!is_null($row)){
            return new AmmoItem($row['AmmoTypeId'],$row['Amout']);
        }
        return NULL;
    }
}
?>