<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Data/Optic.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Database/DatabaseFactory.php");

class OpticDAO{


    public static function getAll(){
        $results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Optic");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $resultsArray[$i] = self::convertRowToObject($row);
        }
        return $resultsArray;
    }


    public static function getById($id){
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Optic WHERE OpticId = ?;", array($id));
        return self::convertRowToObject(mysqli_fetch_array($result));
    }

    public static function create($optic){
        return DatabaseFactory::getDatabase()->executeQuery("INSERT INTO Optic VALUES (NILL,'?',?,?);", array($optic->name,$optic->AccuracyBoost,$optic->creator->id));
    }

    public static function update($optic){
        return DatabaseFactory::getDatabase()->executeQuery("UPDATE Optic SET Name = '?', AccuracyBoost = ? WHERE GunId = ?;", array($optic->name,$optic->accuracyBoost,$optic->id));
    }

    public static function delete($optic){
        return DatabaseFactory::getDatabase()->executeQuery("DELETE FROM Optic WHERE OpticId = ? AND CreatorId = ?;", array($optic->Id,$optic->creator->id));
    }

    private static function convertRowToObject($row){
        if(!is_null($row)){
            $creator = UserDAO::getCreatorById($row['CreatorId']);
            return new Optic($row['OpticId'],$creator,$row['Name'],$row['AccuracyBoost']);
        }
        return NULL;
    }
}

?>