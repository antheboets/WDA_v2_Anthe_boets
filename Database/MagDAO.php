<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Data/Mag.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Database/DatabaseFactory.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Database/CalDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Data/AmmoType.php");

class MagDAO{


    public static function getAll(){
        $results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Mag");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $resultsArray[$i] = self::convertRowToObject($row);
        }
        return $resultsArray;
    }


    public static function getById($id){
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Mag WHERE MagId = ?;", array($id));
        return self::convertRowToObject(mysqli_fetch_array($result));
    }

    public static function create($mag){
        return DatabaseFactory::getDatabase()->executeQuery("INSERT INTO Mag VALUES(NULL,'?',?,?,?);", array($mag->name,$mag->cal->id,$mag->capacity,$mag->AmmoType->id,$mag->creatorId));
    }

    public static function delete($mag){
        return DatabaseFactory::getDatabase()->executeQuery("DELETE FROM Mag WHERE MagId = ? AND CreatorId = ?;", array($mag->Id,$mag->creator->id));
    }


    public static function update($mag){
        return DatabaseFactory::getDatabase()->executeQuery("UPDATE Mag SET Name = '?', Capacity = ?,AmmoTypeId = ? WHERE GunId = ?;", array($mag->name,$mag->capacity,$mag->ammoTypeId,$mag->id));
    }

    private static function convertRowToObject($row){
        if(!is_null($row)){

            $cal = CalDAO::getById($row['CalId']);

            if(!is_null($cal)){
                $ammoType = AmmoTypeDAO::getById($row['AmmoTypeId']);
                $creator = UserDAO::getCreatorById($row['CreatorId']);
                return new Mag($row['MagId'],$creator,$row['Name'],$cal,$row['Capacity'],$row['Capacity'],$ammoType);
            }
        }
        return NULL;
    }
}

?>