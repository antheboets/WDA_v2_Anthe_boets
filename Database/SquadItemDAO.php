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
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Database/ItemTypeDAO.php");
class SquadItemDAO{


    public static function getAll(){
        $results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM SquadItems");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $resultsArray[$i] = self::convertRowToObject($row);
        }
        return $resultsArray;
    }

    public static function getAllFromSquadById($id){
        $squadItems = array();
        $results  = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM SquadItems WHERE SquadId = ?;", array($id));
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $squadItems[$i] = self::convertRowToObject($row);
        }
        return $squadItems;
    }

    public static function delete($squadId,$squadItem){

        $itemTypeList = ItemTypeDAO::getAll();

        foreach ($itemTypeList as $e){
            if($e->name == get_class($squadItem)){
                if($e->id >= 7){
                    return DatabaseFactory::getDatabase()->executeQuery("DELETE FROM SquadItem WHERE SquadId = ?, ItemId = ?, ItemType = ?;", array($squadId,$squadItem->id,$e->id ));
                }
                elseif($e->id == 8) {
                    return AmmoItemDAO::delete($squadId, $squadItem);
                }
            }
        }
        return false;

    }

    public static function create($SquadId,$itemId,$itemTypeId){
        return DatabaseFactory::getDatabase()->executeQuery("INSERT INTO SquadItems VALUES(?,?,?);", array($SquadId,$itemId,$itemTypeId));
    }



    private static function convertRowToObject($row){
        switch ($row['ItemType']) {
            case 1:
                return ArmourDAO::getById($row['ItemId']);
                break;
            case 2:
                return BarrelExtensionDAO::getById($row['ItemId']);
                break;
            case 3:
                return GripDAO::getById($row['ItemId']);
                break;
            case 4:
                return GunDAO::getById($row['ItemId']);
                break;
            case 5:
                return HelmetDAO::getById($row['ItemId']);
                break;
            case 6:
                return MagDAO::getById($row['ItemId']);
                break;
            case 7:
                return OpticDAO::getById($row['ItemId']);
                break;
            default:
                return NULL;
                break;
        }
    }

}



?>