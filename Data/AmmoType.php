<?php

include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Data/User.php");
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Data/Cal.php");
class AmmoType{

    public $id;
    public $creator;
	public $name;
	public $cal;
	public $dmgBoost;


    public function __construct($id, $creator, $name, $cal, $dmgBoost){
        $this->id = $id;
        $this->creator = $creator;
        $this->name = $name;
        $this->cal = $cal;
        $this->dmgBoost = $dmgBoost;
    }


}

?>