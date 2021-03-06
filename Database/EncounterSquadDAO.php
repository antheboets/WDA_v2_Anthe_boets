<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Data/EncounterSquad.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Database/DatabaseFactory.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Database/SquadDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Database/EncounterDAO.php");
class EncounterSquadDAO{

    public static function getByEncounterId($id){
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM EncounterSquads WHERE EncounterId = ?;", array($id));
        return self::convertRowToObject(mysqli_fetch_array($result));
    }

    public static function create($encounterId,$encounterSquad){
        return DatabaseFactory::getDatabase()->executeQuery("INSERT INTO EncounterSquads VALUES(?,?,?);", array($encounterId,$encounterSquad->squad->id,$encounterSquad->EncounterRate));
    }


    public static function update($encounterId,$encounterSquad){
        return DatabaseFactory::getDatabase()->executeQuery("UPDATE EncounterSquads SET EncounterRate = ? WHERE EncounterId = ?, SquadId = ?;", array($encounterSquad->EncounterRate,$encounterId,$encounterSquad->squad->id));
    }

    public static function delete($encounter,$encounterSquad){
        return DatabaseFactory::getDatabase()->executeQuery("DELETE FROM EncounterSquads WHERE EncounterId = ?, SquadId = ?;", array($encounter->Id,$encounterSquad->squad->id));
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