<?php
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/User.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/Gun.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/Armour.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/Helmet.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/Mag.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/Optic.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/Grip.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/barrelExtension.php");
class Squad{

    public $id;
    public $creator;
    public $name;
	public $listSoldiers;
	public $listInventory;


    public function __construct($id, $creator, $name, $listSoldiers, $listInventory){
        $this->id = $id;
        $this->creator = $creator;
        $this->name = $name;
        $this->listSoldiers = $listSoldiers;
        $this->listInventory = $listInventory;
    }


    public function removeSoldier($soldier){
        for($i = 0; $i < count($this->listSoldiers);$i++){
            if($soldier === $this->listSoldiers[$i]) {
                array_splice($listSoldiers, $i,1);
            }
        }
    }

    public function addSoldier($soldier){
        array_push($listSoldiers,$soldier);
    }

    public function removeItem($item){
        for($i = 0; $i < count($this->listInventory);$i++){
            if($item === $this->listInventory[$i]) {
                array_splice($listInventory, $i,1);
            }
        }
    }

    public function addItem($item){
        array_push($listInventory,$item);
    }

}
?>