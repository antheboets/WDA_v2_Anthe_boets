<?php

include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/Encounter.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Database/DatabaseFactory.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Database/UserDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Database/EncounterSquadDAO.php");

class EncounterDAO{

    public static function getAll(){
        $results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Encounter");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $resultsArray[$i] = self::convertRowToObject($row);
        }
        return $resultsArray;
    }

    public static function getById($id){
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Encounter WHERE EncounterId = ?;", array($id));
        return self::convertRowToObject(mysqli_fetch_array($result));
    }

    public static function getIdByNameAndCreatorId($creatorId,$name){
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT EncounterId FROM Encounter WHERE Name = '?' AND CreatorId = ?;", array($name,$creatorId));
        $row = mysqli_fetch_array($result);
        return $row['EncounterId'];
    }

    public static function delete($encounter){
        return DatabaseFactory::getDatabase()->executeQuery("DELETE FROM Encounter WHERE EncounterId = ? AND CreatorId = ?;", array($encounter->id,$encounter->creator->id));
    }

    public static function update($encounter){

        foreach ($encounter->listSquads as $e){
            EncounterSquadDAO::update($encounter->id,$e);
        }

        return DatabaseFactory::getDatabase()->executeQuery("UPDATE Encounter SET Name = '?' WHERE EncounterId = ?;", array($encounter->name,$encounter->id));
    }

    public static function create($encounter){
        $result = DatabaseFactory::getDatabase()->executeQuery("INSERT INTO Encounter VALUES(NULL,'?',?);", array($encounter->name,$encounter->creator->id));
        if($result){

            $encounterId = self::getIdByNameAndCreatorId($encounter->creator->id,$encounter->name);

            foreach($encounter->listSquads as $e){
                EncounterSquadDAO::create($encounterId,$e);
            }
            return true;
        }
        return false;
    }

    private static function convertRowToObject($row){
        if(!is_null($row)){
            $creator = UserDAO::getCreatorById($row['CreatorId']);

            $SquadList = EncounterSquadDAO::getByEncounterId($row['EncounterId']);

            return new Encounter($row['EncounterId'],$row['Name'],$creator,$SquadList);
        }
        return NULL;
    }

}
?>