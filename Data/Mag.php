<?php
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/Cal.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/AmmoType.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/User.php");
class Mag{

    public $id;
    public $creator;
	public $name;
	public $cal;
	public $capacity;
    public $ammoType;


    public function __construct($id, $creator, $name, $cal, $capacity, $ammoType){
        $this->id = $id;
        $this->creator = $creator;
        $this->name = $name;
        $this->cal = $cal;
        $this->capacity = $capacity;
        $this->ammoType = $ammoType;
    }


}
?>