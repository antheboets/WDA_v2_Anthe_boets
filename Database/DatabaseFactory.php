<?php
	include_once("/mnt/studentenhomes/Anthe.Boets/public_html/WDA/TacGen/Database/Database.php");

	class DatabaseFactory{


		private static $con;

		public static function getDatabase(){

			if(self::$con == null){
				$url = "dt5.ehb.be";
				$user = "1819WEBADV040";
				$pass = "dedo86";
				$db = "1819WEBADV040";
				self::$con = new Database($url, $user, $pass, $db);
			}
            return self::$con;
        }
	}
?>