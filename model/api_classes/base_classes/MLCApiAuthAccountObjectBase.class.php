<?php
class MLCApiAuthAccountObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'AuthAccount';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
				
		     	case('mlclocations'):
		       		$arrMLCLocations = MLCLocation::LoadCollByIdAccount($this->GetEntity()->idAccount)->GetCollection();
		       		return new MLCApiResponse($arrMLCLocations);
		    	break;
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}