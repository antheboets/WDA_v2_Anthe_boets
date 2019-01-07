<?php

include_once("/mnt/studentenhomes/Anthe.Boets/public_html/TacGen/Data/AmmoType.php");

class AmmoItem{

	public $ammoType;
	public $amount;


    public function __construct($ammoType, $amount){
        $this->ammoType = $ammoType;
        $this->amount = $amount;
    }


}

?>