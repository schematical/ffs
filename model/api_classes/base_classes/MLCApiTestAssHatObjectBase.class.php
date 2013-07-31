<?php
class MLCApiTestAssHatObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'TestAssHat';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
		       	case('TestAssTie'):
					//Load 
					$objTestAssTie = $this->GetEntity()->IdTestAssTie;
					return new MLCApiTestAssTieObject($objIdTestAssTie);
			    break;
			    
				
		     	case('TestObjects'):
		       		$arrTestObjects = TestObject::LoadCollByIdTestAssHat($this->GetEntity()->idTestAssHat)->GetCollection();
		       		return new MLCApiResponse($arrTestObjects);
		    	break;
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}