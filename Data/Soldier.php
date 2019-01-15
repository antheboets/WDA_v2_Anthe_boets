<?php
include_once("/mnt/studentenhomes/anthe.boets/public_html/WDA/TacGen/Data/Gun.php");
include_once("/mnt/studentenhomes/anthe.boets/public_html/WDA/TacGen/Data/Country.php");
include_once("/mnt/studentenhomes/anthe.boets/public_html/WDA/TacGen/Data/Armour.php");
include_once("/mnt/studentenhomes/anthe.boets/public_html/WDA/TacGen/Data/Helmet.php");
include_once("/mnt/studentenhomes/anthe.boets/public_html/WDA/TacGen/Data/User.php");
class Soldier{

    public $id;
    public $creator;
	public $name;
	public $gun;
	public $country;
	public $armour;
	public $helmet;
	public $desc;
    public $img;


    public function __construct($id, $creator, $name, $gun, $country, $armour, $helmet, $desc, $img){
        $this->id = $id;
        $this->creator = $creator;
        $this->name = $name;
        $this->gun = $gun;
        $this->country = $country;
        $this->armour = $armour;
        $this->helmet = $helmet;
        $this->desc = $desc;
        $this->img = $img;
    }


}
?>