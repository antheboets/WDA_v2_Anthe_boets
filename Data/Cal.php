<?php
include_once($_SERVER['DOCUMENT_ROOT']."/anthe.boets/public_html/TacGen/Data/User.php");
class Cal{

	public $id;
    public $creator;
	public $name;
	public $baseDmg;


    public function __construct($id, $creator, $name, $baseDmg){
        $this->id = $id;
        $this->creator = $creator;
        $this->name = $name;
        $this->baseDmg = $baseDmg;
    }


}
?>