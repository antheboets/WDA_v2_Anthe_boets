<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Data/User.php");
class BarrelExtension{

    public $id;
    public $creator;
    public $name;
    public $dmgBoost;
    public $accuracyBoost;


    public function __construct($id, $creator, $name, $dmgBoost, $accuracyBoost){
        $this->id = $id;
        $this->creator = $creator;
        $this->name = $name;
        $this->dmgBoost = $dmgBoost;
        $this->accuracyBoost = $accuracyBoost;
    }


}


?>