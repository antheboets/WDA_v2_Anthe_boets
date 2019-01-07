<?php
include_once("/mnt/studentenhomes/Anthe.Boets/public_html/WDA/TacGen/Data/ItemType.php");
include_once("/mnt/studentenhomes/Anthe.Boets/public_html/WDA/TacGen/Database/DatabaseFactory.php");

class ItemTypeDAO{

    public static function getAll(){
        $results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM ItemType");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $resultsArray[$i] = self::convertRowToObject($row);
        }
        return $resultsArray;
    }

    private static function convertRowToObject($row){
        if(!is_null($row)){
            return new ItemType($row['ItemTypeId'],$row['ItemTableName']);
        }
        return NULL;
    }
}
?>