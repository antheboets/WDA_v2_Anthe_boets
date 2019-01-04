<?php

include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/AmmoType.php");

class AmmoItem{

	public $ammoType;
	public $amount;


    public function __construct($ammoType, $amount){
        $this->ammoType = $ammoType;
        $this->amount = $amount;
    }


}

?>