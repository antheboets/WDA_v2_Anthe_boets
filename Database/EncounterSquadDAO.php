<?php
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/EncounterSquad.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Database/DatabaseFactory.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Database/SquadDAO.php");
class EncounterSquadDAO{

    public static function getByEncounterId($id){
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM EncounterSquads WHERE EncounterId = ?;", array($id));
        return self::convertRowToObject(mysqli_fetch_array($result));
    }

    public static function create($encounterId,$encounterSquad){
        return DatabaseFactory::getDatabase()->executeQuery("INSERT INTO EncounterSquads VALUES(?,?,?);", array($encounterId,$encounterSquad->squad->id,$encounterSquad->EncounterRate));
    }


    private static function convertRowToObject($row){
        if(!is_null($row)){
            $squad = SquadDAO::getById($row);
            return new EncounterSquad($squad,$row['EncounterRate']);
        }
       return null;
    }
}

?>