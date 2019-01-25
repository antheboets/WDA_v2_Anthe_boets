<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Data/User.php");
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