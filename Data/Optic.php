<?php
include_once("/mnt/studentenhomes/anthe.boets/public_html/WDA/TacGen/Data/User.php");
class Optic{

    public $id;
    public $creator;
    public $name;
    public $accuracyBoost;


    public function __construct($id, $creator, $name, $accuracyBoost){
        $this->id = $id;
        $this->creator = $creator;
        $this->name = $name;
        $this->accuracyBoost = $accuracyBoost;
    }


}

?>