<?php
class Country{

    public $id;
	public $code;
	public $name;

    public function __construct($id, $code, $name){
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
    }


    public function getFlag(){
	    return $this->code . ".png";
     }
}
?>