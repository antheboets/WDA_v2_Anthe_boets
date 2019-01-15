<?php
include_once("/mnt/studentenhomes/anthe.boets/public_html/WDA/TacGen/Data/User.php");
class Grip{

    public $id;
    public $creator;
    public $name;
    public $accuracyBoost;
    public $minSalvoBoost;
    public $maxSalvoBoost;


    public function __construct($id, $creator, $name, $accuracyBoost, $minSalvoBoost, $maxSalvoBoost){
        $this->id = $id;
        $this->creator = $creator;
        $this->name = $name;
        $this->accuracyBoost = $accuracyBoost;
        $this->minSalvoBoost = $minSalvoBoost;
        $this->maxSalvoBoost = $maxSalvoBoost;
    }


}
?>