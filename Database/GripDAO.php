<?php
include_once("/mnt/studentenhomes/anthe.boets/public_html/TacGen/Data/Grip.php");
include_once("/mnt/studentenhomes/anthe.boets/public_html/TacGen/Database/DatabaseFactory.php");

class GripDAO{


    public static function getAll(){
        $results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Grip");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $resultsArray[$i] = self::convertRowToObject($row);
        }
        return $resultsArray;
    }


    public static function getById($id){
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Grip WHERE GripId = ?;", array($id));
        return self::convertRowToObject(mysqli_fetch_array($result));
    }

    public static function update($grip){
        return DatabaseFactory::getDatabase()->executeQuery("UPDATE Grip SET Name = '?', AccuracyBoost = ?, MinSalvoBoost = ?,MaxSalvoBoost = ? WHERE GripId = ?;", array($grip->name,$grip->accuracyBoost,$grip->minSalvoBoost,$grip->maxSalvoBoost,$grip->id));
    }

    public static function delete($grip){
        return DatabaseFactory::getDatabase()->executeQuery("DELETE FROM Grip WHERE GripId = ? AND CreatorId = ?;", array($grip->Id,$grip->creator->id));
    }

    public static function create($grip){
        return DatabaseFactory::getDatabase()->executeQuery("INSERT INTO Grip VALUES (NILL,'?',?,?,?,?);", array($grip->name,$grip->accuracyBoost,$grip->minSalvoBoost,$grip->maxSalvoBoost, $grip->creator->id));
    }

    private static function convertRowToObject($row){
        if(!is_null($row)){
            $creator = UserDAO::getCreatorById($row['CreatorId']);
            return new Grip($row['GripId'],$creator,$row['Name'],$row['AccuracyBoost'],$row['MinSalvoBoost'],$row['MaxSalvoBoost']);
        }
        return NULL;
    }
}

?>