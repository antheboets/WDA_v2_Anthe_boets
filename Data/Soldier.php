<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Data/Gun.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Data/Country.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Data/Armour.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Data/Helmet.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Data/User.php");
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

    public function printSoldier(){
        $str = "<div class='col-md-4'>";
        $str .= "<div class='soldier'>";
        $str .= "<a href=\"soldierDetail?id=". $this->id ."\">";
        $str .= "<img src=\" ". $this->img ."\" height=\"600px\" width=\"300px\">";
        $str .= "<p class=\"noBreak\">Name: ". $this->name ."</p>";
        $str .= "<p class=\"noBreak\">Country: ". $this->country->code ."</p>";
        $str .= "<p class=\"noBreak\">Gun: ". $this->gun->name ."</p>";
        $str .= "<p class=\"noBreak\">Helmet: ". $this->helmet->name ."</p>";
        $str .= "<p class=\"noBreak\">Armour: ". $this->armour->name ."</p>";
        $str .= "</a>";
        $str .= "</div>";
        $str .= "</div>";
        echo $str;
    }
}
?>