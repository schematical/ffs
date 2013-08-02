<?php
class MLCApiDeviceObjectBase extends MLCApiObjectBase{
   
    protected $strClassName = 'Device';
	public function  __call($strName, $arrArguments) {
    		switch($strName){
				
				
		     	case('assignments'):
		       		$arrAssignments = Assignment::LoadCollByIdDevice($this->GetEntity()->idDevice)->GetCollection();
		       		return new MLCApiResponse($arrAssignments);
		    	break;
				
				default:
					return parent::__call($strName, $arrArguments);
				
    		}
	}
    
   
   
   	
}