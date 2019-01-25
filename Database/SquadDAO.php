<?php

include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Data/Squad.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Database/DatabaseFactory.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Database/ArmourDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Database/BarrelExtensionDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Database/GripDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Database/GunDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Database/HelmetDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Database/MagDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Database/OpticDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Database/AmmoItemDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Database/SquadItemDAO.php");
class SquadDAO{

	public static function getAll(){
        $results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Squad");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $resultsArray[$i] = self::convertRowToObject($row);
        }
        return $resultsArray;    
    }

    public static function checkIfNameIsTaken($name){
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Squad WHERE Name = '?';", array($name));
        if(!is_null($result->fetch_array())){
            return true;
        }
        return false;
    }
    public static function update($squad){
        return DatabaseFactory::getDatabase()->executeQuery("UPDATE Squad SET Name = '?' WHERE SquadId = ?;", array($squad->name,$squad->id));
    }

    public static function delete($squad){
        return DatabaseFactory::getDatabase()->executeQuery("DELETE FROM Squad WHERE SquadId = ? AND CreatorId = ?;", array($squad->Id,$squad->creator->id));
    }

    public static function getById($id){
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Squad WHERE SquadId = ?;", array($id));
        return self::convertRowToObject(mysqli_fetch_array($result));
    }

    public static function getByName($name){
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Squad WHERE Name = '?';", array($name));
        $row = mysqli_fetch_array($result);
        if(!is_null($row)){
            return self::convertRowToObject($row);
        }
        return false;
    }

    public static function create($squad){
        if(self::checkIfNameIsTaken($squad->name)){
            $result = DatabaseFactory::getDatabase()->executeQuery("INSERT INTO Squad VALUES (NILL,?,'?');", array($squad->creator->id,$squad->name));
            $row = mysqli_fetch_array($result);
            if(!is_null($row)){
                $resultNew = self::getByName($squad->name);
                $rowNew = mysqli_fetch_array($resultNew);
                foreach($squad->listSoldiers as $squadSoldier){
                    DatabaseFactory::getDatabase()->executeQuery("INSERT INTO SquadSoldiers VALUES (?,?);", array($rowNew['SquadId'],$squadSoldier->id));
                }

                $listOfItemTypes = SquadItemDAO::getAll();

                foreach($squad->listInventory as $squadItem){

                    foreach($listOfItemTypes as $itemType){
                        if(get_class($squadItem) == $itemType->name){
                             if($itemType->id <= 7){
                                 SquadItemDAO::create($rowNew['SquadId'],$squadItem->id,$itemType->id);
                             }
                             elseif ($itemType->id == 8){
                                 AmmoItemDAO::create($rowNew['SquadId'],$squadItem);
                             }
                        }
                    }
                }
                return true;
            }
        }

       return false;
    }

	private static function convertRowToObject($row){
	    if(!is_null($row)){

            $listItems = array();
            $listAmmoItems = array();

            $listItems = SquadItemDAO::getAllFromSquadById($row['SquadId']);

            $listAmmoItems = AmmoItemDAO::getFromSquad($row['SquadId']);

            foreach ($listAmmoItems as $e){
                array_push($listItems,e);
            }

            $creator = UserDAO::getCreatorById($row['CreatorId']);

            return new Squad($row['SquadId'],$creator,$row['Name'], SoldierDAO::getFromSquad($row['SquadId']),$listItems);
	    }
        return NULL;
	}
}
?>