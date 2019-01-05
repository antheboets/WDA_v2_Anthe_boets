<?php
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/User.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Database/DatabaseFactory.php");

class UserDAO{
    public static function getAll(){
        $results = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM User");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++){
            $row = $results->fetch_array();
            $resultsArray[$i] = self::convertRowToObject($row);
        }
        return $resultsArray;
    }

    public static function checkEmail($email){

        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT Email FROM User WHERE Email = '?';", array($email));
        $row = $result->fetch_array();
        if(!is_null($row)){
            return true;
        }
        return false;
    }

    public static function getById($id){
        $result  = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM User WHERE SquadId = ?;", array($id));
        return self::convertRowToObject(mysqli_fetch_array($result));
    }

    public static function getCreatorById($id){
        $result  = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM User WHERE SquadId = ?;", array($id));
        return self::convertRowToObjectWithoutEmail(mysqli_fetch_array($result));
    }

    public static function checkCredentioals($email,$hash){
        $result = DatabaseFactory::getDatabase()->executeQuery("SELECT * FROM User WHERE Email = ? AND Hash = ?;", array($email,$hash));
        if(!is_null($result)){
            return true;
        }
        return false;
    }


    public static function update($user){
        if(self::checkEmail($user->email)){
            return DatabaseFactory::getDatabase()->executeQuery("UPDATE User SET Name = '?', email = '?' WHERE UserId = ?;", array($user->name,$user->email,$user->id));
        }
        return false;

    }

    public static function getSaltFromUser($email){


        $result  = DatabaseFactory::getDatabase()->executeQuery("SELECT Salt FROM User WHERE Email = ?;", array($email));
        if(!is_null($result)){
            $row = $result->fetch_array();
            return $row['Salt'];
        }
        return NULL;
    }

    public static function create($user,$pass,$salt){
        return DatabaseFactory::getDatabase()->executeQuery("INSERT INTO User VALUES (NULL,'?','?','?','?',sysdate())",array($user->name,$pass,$salt,$user->email));
    }

    private static function convertRowToObject($row){
        if(!is_null($row)){
            return new User($row['UserId'],$row['Email'],$row['Name']);
        }
        return NULL;
    }

    private static function convertRowToObjectWithoutEmail($row){
        if(!is_null($row)){
            return new User($row['UserId'],NULL,$row['Name']);
        }
        return NULL;
    }

}
?>