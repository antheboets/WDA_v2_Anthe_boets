<?php
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/Gun.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/Country.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/Armour.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/Helmet.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/User.php");
class Soldier{

    public $id;
    public $creator;
	public $name;
	public $gun;
	public $country;
	public $armour;
	public $helmet;
	public $desc;


    public function __construct($id, $creator, $name, $gun, $country, $armour, $helmet, $desc){
        $this->id = $id;
        $this->creator = $creator;
        $this->name = $name;
        $this->gun = $gun;
        $this->country = $country;
        $this->armour = $armour;
        $this->helmet = $helmet;
        $this->desc = $desc;
    }


}
?>