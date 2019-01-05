<?php

include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/gun.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Database/DatabaseFactory.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/CalDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/MagDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/OpticDAO.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/BarrelExtensionDAO.php");

class GunDAO{

    public static function getAll(){
        $results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Gun");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $resultsArray[$i] = self::convertRowToObject($row);
        }
        return $resultsArray;
    }

    public static function getById($id){
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM Gun WHERE GunId = ?;", array($id));
        return self::convertRowToObject(mysqli_fetch_array($result));
    }

    public static function create($gun){

        $opticId = 0;
        $gripId = 0;
        $barrelExtensionId = 0;
        $magId = 0;


        if(!is_null($gun->mag)){
            $magId = $gun->mag->id;
        }

        if($gun->canHaveOptic){
            if(!is_null($gun->optic)){
                $opticId = $gun->optic->id;
            }
        }

        if($gun->canHaveGrip){
            if(!is_null($gun->grip)){
                $gripId = $gun->grip->id;
            }
        }
        if($gun->canHaveBarrelExtension){
            if(!is_null($gun->barrelExtension)){
                $barrelExtensionId = $gun->barrelExtension->id;
            }
        }

        return DatabaseFactory::getDatabase()->executeQuery("INSERT INTO Gun VALUES(NULL,'?',?,?,?,?,?,?,?,?,?,?,?,'?',?);", array($gun->Name,$gun->maxSalvo,$gun->minSalvo,$gun->accuracy,$gun->cal->id,$magId,$gun->canHaveOptic,$opticId,$gun->canHaveGrip,$gripId,$gun->canHaveBarrelExtension,$barrelExtensionId,$gun->desc,$gun->creatorId));

    }

    private static function convertRowToObject($row){

    	if(is_null($row)){
    		$cal = CalDAO::getById($row['CalId']);
    		if(is_null($cal)){
    			$mag = MagDAO::getById($row['MagId']);
                $optic = OpticDAO::getById($row['OpticId']);
    			$grip = GripDAO::getById($row['GripId']);
    			$barrelExtension = BarrelExtensionDAO::getById($row['BarrelExtensionId']);
                $creator = UserDAO::getCreatorById($row['CreatorId']);
                return  new Gun($row['GunId'],$creator,$row['Name'],$row['MaxSalvo'],$row['MinSalvo'],$row['Accuracy'],$cal,$mag,$row['CanHaveOptic'],$optic,$row['CanHaveGrip'],$grip,$row['CanHaveBarrelExtension'],$barrelExtension,$row['Description']);
    		}
    	}
        return null;
    }

}
?>