<?php
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/Mag.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/Optic.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/Grip.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/barrelExtension.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/Cal.php");
include_once($_SERVER['DOCUMENT_ROOT']."/TacGen/Data/User.php");
class Gun{

    public $id;
    public $creator;
	public $name;
	public $accuracy;
	public $maxSalvo;
	public $minSalvo;
    public $cal;
    public $mag;
	public $canHaveOptic;
    public $optic;
	public $canHaveGrip;
	public $grip;
    public $canHaveBarrelExtension;
	public $barrelExtension;
	public $desc;


    public function __construct($id, $creator, $name, $accuracy, $maxSalvo, $minSalvo, $cal, $mag, $canHaveOptic, $optic, $canHaveGrip, $grip, $canHaveBarrelExtension, $barrelExtension, $desc){
        $this->id = $id;
        $this->creator = $creator;
        $this->name = $name;
        $this->accuracy = $accuracy;
        $this->maxSalvo = $maxSalvo;
        $this->minSalvo = $minSalvo;
        $this->cal = $cal;
        $this->mag = $mag;
        $this->canHaveOptic = $canHaveOptic;
        $this->optic = $optic;
        $this->canHaveGrip = $canHaveGrip;
        $this->grip = $grip;
        $this->canHaveBarrelExtension = $canHaveBarrelExtension;
        $this->barrelExtension = $barrelExtension;
        $this->desc = $desc;
    }


    public function checkCal($cal){
		if($this->cal->id == $cal->id){
			return true;
		}
		return false;
	}

	//mag
	public function hasMag(){
		if(is_null($this->mag)){
			return false;
		}
		return true;
	}

	public function removeMag(){
		if($this->hasMag()){
			$oldMag = $this->mag;
			$this->mag = NULL;
			return $oldMag;
		}
		return false;
	}

	public function addMag($newMag){
		if(!$this->hasMag()){
			if($this->checkCal($newMag)){
				$this->mag = $newMag;
				return true;
			}
		}
		return false;
	}

	public function changeMag($newMag){
		if($this->checkCal($newMag)){
			if($this->hasMag()){
				$oldMag = $this->removeMag();
                $this->addMag($newMag);
				return $oldMag;
			}
			else{
                $this->addMag($newMag);
				return true;
			}
		}		
		return false;
	}

	//optic
	public function hasOptic(){
        if($this->canHaveOptic){
            if(is_null($this->optic)){
                return false;
            }
            return true;
        }
        return false;
	}

	public function removeOptic(){
		if($this->hasOptic()){
			$oldOptic = $this->optic;
			$this->optic = NULL;
			return $oldOptic;
		}
		return false;
	}

	public function addOptic($newOptic){
		if(!$this->hasOptic()){
			$this->optic = $newOptic;
			return true;
			
		}
		return false;
	}

	public function changeOptic($newOptic){
        if($this->canHaveOptic){
            if($this->hasOptic()){
                $oldOptic = $this->removeOptic();
                $this->addOptic($newOptic);
                return $oldOptic;
            }
            else{
                $this->addOptic($newOptic);
                return true;
            }
        }
		return false;
	}

	//barrel extension
	public function hasBarrelExtension(){
        if($this->canHaveBarrelExtension){
            if(is_null($this->barrelExtension)){
                return false;
            }
            return true;
        }
        return false;

	}

	public function removeBarrelExtension(){
		if($this->hasBarrelExtension()){
			$oldBarrelExtension = $this->barrelExtension;
			$this->barrelExtension = NULL;
			return $oldBarrelExtension;
		}
		return false;
	}

	public function addBarrelExtension($newBarrelExtension){
		if(!$this->hasBarrelExtension()){
			$this->barrelExtension = $newBarrelExtension;
			return true;
			
		}
		return false;
	}

	public function changeBarrelExtension($newBarrelExtension){
        if($this->canHaveBarrelExtension){
            if($this->hasBarrelExtension()){
                $oldBarrelExtension = $this->removeBarrelExtension();
                $this->addBarrelExtension($newBarrelExtension);
                return $oldBarrelExtension;
            }
            else{
                $this->addBarrelExtension($newBarrelExtension);
                return true;
            }
        }
		return false;
	}

	//grip
	public function hasGrip(){
        if($this->canHaveGrip){
            if(is_null($this->grip)){
                return false;
            }
            return true;
        }
		return false;
	}

	public function removeGrip(){
		if($this->hasGrip()){
			$oldGrip = $this->grip;
			$this->grip = NULL;
			return $oldGrip;
		}
		return false;
	}

	public function addGrip($newGrip){
		if(!$this->hasGrip()){
			$this->grip = $newGrip;
			return true;
			
		}
		return false;
	}

	public function changeGrip($newGrip){
        if($this->canHaveGrip){
            if($this->hasGrip()){
                $oldGrip = $this->removeGrip();
                $this->addGrip($newGrip);
                return $oldGrip;
            }
            else{
                $this->addGrip($newGrip);
                return true;
            }
        }
		return false;
	}
}
?>