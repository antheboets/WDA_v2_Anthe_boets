<?php
include_once("/mnt/studentenhomes/anthe.boets/public_html/TacGen/Data/User.php");
class Helmet{

    public $id;
    public $creator;
	public $name;
	public $value;

    public function __construct($id, $creator, $name, $value){
        $this->id = $id;
        $this->creator = $creator;
        $this->name = $name;
        $this->value = $value;
    }


}
?>