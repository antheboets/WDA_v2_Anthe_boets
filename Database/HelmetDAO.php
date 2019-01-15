<?php
include_once("/mnt/studentenhomes/anthe.boets/public_html/WDA/TacGen/Data/Helmet.php");
include_once("/mnt/studentenhomes/anthe.boets/public_html/WDA/TacGen/Database/DatabaseFactory.php");

class HelmetDAO{


    public static function getAll(){
        $results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Helmet");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $resultsArray[$i] = self::convertRowToObject($row);
        }
        return $resultsArray;
    }


    public static function getById($id){
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Helmet WHERE HelmetId = ?;", array($id));
        return self::convertRowToObject(mysqli_fetch_array($result));
    }

    public static function create($helmet){
        return DatabaseFactory::getDatabase()->executeQuery("INSERT INTO Helmet VALUES (NILL,'?',?,?,?,?);", array($helmet->name,$helmet->Value,$helmet->creator->id));
    }

    public static function update($helmet){
        return DatabaseFactory::getDatabase()->executeQuery("UPDATE Helmet SET Name = '?', Value = ? WHERE GunId = ?;", array($helmet->name,$helmet->value,$helmet->id));
    }

    public static function delete($helmet){
        return DatabaseFactory::getDatabase()->executeQuery("DELETE FROM Helmet WHERE HelmetId = ? AND CreatorId = ?;", array($helmet->Id,$helmet->creator->id));
    }

    private static function convertRowToObject($row){
        if(!is_null($row)){
            $creator = UserDAO::getCreatorById($row['CreatorId']);
            return new Helmet($row['HelmetId'],$creator,$row['Name'],$row['Value']);
        }
        return NULL;
    }
}

?>