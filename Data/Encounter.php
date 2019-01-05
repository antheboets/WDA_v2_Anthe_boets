<?php
class Encounter{


    public $id;
    public $name;
    public $creator;
    public $listSquads;

    public function __construct($id, $name, $creator, $listSquads){
        $this->id = $id;
        $this->name = $name;
        $this->creator = $creator;
        $this->listSquads = $listSquads;
    }


}

?>